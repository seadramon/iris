<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Signature extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'iris_signatures';

    public function source()
    {
    	return $this->morphTo();
    }

    public function pic()
    {
        return $this->belongsTo(Pic::class, 'sign_by', 'employee_id');
    }
}
