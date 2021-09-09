<?php

namespace App\Http\Controllers\DeviceAccounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceAccounting\Repair;

class RepairController extends Controller{
    public function index(){
    }
    
    public function create(Request $request){
        return view('components.views.devices.device-table.additionl.info.repair-history-table.rows.form');
    }

    static public function store(Request $request){
        $repair = new Repair;
        $repair->date = $request->date;
        $repair->cause = $request->cause;
        $repair->result = $request->result;
        $repair->condition_id = $request->condition_id;
        $repair->save();

        return json_decode($repair->toJSON());
    }
    
    static function get($filters = null){
        $repairs = Repair::latest('date')->orderByDesc('id');

        if($filters){
            foreach($filters as $propName => $propValueList){
                $repairs->whereIn($propName, $propValueList);
            }
        }

        $result = $repairs->get();
        
        return json_decode($result->toJSON()); // Json converting for model casting method.
    }

    public function show($id){
    }
    
    public function edit($id){
    }
    
    static public function update(Request $request, $id){
        $repair = Repair::find($id);
        $repair->date = $request->date;
        $repair->cause = $request->cause;
        $repair->result = $request->result;

        if($repair->isDirty()){
            $repair->save();
        }

        return $repair;
    }

    static public function destroy($id){
        Repair::find($id)->delete();
    }
}
