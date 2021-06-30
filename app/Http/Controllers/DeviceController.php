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

        $departmentsInfo = DB::table('departments')
            ->leftJoin('subunits', 'departments.subunit_id', '=', 'subunits.id')
            ->select(
                'departments.id',
                'subunits.shortName as subunit',
                'departments.shortName as department',
            );

        $locationsInfo = DB::table('locations')
            ->leftJoinSub($departmentsInfo, 'departmentsInfo', function ($leftJoin) {
                $leftJoin->on('locations.department_id', '=', 'departmentsInfo.id');
            })
            ->select(
                'locations.id',
                'departmentsInfo.subunit',
                'departmentsInfo.department',
                'locations.workplace'
            );

        $movement_logsInfo = DB::table('movement_logs')
            ->leftJoinSub($locationsInfo, 'locationsInfo', function ($leftJoin) {
                $leftJoin->on('movement_logs.location_id', '=', 'locationsInfo.id');
            })
            ->select(
                'movement_logs.unit_id',
                'locationsInfo.subunit',
                'locationsInfo.department',
                'locationsInfo.workplace'
            );

        $devices = DB::table('units')
            ->leftJoin('identification_codes', 'units.id', '=', 'identification_codes.unit_id')
            ->leftjoin('types', 'units.type_id', '=', 'types.id')
            ->leftJoinSub($modelsInfo, 'modelsInfo', function ($leftJoin) {
                $leftJoin->on('units.device_model_id', '=', 'modelsInfo.id');
            })
            ->leftJoinSub($movement_logsInfo, 'movement_logsInfo', function ($leftJoin) {
                $leftJoin->on('units.id', '=', 'movement_logsInfo.unit_id');
            })
            ->select(
                'units.inventory_code',
                'identification_codes.value as identification_code',
                'types.name as type',
                'modelsInfo.manufacture',
                'modelsInfo.model',
                'movement_logsInfo.subunit',
                'movement_logsInfo.department',
                'movement_logsInfo.workplace',
            )
            ->get();
        return view('devices', ['devices' => $devices]);
    }

    public function add()
    {
        return view('device.add');
    }
}