<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function show()
    {
        
    }

    public function add()
    {
        return view('device.add', [
            'user' => User::findOrFail($id)
        ]);
    }
}
