<?php

namespace App\Helpers;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class MenuHelper
{
    public static function Menu()
    {
        $menu_roles = DB::table('role_has_menus')->where('role_id', auth()->user()->id)->get();
        foreach ($menu_roles as  $value) {
            $array_menu_roles[] = $value->menu_id;
        }
        $menus = Menu::where('parent_id', 0)
            ->with('submenus', function ($query) use ($array_menu_roles) {
                $query->whereIn('id', $array_menu_roles);
                $query->with('submenus', function ($query) use ($array_menu_roles) {
                    $query->whereIn('id', $array_menu_roles);
                });
            })
            ->whereIn('id', $array_menu_roles)
            ->get();
        return json_encode($menus);
    }
}
