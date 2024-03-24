<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetupCetakan extends Model
{
    use HasFactory;

    protected $table = 'iris_setup_cetakans';

    public function cetakan()
    {
        return $this->belongsTo(Cetakan::class, 'kd_cetakan', 'kd_cetakan');
    }

    public function signatures()
    {
        return $this->morphMany(Signature::class, 'source');
    }
}
