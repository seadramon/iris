<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Functional extends Model
{
    use HasFactory;

    protected $table = 'tb_fungsi';
    protected $primaryKey = 'kd_fungsi';
    protected $keyType = 'string';
}
