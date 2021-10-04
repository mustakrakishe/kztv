<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller{
    public function index(){
        $devices = Device::with('type')
            ->with('lastMovement')
            ->get()
            ->sortByDesc('lastMovement.date')
            ->sortBy('device.inventory_code')
            ->sortBy('device.identification_code');

        $devices->map(function($device){
            $lastModernization = $device->lastModernization;
            $lastRepair = $device->lastRepair;

            $actualCharacteristics = strtotime($lastModernization?->date) > strtotime($lastRepair?->date)
                ? $lastModernization->characteristics
                : $lastRepair->characteristics;

            $device['characteristics'] = $actualCharacteristics;
        });

        return $devices->values()->all();
    }
    
    public function create(){
        //
    }
    
    public function store(Request $request){
        //
    }
    
    public function show($id){
        return $device = Device::with('lastCondition')->find($id);

        return $device = Device::with('type')
            ->with('status')
            ->with('lastMovement')
            ->with('lastCondition')
            ->find($id);
    }
    
    public function edit($id){
        //
    }
    
    public function update(Request $request, $id){
        //
    }
    
    public function destroy($id){
        //
    }
}
