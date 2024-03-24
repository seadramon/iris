<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetupCetakanDetail extends Model
{
    use HasFactory;

    protected $table = 'iris_setup_cetakan_details';

    public function setup_cetakan()
    {
        return $this->belongsTo(SetupCetakan::class, 'setup_id');
    }
    
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'no_inventaris', 'no_inventaris');
    }

    public function signatures()
    {
        return $this->morphMany(Signature::class, 'source');
    }
}
