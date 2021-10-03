<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Repair extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected static function boot(){
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->latest('date')->orderByDesc('id');
        });
    }
}
