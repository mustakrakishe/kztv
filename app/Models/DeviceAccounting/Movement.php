<?php

namespace App\Models\DeviceAccounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected function serializeDate($date){
        return $date->format('d.m.Y H:i');
    }
}