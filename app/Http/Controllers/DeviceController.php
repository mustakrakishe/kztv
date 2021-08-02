<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Devices\Type;
use App\Models\Devices\Unit;
use App\Models\Devices\MovementLog;

class DeviceController extends Controller{
    public function get($ids = null){
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
                'last_movement_logs.updated_at',
            )
            ->orderByDesc('last_movement_log_id', 'id');
            
        
        if($ids){
            $device_full_info->whereIn('units.id', $ids);
        }
        
        $result = $device_full_info->get();
        
        return $result;
    }

    public function show(){
        $allDevices = $this->get();
        return view('devices', ['devices' => $allDevices]);
    }

    public function get_device_by_id(Request $data){
        $device = $this->get([$data->id]);
        return json_encode($device[0]);
    }

    public function get_table_row_device(Request $device){
        return view('components.devices.table-rows.device-log', ['device' => $device]);
    }

    public function add(Request $input_data){
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

        return $new_device->id;
    }

    public function update(Request $input_data){
        $device_input_data = $input_data->device;

        // Update Types table
        $type = Type::firstOrCreate(
            ['name' => $device_input_data['type']]
        );

        // Update Devices table
        $device_new_data = array_filter($device_input_data, function($prop_name){
            return in_array($prop_name, [
                'inventory_code',
                'identification_code',
                'model',
                'properties'
            ]);
        }, ARRAY_FILTER_USE_KEY);
        $device_new_data['type_id'] = $type->id;
        
        $device = Unit::find($device_input_data['id']);
        foreach ($device_new_data as $prop_name => $prop_val) {
            $device->$prop_name = $prop_val;
        }

        if($device->isDirty()){
            $device->save();
        }

        // Update Movement_logs table
        $last_movement_log = MovementLog::where('unit_id', $device_input_data['id'])
            ->orderByDesc('id')
            ->first();
        
        if($last_movement_log->location != $device_input_data['location']){
            $new_movement_log = new MovementLog;
            $new_movement_log->unit_id = $device->id;
            $new_movement_log->location = $device_input_data['location'];
            $new_movement_log->save();
        }
    }

    public function delete(Request $data){
        DB::table('units')->where('id', $data->id)->delete();
    }
}