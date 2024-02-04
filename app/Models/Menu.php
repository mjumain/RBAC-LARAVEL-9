<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function submenus()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_has_menus', 'menu_id', 'role_id');
    }
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'menu_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id');
    }
}
