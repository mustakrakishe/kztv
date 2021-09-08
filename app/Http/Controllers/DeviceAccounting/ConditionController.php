<?php

namespace App\Http\Controllers\DeviceAccounting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DeviceAccounting\Condition;

class ConditionController extends Controller{
    static public function store(Request $request){
        $condition = new Condition;
        $condition->device_id = $request->device_id;
        $condition->characteristics = $request->characteristics;
        $condition->save();

        return $condition;
    }

    static public function update(Request $request, $id){
        $condition = Condition::find($id);
        $condition->characteristics = $request->characteristics;

        if($condition->isDirty()){
            $condition->save();
        }

        return $condition;
    }
    
    static public function get($filters = null){
        $conditions = Condition::orderByDesc('id');

        if($filters){
            foreach($filters as $propName => $propValueList){
                $conditions->whereIn($propName, $propValueList);
            }
        }

        $result = $conditions->get();
        
        return json_decode($result->toJSON()); // Json converting for model casting method.
    }

    static public function destroy($id){
        Condition::find($id)->delete();
    }
}
