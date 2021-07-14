<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Devices\Type;
use App\Models\Devices\Unit;
// use App\Models\Devices\IdentificationCode;
// use App\Models\Devices\Manufacture;
// use App\Models\Devices\DeviceModel;

class DeviceController extends Controller{
    public function show(){
        $devices = DB::table('units')
            ->join('types', 'units.type_id', '=', 'types.id')
            ->join('movement_logs', 'units.id', '=', 'movement_logs.unit_id')
            ->select(
                'units.id',
                'units.inventory_code',
                'units.identification_code',
                'types.name as type',
                'units.model',
                'units.properties',
                'movement_logs.id as movement_log_id',
                'movement_logs.location',
                'movement_logs.added_at',
                'units.comment'
            )
            ->orderBy('movement_logs.added_at')
            ->orderBy('movement_log_id', 'desc')
            ->get();

        
        return view('devices', ['devices' => $devices]);
    }

    public function update(Request $input_data){
        $device_input_data = $input_data->device;

        $type = Type::firstOrCreate(
            ['name' => $device_input_data['type']]
        );

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

        // $last_movement_log = DB::table('muvement_logs')
        //     ->where('unit_id', '=', $input_data->id)
        //     ->orderByDesc('added_at')
        //     ->limit(1);
        
        // if($last_movement_log->location != $input_data->location){
        //     DB::table('muvement_logs')->insert([
        //         'unit_id' => $input_data->id,
        //         'location' => $input_data->location
        //     ]);
        // }
    }

    public function delete(Request $data){
        $device_id = $data->device_id;
        DB::table('units')->where('id', '=', $device_id)->delete();
    }
}