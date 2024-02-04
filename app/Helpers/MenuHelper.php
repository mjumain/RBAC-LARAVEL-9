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
            ->join('role_has_menus as a', 'a.menu_id', 'menus.id')
            ->whereIn('a.role_id', $roles)
            ->get();
        foreach ($menus as $parent) {
            $menu = Menu::where('parent_id', $parent->menu_id)
                ->join('role_has_menus as a', 'a.menu_id', 'menus.id')
                ->whereIn('a.role_id', $roles)
                ->get();
            // dd($parent->id);

            if (count($menu) == 0) {
                $submenu = [];
            } else {
                foreach ($menu as $datasubmenu) {
                    $array_submenu1 = Menu::where('parent_id', $datasubmenu->menu_id)
                        ->join('role_has_menus as a', 'a.menu_id', 'menus.id')
                        ->whereIn('a.role_id', $roles)
                        ->get();

                    if (count($array_submenu1) == 0) {
                        $submenu1 = [];
                    } else {
                        foreach ($array_submenu1 as $datasubmenu1) {
                            $submenu1[] = [
                                'id' => $datasubmenu1->id,
                                'nama_menu' => $datasubmenu1->nama_menu,
                                'url' => $datasubmenu1->url,
                                'icon' => $datasubmenu1->icon,
                            ];
                        }
                    }


                    $submenu[] = [
                        'id' => $datasubmenu->id,
                        'nama_menu' => $datasubmenu->nama_menu,
                        'url' => $datasubmenu->url,
                        'icon' => $datasubmenu->icon,
                        'submenu1' => $submenu1,
                    ];
                }
            }
            $parent_menu[] = [
                'id' => $parent->id,
                'nama_menu' => $parent->nama_menu,
                'url' => $parent->url,
                'icon' => $parent->icon,
                'submenu' => $submenu,
            ];
        }
        return json_encode($parent_menu);
    }
}
