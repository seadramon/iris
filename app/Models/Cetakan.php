<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cetakan extends Model
{
    use HasFactory;

    protected $table      = 'tb_cetakan';
    protected $primaryKey = 'kd_cetakan';
    protected $keyType    = 'string';
}
