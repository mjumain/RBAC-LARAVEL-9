<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:read_user')->only('index', 'show');
        $this->middleware('permission:create_user')->only('create', 'store');
        $this->middleware('permission:update_user')->only('edit', 'update');
        $this->middleware('permission:delete_user')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
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
            'name' => 'required|string',
            'email' => 'required|string|email:rfc|unique:users',
            'role' => 'nullable',
            'verified' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            toastr()->error('Perngguna gagal ditambah </br> Periksa kembali data anda');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        };
        try {
            $data = User::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make('password'),
                    'email_verified_at' => !blank($request->verified) ? now() : null
                ]
            );
            $data->assignRole(!blank($request->role) ? $request->role : array());
            toastr()->success('Pengguna baru berhasil disimpan');
            return redirect()->route('manage-user.index');
        } catch (\Throwable $th) {
            toastr()->warning('Terdapat masalah diserver');
            return redirect()->route('manage-user.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findorfail($id);
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email:rfc',
            'role' => 'nullable',
            'verified' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            toastr()->error('Perngguna gagal ditambah </br> Periksa kembali data anda');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        };

        try {
            $user = User::findorfail($id);
            $user->update(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make('password'),
                    'email_verified_at' => !blank($request->verified) ? now() : null
                ]
            );
            $user->syncRoles(!blank($request->role) ? $request->role : array());
            toastr()->success('Pengguna berhasil diperbarui');
            return redirect()->route('manage-user.index');
        } catch (\Throwable $th) {
            toastr()->warning('Terdapat masalah diserver');
            return redirect()->route('manage-user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
