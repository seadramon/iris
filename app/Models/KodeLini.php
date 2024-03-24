<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeLini extends Model
{
    use HasFactory;

    protected $table = 'tb_lini';
    protected $primaryKey = 'kd_lini';
    protected $keyType = 'string';
}
