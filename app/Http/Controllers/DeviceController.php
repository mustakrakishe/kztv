<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Devices\Type;
use App\Models\Devices\Unit;
use App\Models\Devices\MovementLog;
// use App\Models\Devices\IdentificationCode;
// use App\Models\Devices\Manufacture;
// use App\Models\Devices\DeviceModel;

class DeviceController extends Controller{
    public function show(){
        // #2
        $devices = DB::table('units')
            ->join('types', 'units.type_id', '=', 'types.id')
            ->select(
                'units.id',
                'units.inventory_code',
                'units.identification_code',
                'types.name as type',
                'units.model',
                'units.properties',
                'units.comment'
            )
            ->addSelect([
                'movement_log_id' => MovementLog::latest()
                ->orderByDesc('id')
                ->select('id')
                ->whereColumn('unit_id', 'units.id')
                ->latest()
                ->limit(1),

                'created_at' => MovementLog::latest()
                ->orderByDesc('id')
                ->select('created_at')
                ->whereColumn('unit_id', 'units.id')
                ->latest()
                ->limit(1),

                'location' => MovementLog::latest()
                ->orderByDesc('id')
                ->select('location')
                ->whereColumn('unit_id', 'units.id')
                ->latest()
                ->limit(1),
            ])
            // ->orderBy('created_at')
            // ->orderByDesc('movement_log_id')
            ->orderByDesc('id')
            ->get();
        
        
        
        
        
        
        // 1
        // $last_movement_dates = MovementLog::select(
        //         'unit_id',
        //         DB::raw('MAX(created_at) as created_at')
        //     )
        //     ->groupBy('unit_id');
            
        // $last_movement_logs = DB::table('movement_logs')
        //     ->rightJoinSub($last_movement_dates, 'last_movement_dates', function($rightJoin){
        //         $rightJoin
        //             ->on('movement_logs.unit_id', '=', 'last_movement_dates.unit_id')
        //             ->whereColumn('movement_logs.created_at', 'last_movement_dates.created_at');
        //     })
        //     ->select('movement_logs.*');

        // $devices = DB::table('units')
        //     ->join('types', 'units.type_id', '=', 'types.id')
        //     ->joinSub($last_movement_logs, 'last_movement_logs', function($join){
        //         $join->on('units.id', '=', 'last_movement_logs.unit_id');
        //     })
        //     ->select(
        //         'units.id',
        //         'units.inventory_code',
        //         'units.identification_code',
        //         'types.name as type',
        //         'units.model',
        //         'units.properties',
        //         'last_movement_logs.id as movement_log_id',
        //         'last_movement_logs.location',
        //         'last_movement_logs.created_at',
        //         'units.comment'
        //     )
        //     ->orderBy('created_at')
        //     ->orderBy('movement_log_id', 'desc')
        //     ->get();
        
        return view('devices', ['devices' => $devices]);
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
            ->latest()
            ->first();
        
        if($last_movement_log->location != $device_input_data['location']){
            $new_movement_log = new MovementLog;
            $new_movement_log->unit_id = $device->id;
            $new_movement_log->location = $device_input_data['location'];
            $new_movement_log->save();
        }
    }

    public function delete(Request $data){
        $device_id = $data->device_id;
        DB::table('units')->where('id', '=', $device_id)->delete();
    }
}