<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'iris_menus';

    public function in_role()
    {
        return $this->belongsTo(RoleMenu::class, 'id', 'menu_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'iris_role_menus');
    }

    public function childmenus()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
