<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'dbo.Кадры_Отделы';
    public $timestamps = false;
}
