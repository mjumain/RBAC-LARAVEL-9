<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
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
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        return view('menus.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_menu' => 'required|string',
        ]);

        if ($validator->fails()) {
            toastr()->error('Menu gagal ditambah </br> Periksa kembali data anda');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        };

        try {
            Menu::insert(
                [
                    'nama_menu' => $request->nama_menu,
                    'url' => $request->url,
                    'parent_id' => $request->parent_id,
                    'icon' => $request->icon,
                    'urutan' => 1,
                ]
            );
            toastr()->success('Menu berhasil disimpan');
            return redirect()->route('manage-menu.index');
        } catch (\Throwable $th) {
            toastr()->warning('Terdapat masalah diserver');
            return redirect()->route('manage-menu.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menus = Menu::all();
        $menu = Menu::findorfail($id);
        return view('menus.edit', compact('menu', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $menu = Menu::findorfail($id);
            $menu->nama_menu = $request->post('nama_menu');
            $menu->url = $request->post('url');
            $menu->parent_id = $request->post('parent_id');
            $menu->update();
            toastr()->success('Menu berhasil disimpan');
            return redirect()->route('manage-menu.index');
        } catch (\Throwable $th) {
            toastr()->warning('Terdapat masalah diserver');
            return redirect()->route('manage-menu.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Menu::findorfail($id)->delete();
            toastr()->success('Menu berhasil dihapus');
            return redirect()->route('manage-menu.index');
        } catch (\Throwable $th) {
            toastr()->warning('Terdapat masalah diserver');
            return redirect()->route('manage-role.index');
        }
    }
}
