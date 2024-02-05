<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:read_role')->only('index', 'show');
        $this->middleware('permission:create_role')->only('create', 'store');
        $this->middleware('permission:update_role')->only('edit', 'update');
        $this->middleware('permission:delete_role')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::where('parent_id', 0)->get();
        return view('roles.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $role = Role::create(['name' => strtolower($request->name)]);
            foreach ($request->menu_id as $value) {
                DB::table('role_has_menus')->insert([
                    'menu_id' => $value,
                    'role_id' => $role->id,
                ]);
            }
            $role->syncPermissions($request->permission_id);
            toastr()->success('Role berhasil disimpan');
            return redirect()->route('manage-role.index');
        } catch (\Throwable $th) {
            toastr()->warning('Terdapat masalah diserver');
            return redirect()->route('manage-role.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menus = Menu::where('parent_id', 0)->get();
        $role = Role::findorfail($id);
        $getmenus = DB::table('role_has_menus')->where('role_id', $id)->get();

        $permissions = DB::table('permissions')
            ->join('role_has_permissions as a', 'a.permission_id', 'permissions.id')
            ->where('a.role_id', $role->id)
            ->get();
        return view('roles.edit', compact('role', 'menus', 'getmenus', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::table('role_has_menus')->where('role_id', $id)->delete();
            $role = Role::findorfail($id);
            foreach ($request->menu_id as $value) {
                DB::table('role_has_menus')->insert([
                    'menu_id' => $value,
                    'role_id' => $role->id,
                ]);
            }

            $role = Role::findorfail($id);
            $role->update(
                [
                    'name' => $request->name,
                ]
            );

            $role->syncPermissions($request->permission_id);
            toastr()->success('Role berhasil disimpan');
            return redirect()->route('manage-role.index');
        } catch (\Throwable $th) {
            toastr()->warning('Terdapat masalah diserver');
            return redirect()->route('manage-role.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Menu::findorfail($id)->delete();
        try {
            DB::table('role_has_menus')->where('role_id', $id)->delete();
            Role::findorfail($id)->delete();
            toastr()->success('Role berhasil dihapus');
            return redirect()->route('manage-role.index');
        } catch (\Throwable $th) {
            toastr()->warning('Terdapat masalah diserver');
            return redirect()->route('manage-role.index');
        }
    }
}
