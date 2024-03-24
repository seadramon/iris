<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedMaterial extends Model
{
    use HasFactory;

    protected $table = 'iris_used_materials';
    // protected $visible = ['kd_material', 'material.uraian', 'satuan', 'spesifikasi', 'qty', 'jumlah', 'catatan'];
    protected $appends = ['jumlah'];

    public function source()
    {
    	return $this->morphTo();
    }

    public function material()
    {
        return $this->belongsTo(TrMaterial::class, 'kd_material', 'kd_material');
    }

    public function getJumlahAttribute()
    {
        $full = collect([$this->qty, !empty($this->material)?$this->material->satuan:""])->reject(function ($value, $key) {
            return is_null($value);
        });
        return implode(' ', $full->all());
    }
}
