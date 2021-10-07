<?php

namespace App\Http\Controllers\DeviceAccounting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DeviceAccounting\DeviceController;
use App\Http\Controllers\DeviceAccounting\MovementController;
use App\Http\Controllers\DeviceAccounting\ModernizationController;
use App\Http\Controllers\DeviceAccounting\ModernizationAccountController;

use App\Models\DeviceAccounting\Type;
use App\Models\DeviceAccounting\Device;
use App\Models\DeviceAccounting\Movement;
use App\Models\DeviceAccounting\Condition;
use App\Models\DeviceAccounting\Modernization;
// use Illuminate\Support\Arr;

class DeviceAccountController extends Controller{

    public function add(Request $input_data){
        // Type is selecting not by id because somebody can delete this type from the table while you are trying to set this type id.
        $type = Type::firstOrCreate(
            ['name' => $input_data['type']]
        );
        
        $new_device = new Device;
        $new_device->status_id = $input_data['status_id'];
        $new_device->inventory_code = $input_data['inventory_code'];
        $new_device->identification_code = $input_data['identification_code'];
        $new_device->type_id = $type->id;
        $new_device->model = $input_data['model'];
        $new_device->comment = $input_data['comment'];
        $new_device->save();

        $new_movement_log = new Movement;
        $new_movement_log->device_id = $new_device->id;
        $new_movement_log->location = $input_data['location'];
        $new_movement_log->save();

        $new_device_full_info = $this->get_device($new_device->id);
        return $this->generate_device_log_view($new_device_full_info);
    }

    public function delete(Request $data){
        $device_to_delete = Device::find($data->id);
        $type_to_delete = Type::find($device_to_delete->type_id);

        $device_to_delete->delete();
        if(Device::where('type_id', $type_to_delete->id)->doesntExist()){
            $type_to_delete->delete();
        }
    }

    public function fetch_data(Request $request){
        if($request->ajax()){
            $devices = $request->filters
                ? $this->get_devices($request->filters)->paginate(10)
                : $this->get_devices()->paginate(10);
            return view('components.views.devices.device-table', compact('devices'))->render();
        }
    }

    protected function find_devices($devices, $search_string){
        
        $keywords = preg_split('/\s+/', trim($search_string));

        $all_keywords_matches = [];

        $select_full_device_log_sql = $devices->toSql();

        $views = [];
        foreach($keywords as $keyword) {

            $single_keyword_matches = DB::table(DB::raw("($select_full_device_log_sql) as t"))
                ->whereRaw('t.inventory_code::text like ' . "'%$keyword%'")
                ->orWhereRaw('t.identification_code::text like ' . "'%$keyword%'")
                ->orWhereRaw('t.type ilike ' . "'%$keyword%'")
                ->orWhereRaw('t.model ilike ' . "'%$keyword%'")
                ->orWhereRaw('t.location ilike ' . "'%$keyword%'")
                ->orWhereRaw('t.comment ilike ' . "'%$keyword%'")
                ->orWhereRaw('t.last_movement_comment ilike ' . "'%$keyword%'");

                array_push($all_keywords_matches, $single_keyword_matches);
        }

        $union_builder = $all_keywords_matches[0];
        for($i = 1; $i < count($all_keywords_matches); $i++){
            $union_builder->unionAll($all_keywords_matches[$i]);
        }

        $union_query = $union_builder->toSql();
        $devices = DB::table(DB::raw("($union_query) as u"))
            ->selectRaw('id, count(id), status_id, inventory_code, identification_code, type, model, location, comment, last_movement_id')
            ->groupBy('id', 'status_id', 'inventory_code', 'identification_code', 'type', 'model', 'location', 'comment', 'date', 'last_movement_id')
            ->orderByDesc('u.count')
            ->latest('u.date')
            ->orderByDesc('last_movement_id', 'id');

        return $devices;
    }

    protected function get_device($id){
        $filters = array('id' => [$id]);
        return ($this->get_devices($filters)->get())[0];
    }

    protected function get_devices($filters = null){
        $last_movement_ids = Device::select('id as device_id')
            ->addSelect([
                'movement_log_id' => Movement::select('id')
                ->whereColumn('device_id', 'devices.id')
                ->latest('date')
                ->orderByDesc('id')
                ->limit(1)
            ]);

        $last_movements = DB::table('movements')
            ->joinSub($last_movement_ids, 'last_movement_log_ids', function($join){
                $join->on('movements.id', '=', 'last_movement_log_ids.movement_log_id');
            })
            ->select('movements.*');

        $device_full_info = DB::table('devices')
            ->join('types', 'types.id', 'devices.type_id')
            ->leftJoinSub($last_movements, 'last_movements', function($leftJoin){
                $leftJoin->on('devices.id', '=', 'last_movements.device_id');
            })
            ->select(
                'devices.*',
                'types.name as type',
                'last_movements.id as last_movement_id',
                'last_movements.date',
                'last_movements.location',
                'last_movements.comment as last_movement_comment',
            )
            ->latest('last_movements.date')
            ->orderByDesc('last_movement_id', 'id');
            
        if($filters){
            if(isset($filters['id'])) $device_full_info->whereIn('devices.id', $filters['id']);
            if(isset($filters['search_string'])) $device_full_info = $this->find_devices($device_full_info, $filters['search_string']);
        }
        
        return $device_full_info;
    }

    public function get_property_edit_form(Request $request){
        $device = Device::find($request->device_id);

        $deviceId = $request->device_id;
        $propertyName = $request->property_name;
        $propertyValue = $device[$propertyName];
        return $this->generate_property_edit_form($deviceId, $propertyName, $propertyValue);
    }

    public function get_device_comment_log_view(Request $request){
        $device = Device::find($request->device_id);
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

    public function show_more_info(Request $data){
        $deviceId = $data->id;

        $filters = array('device_id' => [$deviceId]);
        $movements = MovementController::get($filters);
        $modernizationAccounts = ModernizationAccountController::get($filters);
        $repairAccounts = RepairAccountController::get($filters);

        return view('components.views.devices.device-table.additional-info.main-block', compact(
            'deviceId',
            'movements',
            'modernizationAccounts',
            'repairAccounts',
        ));
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
        
        $device = Device::find($input_data->id);
        $device->inventory_code = $input_data->inventory_code;
        $device->identification_code = $input_data->identification_code;
        $device->type_id = $type->id;
        $device->model = $input_data->model;
        $device->comment = $input_data->comment;

        if($device->isDirty()){
            $device->save();
        }

        // Update Movement_logs table
        $last_movement_log = Movement::where('device_id', $input_data->id)
            ->orderByDesc('id')
            ->first();
        
        if($last_movement_log->location != $input_data->location){
            $new_movement_log = new Movement;
            $new_movement_log->device_id = $device->id;
            $new_movement_log->location = $input_data->location;
            $new_movement_log->save();
        }

        $updated_device_full_info = $this->get_device($device->id);
        return $this->generate_device_log_view($updated_device_full_info);
    }

    public function update_characteristics(Request $request){
        $device = Device::find($request->device_id);
        $device->characteristics = $request->characteristics;
        $device->save();

        return $this->generate_device_characteristics_view($device->id, $device->characteristics);
    }
}