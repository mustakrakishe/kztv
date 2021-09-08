<?php

namespace App\Http\Controllers\DeviceAccounting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DeviceAccounting\ConditionController;
use App\Http\Controllers\DeviceAccounting\ModernizationController;
use Illuminate\Http\Request;
use App\Models\DeviceAccounting\Condition;
use App\Models\DeviceAccounting\Modernization;

class ModernizationAccountController extends Controller{
    
    public function index(){
        
    }

    public function create(Request $request){
        $deviceId = $request->device_id;
        return view('components.views.devices.device-table.additional-info.modernization-history-table.rows.form', compact('deviceId'));
    }
    
    public function store(Request $request){
        $condition = ConditionController::store($request);
        $request->condition_id = $condition->id;
        $modernization = ModernizationController::store($request);

        
        $modernizationAccount = (object)[];
        $modernizationAccount->id = $modernization->id;
        $modernizationAccount->date = $modernization->date;
        $modernizationAccount->characteristics = $condition->characteristics;
        $modernizationAccount->comment = $modernization->comment;

        return $this->generateEntryView($modernizationAccount);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    static function get($filters = null){

        $modernizationAccounts = Modernization::rightJoin('conditions', 'modernizations.condition_id', '=', 'conditions.id')
            ->select(
                'modernizations.*',
                'conditions.characteristics'
            );
            

        if($filters){
            foreach($filters as $propName => $propValueList){
                $modernizationAccounts->whereIn($propName, $propValueList);
            }
        }

        $result = $modernizationAccounts
            ->latest('date')
            ->orderByDesc('id')
            ->get();
        
        return json_decode($result->toJSON()); // Json converting for model casting method.
    }
    
    public function edit($id){
    }
    
    public function update(Request $request, $id){
    }
    
    public function destroy($id){
    }

    protected function generateEntryView($modernizationAccount){
        return view('components.views.devices.device-table.additional-info.modernization-history-table.rows.log', compact('modernizationAccount'));
    }
}
