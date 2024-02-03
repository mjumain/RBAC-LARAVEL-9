<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $roles = auth()->user()->roles->pluck('id')->toarray();

        $datas = Menu::with('roles', function ($query) use ($roles) {
            return $query->whereIn('role_id', $roles);
        });


        dd($datas);
        return view('home');
    }
}
