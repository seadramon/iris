<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpmksDetail extends Model
{
    use HasFactory;

    protected $table = 'spmks_d';
    protected $primaryKey = 'no_spmks';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
}
