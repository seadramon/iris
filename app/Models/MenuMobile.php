<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuMobile extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'iris_menu_mobiles';

    public function in_role()
    {
        return $this->belongsTo(RoleMenuMobile::class, 'id', 'menu_id');
    }
}
