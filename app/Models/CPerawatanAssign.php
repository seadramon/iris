<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CPerawatanAssign extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'iris_c_perawatan_assigns';

    public function checklist()
    {
    	return $this->hasOne(Checklist::class, 'assign_id', 'id');
    }

    public function form_checklist()
    {
    	return $this->belongsTo(CPerawatan::class, 'c_perawatan_id', 'id');
    }
}
