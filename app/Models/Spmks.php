<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spmks extends Model
{
    use HasFactory;

    protected $table = 'spmks_h';
    protected $primaryKey = 'no_spmks';
    public $incrementing = false;
    protected $keyType = 'string';

    const CREATED_AT = 'CREATED_DATE';
    const UPDATED_AT = 'LAST_UPDATE_DATE';

    public function detail()
    {
    	return $this->hasMany(SpmksDetail::class, 'no_spmks', 'no_spmks');
    }

}
