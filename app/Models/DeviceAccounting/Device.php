<?php

namespace App\Models\DeviceAccounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    public $fillable = [
        'inventory_code',
        'identification_code',
        'type_id',
        'model',
        'comment'
    ];
}