<?php

namespace App\Http\Controllers\DeviceAccounting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DeviceAccounting\Movement;

class MovementController extends Controller{

    public function add(Request $input_data){
        $new_movement_log = new Movement;
        $new_movement_log->device_id = $input_data['device_id'];
        $new_movement_log->date = $input_data['date'];
        $new_movement_log->location = $input_data['location'];
        $new_movement_log->comment = $input_data['comment'];
        $new_movement_log->save();

        $movement_log = $this->get_log($new_movement_log->id);
        return $this->generate_log_view($movement_log);
    }

    public function delete(Request $data){
        $isDeleted = false;

        $log_to_delete = Movement::find($data->id);
        if(Movement::where('device_id', $log_to_delete->unit_id)->count() > 1){
            $log_to_delete->delete();
            $isDeleted = true;
        }

        return $isDeleted;
    }

    protected function generate_form_view($log, $unit_id){
        return view('components.views.devices.device-table.additional-info.movement-history-table.rows.form', ['log' => $log, 'unit_id' =>  $unit_id]);
    }

    protected function generate_log_view($log){
        return view('components.views.devices.device-table.additional-info.movement-history-table.rows.log', ['log' => $log]);
    }

    public function get_log_view(Request $data){
        $log = $this->get_log($data->id);
        return $this->generate_log_view($log);
    }

    public function get_form_view(Request $request){
        $log = null;
        $unit_id = null;

        if(isset($request->log_id)){
            $log = Movement::find($request->log_id);
            $unit_id = $log->unit_id;
        }
        else{
            $unit_id = $request->unit_id;
        }

        return $this->generate_form_view($log, $unit_id);
    }

    protected function get_log($id){
        $log = $this->get_logs(['ids' => [$id]]);
        return $log[0];
    }

    protected function get_logs($limits = null){
        $logs = Movement::orderByDesc('date');

        if(isset($limits['ids'])){
            $logs->whereIn('id', $limits['ids']);
        }

        if(isset($limits['unit_ids'])){
            $logs->whereIn('id', $limits['unit_ids']);
        }

        $result = $logs->get();
        
        return json_decode($result->toJSON()); // Json converting for model property MovementLog::casts casts a created_at field.
    }

    public function update(Request $input_data){
        $log = Movement::find($input_data->id);
        $log->device_id = $input_data->device_id;
        $log->date = $input_data->date;
        $log->location = $input_data->location;
        $log->comment = $input_data->comment;
        $log->save();

        if($log->isDirty()){
            $log->save();
        }

        $updated_log = $this->get_log($log->id);
        return $this->generate_log_view($updated_log);
    }
}
