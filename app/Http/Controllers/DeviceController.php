<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller{
    public function index(){
        $devices = Device::all();
        $deviceAccounts = array_map(function($device){
            return $deviceAccount = (object)[
                'device' => $device,
                'type' => $device->type(),
                'status' => $device->status(),
                'movements' => $device->movements(),
                'conditions' => $device->conditions(),
            ];
        }, $devices);
    }
    
    public function create(){
        //
    }
    
    public function store(Request $request){
        //
    }
    
    public function show($id){
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
