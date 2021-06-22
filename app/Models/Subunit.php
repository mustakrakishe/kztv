<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subunit extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'dbo.Кадры_Подразделения';
    public $timestamps = false;
}
