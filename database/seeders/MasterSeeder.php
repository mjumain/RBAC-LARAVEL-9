<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::create([
            'nama_menu' => 'Menu Manajemen',
            'url' => '#',
            'icon' => '',
            'parent_id' => '0',
            'urutan' => 1
        ]);

        Menu::create([
            'nama_menu' => 'Dashboard',
            'url' => 'home',
            'icon' => 'fas fa-home',
            'parent_id' => $menu->id,
            'urutan' => 1
        ]);

        $submenu = Menu::create([
            'nama_menu' => 'Manajemen Pengguna',
            'url' => '#',
            'icon' => 'fas fa-users-cog',
            'parent_id' => $menu->id,
            'urutan' => 2
        ]);
        $menu_id = Menu::create([
            'nama_menu' => 'Kelola Pengguna',
            'url' => 'manage-user',
            'parent_id' => $submenu->id,
            'urutan' => 1
        ]);

        Permission::create(['name' => 'create_user', 'menu_id' => $menu_id->id]);
        Permission::create(['name' => 'read_user', 'menu_id' => $menu_id->id]);
        Permission::create(['name' => 'update_user', 'menu_id' => $menu_id->id]);
        Permission::create(['name' => 'delete_user', 'menu_id' => $menu_id->id]);

        $menu_id = Menu::create([
            'nama_menu' => 'Kelola Role',
            'url' => 'manage-role',
            'parent_id' => $submenu->id,
            'urutan' => 2
        ]);

        Permission::create(['name' => 'create_role', 'menu_id' => $menu_id->id]);
        Permission::create(['name' => 'read_role', 'menu_id' => $menu_id->id]);
        Permission::create(['name' => 'update_role', 'menu_id' => $menu_id->id]);
        Permission::create(['name' => 'delete_role', 'menu_id' => $menu_id->id]);

        $menu_id = Menu::create([
            'nama_menu' => 'Kelola Menu',
            'url' => 'manage-menu',
            'parent_id' => $submenu->id,
            'urutan' => 3
        ]);

        Permission::create(['name' => 'create_menu', 'menu_id' => $menu_id->id]);
        Permission::create(['name' => 'read_menu', 'menu_id' => $menu_id->id]);
        Permission::create(['name' => 'update_menu', 'menu_id' => $menu_id->id]);
        Permission::create(['name' => 'delete_menu', 'menu_id' => $menu_id->id]);

        $menu = Menu::create([
            'nama_menu' => 'Backup Server',
            'url' => '#',
            'icon' => '',
            'parent_id' => '0',
            'urutan' => 2
        ]);

        $menu_id = Menu::create([
            'nama_menu' => 'Backup Database',
            'url' => 'dbbackup',
            'icon' => 'fas fa-database',
            'parent_id' => $menu->id,
            'urutan' => 1
        ]);

        Permission::create(['name' => 'backup_database', 'menu_id' => $menu_id->id]);

        DB::insert('insert into role_has_menus (menu_id, role_id) values (?, ?)', [1, 1]);
        DB::insert('insert into role_has_menus (menu_id, role_id) values (?, ?)', [2, 1]);
        DB::insert('insert into role_has_menus (menu_id, role_id) values (?, ?)', [3, 1]);
        DB::insert('insert into role_has_menus (menu_id, role_id) values (?, ?)', [4, 1]);
        DB::insert('insert into role_has_menus (menu_id, role_id) values (?, ?)', [5, 1]);
        DB::insert('insert into role_has_menus (menu_id, role_id) values (?, ?)', [6, 1]);
        DB::insert('insert into role_has_menus (menu_id, role_id) values (?, ?)', [7, 1]);
        DB::insert('insert into role_has_menus (menu_id, role_id) values (?, ?)', [8, 1]);

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
        ]);

        $superadmin = Role::create(['name' => 'superadmin']);
        $superadmin->givePermissionTo(Permission::all());
        User::firstWhere('email', 'superadmin@gmail.com')->assignRole('superadmin');
    }
}
