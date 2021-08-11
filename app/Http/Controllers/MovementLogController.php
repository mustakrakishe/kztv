<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Devices\MovementLog;

class MovementLogController extends Controller{

    protected function generate_form_view($log){
        return view('components.views.devices.device-table.additional-info.movement-history-table.rows.form', ['log' => $log]);
    }

    public function get_form(Request $data){
        $log = isset($data->id) ? MovementLog::fing($data->id) : null;
        return $this->generate_form_view($log);
    }
}
