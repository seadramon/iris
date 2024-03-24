<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class FPengecekan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'iris_f_pengecekans';
    protected $appends = ['status_label'];

    public function getStatusLabelAttribute()
    {
        return 'Done';
    }

    public function detail()
    {
    	return $this->hasMany(FPengecekanDetail::class, 'pengecekan_id', 'id');
    }

    public function signatures()
    {
        return $this->morphMany(Signature::class, 'source');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'no_inventaris', 'no_inventaris');
    }
}
