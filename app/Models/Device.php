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
        return $this->hasOne(Movement::class)->ofMany([
            'date' => 'max',
            'id' => 'max',
        ]);
    }

    public function conditions(){
        return $this->hasMany(Condition::class);
    }

    public function lastCondition(){
        return $lastCondition = $this->hasOne(Condition::class)->ofMany([], function($query){
            $lastModernization = $this->lastModernization;
            $lastRepair = $this->lastRepair;
            $lastModernizationT = strtotime($lastModernization?->date);
            $lastRepairT = strtotime($lastRepair?->date);
            $lastConditionId = $lastModernizationT > $lastRepairT
                ? $lastModernization->condition_id
                : $lastRepair->condition_id;

            $query->where('id', $lastConditionId);
        });
    }

    public function modernizations(){
        return $this->hasManyThrough(Modernization::class, Condition::class);
    }

    public function lastModernization(){
        return $this->hasOneThrough(Modernization::class, Condition::class);
    }

    public function repairs(){
        return $this->hasManyThrough(Repair::class, Condition::class);
    }

    public function lastRepair(){
        return $this->hasOneThrough(Repair::class, Condition::class);
    }
}