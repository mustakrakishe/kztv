<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Devices\Type;
use App\Models\Devices\Unit;
use App\Models\Devices\MovementLog;
use Illuminate\Support\Arr;

class DeviceController extends Controller{
    public function add(Request $input_data){
        // Type is selecting not by id because somebody can delete this type from the table while you are trying to set this type id.
        $type = Type::firstOrCreate(
            ['name' => $input_data['type']]
        );
        
        $new_device = new Unit;
        $new_device->inventory_code = $input_data['inventory_code'];
        $new_device->identification_code = $input_data['identification_code'];
        $new_device->type_id = $type->id;
        $new_device->model = $input_data['model'];
        $new_device->comment = $input_data['comment'];
        $new_device->save();

        $new_movement_log = new MovementLog;
        $new_movement_log->unit_id = $new_device->id;
        $new_movement_log->location = $input_data['location'];
        $new_movement_log->save();

        $new_device_full_info = $this->get_device($new_device->id);
        return $this->generate_device_log_view($new_device_full_info);
    }

    public function delete(Request $data){
        $unit_to_delete = Unit::find($data->id);
        $type_to_delete = Type::find($unit_to_delete->type_id);

        $unit_to_delete->delete();
        if(Unit::where('type_id', $type_to_delete->id)->doesntExist()){
            $type_to_delete->delete();
        }
    }

    function fetch_data(Request $request){
        if($request->ajax()){
            $devices = $this->get_devices()->paginate(10);
            return view('components.views.devices.device-table', compact('devices'))->render();
        }
    }

    public function find_devices(Request $data){
        $views = [];
        $searched_string = $data->string;
        
        $keywords = preg_split('/\s+/', $searched_string);

        $all_keywords_matches = [];

        $select_full_device_log_sql = $this->get_devices()->toSql();

        foreach($keywords as $keyword) {

            $single_keyword_matches = DB::table(DB::raw("($select_full_device_log_sql) as t"))
                ->whereRaw('t.inventory_code::text like ' . "'%$keyword%'")
                ->orWhereRaw('t.type ilike ' . "'%$keyword%'")
                ->orWhereRaw('t.identification_code::text like ' . "'%$keyword%'")
                ->orWhereRaw('t.model ilike ' . "'%$keyword%'")
                ->orWhereRaw('t.properties ilike ' . "'%$keyword%'")
                ->orWhereRaw('t.location ilike ' . "'%$keyword%'")
                ->orWhereRaw('t.comment ilike ' . "'%$keyword%'");

                array_push($all_keywords_matches, $single_keyword_matches);
        }

        $union_builder = $all_keywords_matches[0];
        for($i = 1; $i < count($all_keywords_matches); $i++){
            $union_builder->unionAll($all_keywords_matches[$i]);
        }

        $union_query = $union_builder->toSql();
        $devices_full_info = DB::table(DB::raw("($union_query) as u"))
            ->selectRaw('id, count(id), inventory_code, identification_code, type, model, location, comment, last_movement_log_id')
            ->groupBy('id', 'inventory_code', 'identification_code', 'type', 'model', 'location', 'comment', 'created_at', 'last_movement_log_id')
            ->orderByDesc('u.count')
            ->latest('u.created_at')
            ->orderByDesc('last_movement_log_id', 'id')
            ->get();
        
        foreach($devices_full_info as $device_full_info){
            array_push($views, $this->generate_device_log_view($device_full_info)->render());
        }

        return $views;
    }

    protected function get_device($id){
        return ($this->get_devices([$id])->get())[0];
    }

    protected function get_devices($ids = null){
        $last_movement_log_ids = Unit::select('id as unit_id')
            ->addSelect([
                'movement_log_id' => MovementLog::select('id')
                ->whereColumn('unit_id', 'units.id')
                ->latest('created_at')
                ->orderByDesc('id')
                ->limit(1)
            ]);

        $last_movement_logs = DB::table('movement_logs')
            ->joinSub($last_movement_log_ids, 'last_movement_log_ids', function($join){
                $join->on('movement_logs.id', '=', 'last_movement_log_ids.movement_log_id');
            })
            ->select('movement_logs.*');

        $device_full_info = DB::table('units')
            ->join('types', 'types.id', 'units.type_id')
            ->leftJoinSub($last_movement_logs, 'last_movement_logs', function($leftJoin){
                $leftJoin->on('units.id', '=', 'last_movement_logs.unit_id');
            })
            ->select(
                'units.*',
                'types.name as type',
                'last_movement_logs.id as last_movement_log_id',
                'last_movement_logs.created_at',
                'last_movement_logs.location',
            )
            ->latest('last_movement_logs.created_at')
            ->orderByDesc('last_movement_log_id', 'id');
            
        
        if($ids !== null){
            $device_full_info->whereIn('units.id', $ids);
        }
        
        return $device_full_info;
    }

    public function get_property_edit_form(Request $request){
        $device = Unit::find($request->device_id);

        $deviceId = $request->device_id;
        $propertyName = $request->property_name;
        $propertyValue = $device[$propertyName];
        return $this->generate_property_edit_form($deviceId, $propertyName, $propertyValue);
    }

    public function get_device_comment_log_view(Request $request){
        $device = Unit::find($request->device_id);
        return $this->generate_device_comment_log_view($device->id, $device->comment);
    }

    public function get_device_form_view(Request $data){
        $device_full_info = null;
        $types = Type::all();

        if(isset($data->id)){
            $device_full_info = $this->get_device($data->id);
        }

        return $this->generate_device_form_view($types, $device_full_info);
    }

    public function get_device_log_view(Request $data){
        $device_full_info = $this->get_device($data->id);
        return $this->generate_device_log_view($device_full_info);
    }

    public function get_device_more_info_view(Request $data){
        $device_id = $data->id;
        $movement_history = MovementLog::where('unit_id', $device_id)
            ->latest('created_at')
            ->orderByDesc('id')
            ->get()
            ->toJSON(); //json encode-decode for laravel datetime data casting

        return view('components.views.devices.device-table.additional-info.main-block', [
            'device_id' => $device_id,
            'characteristics' => Unit::find($device_id)->properties,
            'movementHistory' => json_decode($movement_history) //json encode-decode for laravel datetime data casting
        ]);
    }

    protected function generate_property_edit_form($deviceId, $propertyName, $propertyValue){
        return view('components.model-property.form', [
            'deviceId' => $deviceId,
            'propertyName' => $propertyName,
            'propertyValue' => $propertyValue,
        ]);
    }

    protected function generate_device_form_view($types, $device){
        return view('components.views.devices.device-table.rows.form', ['types' => $types, 'device' => $device]);
    }

    protected function generate_device_comment_log_view($device_id, $comment){
        return view('components.views.devices.device-table.additional-info.comment.log', [
            'deviceId' => $device_id,
            'comment' => $comment
        ]);
    }

    protected function generate_device_log_view($device){
        return view('components.views.devices.device-table.rows.log', ['device' => $device]);
    }

    public function index(){
        $devices = $this->get_devices()->paginate(10);
        return view('devices', compact('devices'));
    }

    public function update(Request $input_data){
        // Update Types table
        $type = Type::firstOrCreate(
            ['name' => $input_data->type]
        );

        // Update Devices table
        
        $device = Unit::find($input_data->id);
        $device->inventory_code = $input_data->inventory_code;
        $device->identification_code = $input_data->identification_code;
        $device->type_id = $type->id;
        $device->model = $input_data->model;
        $device->comment = $input_data->comment;

        if($device->isDirty()){
            $device->save();
        }

        // Update Movement_logs table
        $last_movement_log = MovementLog::where('unit_id', $input_data->id)
            ->orderByDesc('id')
            ->first();
        
        if($last_movement_log->location != $input_data->location){
            $new_movement_log = new MovementLog;
            $new_movement_log->unit_id = $device->id;
            $new_movement_log->location = $input_data->location;
            $new_movement_log->save();
        }

        $updated_device_full_info = $this->get_device($device->id);
        return $this->generate_device_log_view($updated_device_full_info);
    }

    public function update_characteristics(Request $request){
        $device = Unit::find($request->device_id);
        $device->characteristics = $request->characteristics;
        $device->save();

        return $this->generate_device_characteristics_view($device->id, $device->characteristics);
    }
}