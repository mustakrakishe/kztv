<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DeviceController extends Controller
{
    public function show()
    {
        return view('devices', [
            'departments' => Department::all()
        ]);
    }
}
