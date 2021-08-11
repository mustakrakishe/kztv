<?php

namespace App\Models\Devices;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementLog extends Model
{
    use HasFactory;

    protected function serializeDate($date){
        return $date->format('Y-m-d');
    }
}