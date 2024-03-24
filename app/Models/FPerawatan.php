<?php

namespace App\Models;

use App\Casts\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class FPerawatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'iris_f_perawatans';

    protected $with = ['signatures']; 
    protected $appends = ['status_label'];

    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 'operator':
                $status = 'Approved By Operator';
                break;
            case 'teknisi':
                $status = 'Technician Finished';
                break;
            case 'baru':
                $status = 'New';
                break;
                
            default:
                $status = Str::of($this->status)->studly()->value;
                break;
        }
        return $status;
    }

    public function signatures()
    {
        return $this->morphMany(Signature::class, 'source');
    }

    public function usedMaterials()
    {
        return $this->morphMany(UsedMaterial::class, 'source');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'no_inventaris', 'no_inventaris');
    }
}
