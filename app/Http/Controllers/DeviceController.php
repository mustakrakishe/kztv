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
        $new_device->properties = $input_data['properties'];
        $new_device->save();

        $new_movement_log = new MovementLog;
        $new_movement_log->unit_id = $new_device->id;
        $new_movement_log->location = $input_data['location'];
        $new_movement_log->save();

        $new_device_full_info = $this->get_device($new_device->id);
        return $this->generate_device_log_view($new_device_full_info);
    }

    public function delete(Request $data){
        Unit::find($data->id)->delete();
    }

    public function find_devices(Request $data){
        $views = [];
        $searched_string = $data->string;
        
        $keywords = preg_split('/\s+/', $searched_string);

        $all_keywords_matches = [];
        foreach($keywords as $keyword) {
            $last_movement_logs = MovementLog::selectRaw('id, unit_id, max(created_at) as created_at, location')->groupBy('id', 'unit_id', 'location');

            $single_keyword_matches = Unit::select(
                    'units.id',
                    'units.inventory_code',
                    'units.identification_code',
                    'types.name as type',
                    'units.model',
                    'units.properties',
                    'last_movement_logs.id as last_movement_log_id',
                    'last_movement_logs.location',
                    'last_movement_logs.created_at'
                )

                ->leftJoin('types', 'types.id', '=', 'units.type_id')
                ->leftJoinSub($last_movement_logs, 'last_movement_logs', function($leftJoin){
                    $leftJoin->on('last_movement_logs.unit_id', '=', 'units.id');
                })

                ->whereRaw('inventory_code::text like ' . "'%$keyword%'")
                ->orWhereRaw('identification_code::text like ' . "'%$keyword%'")
                ->orWhereRaw('model ilike ' . "'%$keyword%'")
                ->orWhereRaw('properties ilike ' . "'%$keyword%'")
                ->orWhereRaw('(select name from types where types.id = units.type_id) ilike ' . "'%$keyword%'")
                ->orWhereRaw('(select location from  movement_logs where movement_logs.unit_id = units.id order by created_at desc, id desc limit 1) ilike ' . "'%$keyword%'");

                array_push($all_keywords_matches, $single_keyword_matches);
        }

        $union_builder = $all_keywords_matches[0];
        for($i = 1; $i < count($all_keywords_matches); $i++){
            $union_builder->unionAll($all_keywords_matches[$i]);
        }

        $union_query = $union_builder->toSql();
        $devices_full_info = DB::table(DB::raw("($union_query) as u"))
            ->selectRaw('id, count(id), inventory_code, identification_code, type, model, properties, location, last_movement_log_id')
            ->groupBy('id', 'inventory_code', 'identification_code', 'type', 'model', 'properties', 'location', 'created_at', 'last_movement_log_id')
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
        return ($this->get_devices([$id]))[0];
    }

    protected function get_devices($ids = null){
        $last_movement_log_ids = Unit::select('id as unit_id')
            ->addSelect([
                'movement_log_id' => MovementLog::select('id')
                ->whereColumn('unit_id', 'units.id')
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
                'units.id',
                'units.inventory_code',
                'units.identification_code',
                'types.name as type',
                'units.model',
                'units.properties',
                'last_movement_logs.location',
                'last_movement_logs.id as last_movement_log_id',
                'last_movement_logs.created_at',
            )
            ->latest('last_movement_logs.created_at')
            ->orderByDesc('last_movement_log_id', 'id');
            
        
        if($ids !== null){
            $device_full_info->whereIn('units.id', $ids);
        }
        
        $result = $device_full_info->paginate(20);
        
        return $result;
    }

    public function get_device_comment_form_view(Request $request){
        $device = Unit::find($request->id);
        return $this->generate_device_comment_form_view($device->id, $device->comment);
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
            ->toJSON();

        return view('components.views.devices.device-table.additional-info.main-block', [
            'device_id' => $device_id,
            'comment' => Unit::find($device_id)->comment,
            'movementHistory' => json_decode($movement_history)
        ]);
    }

    protected function generate_device_comment_form_view($device_id, $comment){
        return view('components.views.devices.device-table.additional-info.comment.form', [
            'device_id' => $device_id,
            'comment' => $comment
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

    public function show(){
        $allDevices = $this->get_devices();
        return view('devices', ['devices' => $allDevices]);
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
        $device->properties = $input_data->properties;

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

    public function update_comment(Request $request){
        $device = Unit::find($request->device_id);
        $device->comment = $request->comment;
        $device->save();

        return $this->generate_device_comment_log_view($device->id, $device->comment);
    }
}