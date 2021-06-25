<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Department extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'dbo.Кадры_Отделы';
    public $timestamps = false;

    protected static function booted() {
        static::addGlobalScope('not-empty', function (Builder $builder) {
            $builder->where('Название', '!=', '.');
        });
    }
}
