<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jalur extends Model
{
    use HasFactory;

    protected $table = 'oee_ref_jalur_h';
    protected $primaryKey = 'jalur';
    protected $keyType = 'string';
    public $incrementing = false;

    public function pat()
    {
    	return $this->belongsTo(Pat::class, 'kode_pat', 'kd_pat');
    }
}
