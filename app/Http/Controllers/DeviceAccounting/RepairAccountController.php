<?php

namespace App\Http\Controllers\DeviceAccounting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DeviceAccounting\ConditionController;
use App\Http\Controllers\DeviceAccounting\RepairController;
use Illuminate\Http\Request;
use App\Models\DeviceAccounting\Condition;
use App\Models\DeviceAccounting\Repair;

class RepairAccountController extends Controller{
    
    public function index(){
    }

    public function create(Request $request){
        $deviceId = $request->device_id;
        return $this->generateFormView(compact('deviceId'));
    }
    
    public function store(Request $request){
        $condition = ConditionController::store($request);
        $request->condition_id = $condition->id;
        $repair = RepairController::store($request);

        $repairAccount = $this->build($repair, $condition);

        return $this->generateEntryView($repairAccount);
    }
    
    public function show(Request $request){
        $filters = array('id' => [$request->id]);
        $repairAccount = $this->get($filters)[0];

        return $this->generateEntryView($repairAccount);

    }
    
    static function get($filters = null){

        $repairAccounts = Repair::leftJoin('conditions', 'repairs.condition_id', '=', 'conditions.id')
            ->select(
                'repairs.*',
                'conditions.characteristics',
                'conditions.device_id',
            );

        if($filters){
            if(isset($filters['id'])){
                $filters['repairs.id'] = $filters['id'];
                unset($filters['id']);
            }

            foreach($filters as $propName => $propValueList){
                $repairAccounts->whereIn($propName, $propValueList);
            }
        }

        $result = $repairAccounts
            ->latest('date')
            ->orderByDesc('id')
            ->get();
        
        return json_decode($result->toJSON()); // Json converting for model casting method.
    }
    
    public function edit(Request $request){
        $modenization = Repair::find($request->id);
        $condition = Condition::find($modenization->condition_id);
        $deviceId = $condition->device_id;
        $repairAccount = $this->build($modenization, $condition);
        $data = compact('repairAccount', 'deviceId');

        return view('components.views.devices.device-table.additional-info.repair-history-table.rows.form', $data);
    }
    
    public function update(Request $request){
        $repair = RepairController::update($request, $request->id);
        $condition = ConditionController::update($request, $repair->condition_id);

        $repairAccount = $this->build($repair, $condition);

        return $this->generateEntryView($repairAccount);
    }
    
    public function destroy(Request $request){
        $isDeleted = false;

        $filters = array('id' => [$request->id]);
        $repairToDelete = RepairController::get($filters)[0];
        $filters = array('id' => [$repairToDelete->condition_id]);
        $conditionToDelete = ConditionController::get($filters)[0];

        $condition_id_list = Condition::where('device_id', $conditionToDelete->device_id)->pluck('id');
        $isLastModernisation = Repair::whereIn('condition_id', $condition_id_list)->count() > 1;

        if($isLastModernisation){
            RepairController::destroy($repairToDelete->id);
            ConditionController::destroy($conditionToDelete->id);
            $isDeleted = true;
        }

        return $isDeleted;
    }

    protected function build($repair, $condition){
        $repairAccount = (object)[];
        $repairAccount->id = $repair->id;
        $repairAccount->date = $repair->date;
        $repairAccount->cause = $repair->cause;
        $repairAccount->result = $repair->result;
        $repairAccount->characteristics = $condition->characteristics;
        $repairAccount->device_id = $condition->device_id;

        return $repairAccount;
    }

    protected function generateEntryView($repairAccount){
        return view('components.views.devices.device-table.additional-info.repair-history-table.rows.log', compact('repairAccount'));
    }

    protected function generateFormView($data){
        return view('components.views.devices.device-table.additional-info.repair-history-table.rows.form', $data);
    }
}
