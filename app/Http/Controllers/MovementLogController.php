<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Devices\MovementLog;

class MovementLogController extends Controller{

    public function add(Request $input_data){
        
        $new_movement_log = new MovementLog;
        $new_movement_log->unit_id = $input_data['device_id'];
        $new_movement_log->created_at = $input_data['created_at'];
        $new_movement_log->location = $input_data['location'];
        $new_movement_log->comment = $input_data['comment'];
        $new_device->save();

        return $this->generate_log_view($new_device);
    }

    protected function generate_form_view($log, $unit_id){
        return view('components.views.devices.device-table.additional-info.movement-history-table.rows.form', ['log' => $log, 'unit_id' =>  $unit_id]);
    }

    public function get_form(Request $data){
        $log = null;
        $unit_id = null;

        if(isset($data->log_id)){
            $log = MovementLog::fing($data->log_id);
            $unit_id = $log->unit_id;
        }
        else{
            $unit_id = $data->unit_id;
        }

        return $this->generate_form_view($log, $unit_id);
    }
}
