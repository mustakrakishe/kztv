<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Modernization extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $casts = [
        'date' => 'datetime:d.m.Y H:i',
    ];

    protected static function boot(){
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->latest('date')->orderByDesc('id');
        });
    }
}
