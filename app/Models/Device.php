<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Device extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    public $fillable = [
        'inventory_code',
        'identification_code',
        'model',
        'comment',
        'type_id',
        'status_id',
    ];
    
    public $searchable = [
        'inventory_code',
        'identification_code',
        'model',
        'comment',
    ];

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function movements(){
        return $this->hasMany(Movement::class);
    }

    public function lastMovement(){
        return $this->hasOne(Movement::class);
    }

    public function modernizations(){
        return $this->hasMany(Modernization::class);
    }

    public function lastModernization(){
        return $this->hasOne(Modernization::class);
    }

    public function repairs(){
        return $this->hasMany(Repair::class);
    }

    public function lastRepair(){
        return $this->hasOne(Repair::class);
    }
}