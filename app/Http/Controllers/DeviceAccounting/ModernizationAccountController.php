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
        return $this->generateFormView(compact('deviceId'));
    }
    
    public function store(Request $request){
        $condition = ConditionController::store($request);
        $request->condition_id = $condition->id;
        $modernization = ModernizationController::store($request);

        $modernizationAccount = $this->build($modernization, $condition);

        return $this->generateEntryView($modernizationAccount);
    }
    
    public function show(Request $request){
        $filters = array('id' => [$request->id]);
        $modernizationAccount = $this->get($filters)[0];

        return $this->generateEntryView($modernizationAccount);

    }
    
    static function get($filters = null){

        $modernizationAccounts = Modernization::leftJoin('conditions', 'modernizations.condition_id', '=', 'conditions.id')
            ->select(
                'modernizations.*',
                'conditions.characteristics',
                'conditions.device_id',
            );

        if($filters){
            if(isset($filters['id'])){
                $filters['modernizations.id'] = $filters['id'];
                unset($filters['id']);
            }

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
    
    public function edit(Request $request){
        $modenization = Modernization::find($request->id);
        $condition = Condition::find($modenization->condition_id);
        $deviceId = $condition->device_id;
        $modernizationAccount = $this->build($modenization, $condition);
        $data = compact('modernizationAccount', 'deviceId');

        return view('components.views.devices.device-table.additional-info.modernization-history-table.rows.form', $data);
    }
    
    public function update(Request $request){
        $modernization = ModernizationController::update($request, $request->id);
        $condition = ConditionController::update($request, $modernization->condition_id);

        $modernizationAccount = $this->build($modernization, $condition);

        return $this->generateEntryView($modernizationAccount);
    }
    
    public function destroy(Request $request){
        $isDeleted = false;

        $filters = array('id' => [$request->id]);
        $modernizationToDelete = ModernizationController::get($filters)[0];
        $filters = array('id' => [$modernizationToDelete->condition_id]);
        $conditionToDelete = ConditionController::get($filters)[0];

        $condition_id_list = Condition::where('device_id', $conditionToDelete->device_id)->pluck('id');
        $isLastModernisation = Modernization::whereIn('condition_id', $condition_id_list)->count() > 1;

        if($isLastModernisation){
            ModernizationController::destroy($modernizationToDelete->id);
            ConditionController::destroy($conditionToDelete->id);
            $isDeleted = true;
        }

        return $isDeleted;
    }

    protected function build($modernization, $condition){
        $modernizationAccount = (object)[];
        $modernizationAccount->id = $modernization->id;
        $modernizationAccount->date = $modernization->date;
        $modernizationAccount->comment = $modernization->comment;
        $modernizationAccount->characteristics = $condition->characteristics;
        $modernizationAccount->device_id = $condition->device_id;

        return $modernizationAccount;
    }

    protected function generateEntryView($modernizationAccount){
        return view('components.views.devices.device-table.additional-info.modernization-history-table.rows.log', compact('modernizationAccount'));
    }

    protected function generateFormView($data){
        return view('components.views.devices.device-table.additional-info.modernization-history-table.rows.form', $data);
    }
}
