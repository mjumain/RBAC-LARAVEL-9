<?php

namespace App\Helpers;

use App\Models\Menu;
use App\Models\Role;

class MenuHelper
{
    public static function Menu()
    {
        $menus = Menu::where('parent_id', 0)
            ->with('submenus', function ($query) {
                return $query->with('submenus2');
            })
            ->join('role_has_menus as b', 'menus.id', 'b.menu_id')
            ->where('b.role_id', auth()->user()->id)
            ->orderby('urutan', 'asc')
            ->get();
        return json_encode($menus);
    }
}
