<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Devices\Type;
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

    public function update(Request $data){
        $input_data = $data->device;

        // firstOrCreate() has a bug with a duplication of the id (visit https://github.com/laravel/framework/issues/19372)
        $type_db_record = DB::table('types')
            ->where('name', $input_data['type'])
            ->get()
            ->first();

        $type_id = $type_db_record->id;

        $qr = $type_id;
        if($type_id == null){
            $qr = DB::table('types')
                ->insert(
                    ['name' => $input_data['type']]
                );

            $type_id = $type->id;
        }

        return $qr;

        // $device = DB::table('units')->find($device->id);
        
        // foreach ($device as $prop_name => $prop_val) {
        //     if($prop_val != $input_data->$prop_name){
        //         $device->$prop_val = $input_data->$prop_name;
        //     }
        // }

        // $device->save();

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