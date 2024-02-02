@extends('template.app')
@push('css')
@endpush
@section('content')

    <div class="content-wrapper">
        <section class="content-header text-uppercase">
            <h1>
                perbarui role pengguna
            </h1>
        </section>
        <section class="content container-fluid">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quick Example</h3>
                </div>
                <form class="form-horizontal" method="post" action="{{ url('manage-role/' . $role->id_role) }}">
                    @csrf
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Nama Role</label>

                            <div class="col-sm-7">
                                <input class="form-control" id="inputPassword3" placeholder="Nama Role" type="text"
                                    name="nama_role" value="{{ $role->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>

                            <div class="col-sm-7">
                                <textarea class="form-control" name="keterangan_role" placeholder="Deskripsi">{{ $role->keterangan_role }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-sm-6">
                                <label for="inputEmail3">Roles Menu Permission</label>
                                <ul class="checktree">
                                    @foreach ($menus as $menu)
                                        {{-- foreach untuk modul menu --}}
                                        @if (count($menu->submenus) == '0')
                                        <li><input type="checkbox" name="menu_id[]" value="{{ $menu->id_menu }}"
                                            {{ in_array($menu->id_menu, $role_menus) ? 'checked' : '' }}> <b>
                                                    {{ $menu->nama_menu }}</b>
                                                @if (count($menu->permissions) > 0)
                                                <ul>
                                                        @foreach ($menu->permissions as $permission)
                                                            <li>
                                                                <input type="checkbox" name="permission_id[]"
                                                                    value="{{ $permission->id_permission }}"
                                                                    {{ in_array($permission->id_permission, $role_permissions) ? 'checked' : '' }}>
                                                                {!! $permission->detail . '<i>( ' . $permission->name . ' )</i>' !!}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @else
                                            <li>
                                                <i class="{{ $menu->icon }}"></i>
                                                <input type="checkbox" name="menu_id[]" value="{{ $menu->id_menu }}"
                                                    {{ in_array($menu->id_menu, $role_menus) ? 'checked' : '' }}> <b>
                                                    {{ $menu->nama_menu }}</b>
                                                    <ul>
                                                        @foreach ($menu->submenus as $submenu)
                                                        @if (count($submenu->submenus) == 0)
                                                        @dd($submenu->id_menu)
                                                        <li>
                                                                <i class="{{ $submenu->icon }}"></i>
                                                                <input type="checkbox" name="menu_id[]"
                                                                    value="{{ $submenu->id_menu }}"
                                                                    {{ in_array($submenu->id_menu, $role_menus) ? 'checked' : '' }}>
                                                                <b> {{ $submenu->nama_menu }}</b>
                                                                @if (count($submenu->permissions) > 0)
                                                                    <ul>
                                                                        @foreach ($submenu->permissions as $permission)
                                                                            <li>
                                                                                <input type="checkbox"
                                                                                    name="permission_id[]"
                                                                                    value="{{ $permission->id_permission }}"
                                                                                    {{ in_array($permission->id_permission, $role_permissions) ? 'checked' : '' }}>
                                                                                {!! $permission->detail . '<i>( ' . $permission->name . ' )</i>' !!}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif

                                                            </li>
                                                        @else
                                                            <li>
                                                                <i class="{{ $submenu->icon }}"></i>
                                                                <input type="checkbox" name="menu_id[]"
                                                                    value="{{ $submenu->id_menu }}"
                                                                    {{ in_array($submenu->id_menu, $role_menus) ? 'checked' : '' }}>
                                                                <b> {{ $submenu->nama_menu }}</b>
                                                                <ul>
                                                                    @foreach ($submenu->submenus as $submenu2)
                                                                        @if (count($submenu2->submenus) == 0)
                                                                            <li>
                                                                                <input type="checkbox" name="menu_id[]"
                                                                                    value="{{ $submenu2->id_menu }}"
                                                                                    {{ in_array($submenu2->id_menu, $role_menus) ? 'checked' : '' }}>
                                                                                <b> {{ $submenu2->nama_menu }}</b>
                                                                                @if (count($submenu2->permissions) > 0)
                                                                                    <ul>
                                                                                        @foreach ($submenu2->permissions as $permission)
                                                                                            <li>
                                                                                                <input type="checkbox"
                                                                                                    name="permission_id[]"
                                                                                                    value="{{ $permission->id_permission }}"
                                                                                                    {{ in_array($permission->id_permission, $role_permissions) ? 'checked' : '' }}>
                                                                                                {!! $permission->detail . '<i>( ' . $permission->name . ' )</i>' !!}
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endif
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-7">
                                <button class="btn btn-sm btn-primary" type="submit"><i
                                        class="glyphicon glyphicon-floppy-disk"></i> Update</button>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">

                    </div>
                </form>
            </div>
        </section>
    </div>

@endsection
@push('js')
@endpush
