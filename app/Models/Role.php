<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'iris_roles';

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'iris_role_menus');
    }
    
    public function mobile_menus()
    {
        return $this->belongsToMany(MenuMobile::class, 'iris_role_menu_mobiles', 'role_id', 'menu_id');
    }
}
