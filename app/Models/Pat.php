<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pat extends Model
{
    use HasFactory;

    protected $table = 'hrms.tb_pat';
    protected $primaryKey = 'kd_pat';
    protected $keyType = 'string';
    public $incrementing = false;
}
