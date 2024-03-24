<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CPerawatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'iris_c_perawatans';

    public function detail()
    {
        return $this->hasMany(CPerawatanDetail::class, 'c_perawatan_id', 'id');
    }

    public function assigns()
    {
    	return $this->hasMany(CPerawatanAssign::class, 'c_perawatan_id', 'id');
    }
    
    public function latest_assign()
    {
    	return $this->hasOne(CPerawatanAssign::class, 'c_perawatan_id', 'id')->orderBy('periode_awal', 'desc');
    }
}
