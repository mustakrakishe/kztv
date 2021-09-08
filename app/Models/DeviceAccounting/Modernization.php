<?php

namespace App\Models\DeviceAccounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modernization extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $casts = [
        'date' => 'datetime:d.m.Y H:i',
    ];
}
