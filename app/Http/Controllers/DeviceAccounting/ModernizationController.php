<?php

namespace App\Http\Controllers\DeviceAccounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceAccounting\Modernization;

class ModernizationController extends Controller{
    public function index(){
    }
    
    public function create(Request $request){
        return view('components.views.devices.device-table.additionl.info.modernization-history-table.rows.form');
    }

    static public function store(Request $request){
        $modernization = new Modernization;
        $modernization->date = $request->date;
        $modernization->comment = $request->comment;
        $modernization->condition_id = $request->condition_id;
        $modernization->save();

        return json_decode($modernization->toJSON());
    }
    
    static function get($filters = null){
        $modernizations = Modernization::latest('date')->orderByDesc('id');

        if($filters){
            foreach($filters as $propName => $propValueList){
                $modernizations->whereIn($propName, $propValueList);
            }
        }

        $result = $modernizations->get();
        
        return json_decode($result->toJSON()); // Json converting for model casting method.
    }

    public function show($id){
    }
    
    public function edit($id){
    }
    
    static public function update(Request $request, $id){
        $modernization = Modernization::find($id);
        $modernization->date = $request->date;
        $modernization->comment = $request->comment;

        if($modernization->isDirty()){
            $modernization->save();
        }

        return $modernization;
    }

    static public function destroy($id){
        Modernization::find($id)->delete();
    }
}
