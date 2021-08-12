<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Devices\MovementLog;

class MovementLogController extends Controller{

    public function add(Request $input_data){
        $new_movement_log = new MovementLog;
        $new_movement_log->unit_id = $input_data['unit_id'];
        $new_movement_log->created_at = $input_data['created_at'];
        $new_movement_log->location = $input_data['location'];
        $new_movement_log->comment = $input_data['comment'];
        $new_movement_log->save();

        $movement_log = $this->get_log($new_movement_log->id);
        return $this->generate_log_view($movement_log);
    }

    public function delete(Request $data){
        MovementLog::find($data->id)->delete();
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

    public function get_form(Request $data){
        $log = null;
        $unit_id = null;

        if(isset($data->log_id)){
            $log = MovementLog::find($data->log_id);
            $unit_id = $log->unit_id;
        }
        else{
            $unit_id = $data->unit_id;
        }

        return $this->generate_form_view($log, $unit_id);
    }

    protected function get_log($id){
        $log = $this->get_logs(['ids' => [$id]]);
        return $log[0];
    }

    protected function get_logs($limits = null){
        $logs = MovementLog::orderByDesc('created_at');

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
        $log = MovementLog::find($input_data->id);
        $log->unit_id = $input_data->unit_id;
        $log->created_at = $input_data->created_at;
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
