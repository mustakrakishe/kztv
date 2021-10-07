<?php

namespace App\Http\Controllers\DeviceAccounting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DeviceAccounting\Movement;

class MovementController extends Controller{

    public function store(Request $input_data){
        $new_movement = new Movement;
        $new_movement->device_id = $input_data['device_id'];
        $new_movement->date = $input_data['date'];
        $new_movement->location = $input_data['location'];
        $new_movement->comment = $input_data['comment'];
        $new_movement->save();

        $filters['id'] = [$new_movement->id];
        $movement = ($this->get($filters))[0];
        return $this->generate_log_view($movement);
    }

    public function delete(Request $data){
        $isDeleted = false;

        $log_to_delete = Movement::find($data->id);
        if(Movement::where('device_id', $log_to_delete->device_id)->count() > 1){
            $log_to_delete->delete();
            $isDeleted = true;
        }

        return $isDeleted;
    }

    protected function generate_form_view($log, $device_id){
        return view('components.views.devices.device-table.additional-info.movement-history-table.rows.form', ['log' => $log, 'device_id' =>  $device_id]);
    }

    protected function generate_log_view($log){
        return view('components.views.devices.device-table.additional-info.movement-history-table.rows.log', compact('log'));
    }

    public function get_log_view(Request $data){
        $filters['id'] = [$data->id];
        $log = $this->get($filters)[0];
        return $this->generate_log_view($log);
    }

    public function get_form_view(Request $request){
        $log = null;
        $device_id = null;

        if(isset($request->log_id)){
            $log = Movement::find($request->log_id);
            $device_id = $log->device_id;
        }
        else{
            $device_id = $request->device_id;
        }

        return $this->generate_form_view($log, $device_id);
    }

    public static function get($filters = null){
        $movements = Movement::latest('date')->orderByDesc('id');

        if($filters){
            if(isset($filters['id'])){
                $movements->whereIn('id', $filters['id']);
            }
    
            if(isset($filters['device_id'])){
                $movements->whereIn('device_id', $filters['device_id']);
            }
        }

        $result = $movements->get();
        
        return json_decode($result->toJSON()); // Json converting for model property MovementLog::casts casts a created_at field.
    }

    public function update(Request $input_data){
        $log = Movement::find($input_data->id);
        $log->date = $input_data->date;
        $log->location = $input_data->location;
        $log->comment = $input_data->comment;
        $log->save();

        if($log->isDirty()){
            $log->save();
        }

        $filters['id'] = [$log->id];
        $updated_log = $this->get($filters);
        return $this->generate_log_view($updated_log[0]);
    }
}
