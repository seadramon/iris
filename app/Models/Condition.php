<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;

    protected $table = 'tb_kondisi';
    protected $primaryKey = 'kd_kondisi';
    protected $keyType = 'string';
}
