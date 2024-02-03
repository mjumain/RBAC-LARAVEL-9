<?php

namespace App\Helpers;

use App\Models\Menu;
use App\Models\Role;

class MenuHelper
{
    public static function Menu()
    {

        $roles = auth()->user()->roles->pluck('id')->toarray();
        $menus = Menu::where('parent_id', 0)
            ->with('roles', function ($query) use ($roles) {
                $query->whereIn('role_id', $roles);
            })
            ->with('submenus', function ($query) {
                $query->join('role_has_menus as b', 'b.menu_id', 'menus.id');
                $query->with('submenus2', function ($query) {
                    $query->join('role_has_menus as b', 'b.menu_id', 'menus.id');
                });
            })
            ->join('role_has_menus as b', 'b.menu_id', 'menus.id')
            ->get();

        return json_encode($menus);
    }
}
