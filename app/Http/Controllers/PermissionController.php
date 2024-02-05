<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission as ModelsPermission;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:read_menu')->only('index', 'show');
        $this->middleware('permission:create_menu')->only('create', 'store');
        $this->middleware('permission:update_menu')->only('edit', 'update');
        $this->middleware('permission:delete_menu')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            ModelsPermission::create([
                'name' => $request->permission,
                'menu_id' => $request->menu_id
            ]);
            toastr()->success('Permission berhasil disimpan');
            return redirect()->route('manage-menu.index');
        } catch (\Throwable $th) {
            toastr()->warning('Terdapat masalah diserver');
            return redirect()->route('manage-menu.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            ModelsPermission::findorfail($id)->delete();
            toastr()->success('Permission berhasil dihapus');
            return redirect()->route('manage-menu.index');
        } catch (\Throwable $th) {
            toastr()->warning('Terdapat masalah diserver');
            return redirect()->route('manage-role.index');
        }
    }
}
