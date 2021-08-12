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

        $new_device_full_info = $this->get_device($new_device->id);
        return $this->generate_device_log_view($new_device_full_info);
    }

    public function delete(Request $data){
        Unit::find($data->id)->delete();
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
            $device_full_info = $this->get_device($data->id);
        }

        return $this->generate_device_form_view($types, $device_full_info);
    }

    public function get_device_log_view(Request $data){
        $device_full_info = $this->get_device($data->id);
        return $this->generate_device_log_view($device_full_info);
    }

    public function get_device_more_info(Request $data){
        $device_id = $data->id;
        $movement_history = MovementLog::where('unit_id', $device_id)
            ->latest('created_at')
            ->orderByDesc('id')
            ->get()
            ->toJSON();

        return view('components.views.devices.device-table.additional-info.main-block', ['movementHistory' => json_decode($movement_history)]);
    }

    protected function generate_device_form_view($types, $device){
        return view('components.views.devices.device-table.rows.form', ['types' => $types, 'device' => $device]);
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
}