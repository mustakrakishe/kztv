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
        $modelsInfo = DB::table('device_models')
                ->join('types', 'device_models.type_id', '=', 'types.id')
                ->join('manufactures', 'device_models.manufacture_id', '=', 'manufactures.id')
                ->select(
                    'device_models.id as id',
                    'manufactures.name as manufacture',
                    'device_models.name as model'
                );

        $devices = DB::table('units')
            ->leftJoin('identification_codes', 'units.id', '=', 'identification_codes.unit_id')
            ->leftjoin('types', 'units.type_id', '=', 'types.id')
            ->leftJoinSub($modelsInfo, 'modelsInfo', function ($leftJoin) {
                $leftJoin->on('units.device_model_id', '=', 'modelsInfo.id');
            })
            ->select(
                'units.inventory_code',
                'identification_codes.value as identification_code',
                'types.name as type',
                'modelsInfo.manufacture',
                'modelsInfo.model'
            )
            ->get();
        return view('devices', ['devices' => $devices]);
    }

    public function add()
    {
        return view('device.add');
    }
}