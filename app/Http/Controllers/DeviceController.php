<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Devices\Type;
use App\Models\Devices\Unit;
use App\Models\Devices\MovementLog;

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

        $new_device_full_info = $this->getDevice($new_device->id);
        return view('components.views.devices.device-table.log', ['device' => $new_device_full_info]);
    }

    public function delete(Request $data){
        DB::table('units')->where('id', $data->id)->delete();
    }

    public function getDevice($id){
        return ($this->getDevices([$id]))[0];
    }

    public function getDevices($ids = null){
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
            ->orderByDesc('last_movement_log_id', 'id')
            ->limit(5);
            
        
        if($ids){
            $device_full_info->whereIn('units.id', $ids);
        }
        
        $result = $device_full_info->get();
        
        return $result;
    }

    public function get_device_form(Request $data){
        $device_full_info = null;
        $types = Type::all();

        if(isset($data->id)){
            $device_full_info = $this->getDevice($data->id);
        }

        return view('components.views.devices.device-table.form', ['types' => $types, 'device' => $device_full_info]);
    }

    public function get_device_log(Request $data){
        $device_full_info = $this->getDevice($data->id);
        return view('components.views.devices.device-table.log', ['device' => $device_full_info]);
    }

    public function get_device_more_info(Request $data){
        $device_id = $data->id;
        $movement_history = MovementLog::where('unit_id', $device_id)
            ->orderByDesc('created_at')
            ->get()
            ->toJSON();

        return view('components.views.devices.device-table.additional-info.main-block', ['movementHistory' => json_decode($movement_history)]);
    }

    public function show(){
        $allDevices = $this->getDevices();
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

        $updated_device_full_info = $this->getDevice($device->id);
        return view('components.views.devices.device-table.log', ['device' => $updated_device_full_info]);
    }
}