<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\Devices\Unit;
// use App\Models\Devices\IdentificationCode;
// use App\Models\Devices\Manufacture;
// use App\Models\Devices\DeviceModel;

class DeviceController extends Controller
{
    public function show()
    {
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

    public function add(){
        return view('device.add');
    }

    public function delete(Request $data){
        $device_id = $data->device_id;
        DB::table('units')->where('id', '=', $device_id)->delete();
        return redirect()->route('devices');
    }
}