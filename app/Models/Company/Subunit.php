<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subunit extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'dbo.Кадры_Подразделения';
    public $timestamps = false;

    protected static function booted() {
        static::addGlobalScope('not-empty', function (Builder $builder) {
            $builder->where('Название', '!=', '.');
        });
    }
}
