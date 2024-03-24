<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FKehandalan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'iris_f_kehandalans';

    protected $with = ['signatures'];

    public function signatures()
    {
        return $this->morphMany(Signature::class, 'source');
    }
}
