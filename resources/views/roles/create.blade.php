@extends('template.app')
@push('css')
   
@endpush
@section('content')

    <div class="content-wrapper">
        <section class="content-header text-uppercase">
            <h1>
                tambah role pengguna
            </h1>
        </section>
        <section class="content container-fluid">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quick Example</h3>
                </div>
                <div class="box-body">
                    <div class="col-sm-12">
                        <label for="inputEmail3">Roles Menu Permission</label>
                        <ul class="checktree">
                            @foreach ($menus as $menu)
                                @if (count($menu->submenus) == '0')
                                    <li><input type="checkbox" name="menu_id[]" value="{{ $menu->id }}"> <b>
                                            {{ $menu->nama_menu }}</b>
                                        @if (count($menu->permissions) > 0)
                                            <ul>
                                                @foreach ($menu->permissions as $permission)
                                                    <li>
                                                        <input type="checkbox" name="permission_id[]"
                                                            value="{{ $permission->id }}">
                                                        {!! $permission->detail . '<i>( ' . $permission->permission . ' )</i>' !!}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @else
                                    <li>
                                        <input type="checkbox" name="menu_id[]" value="{{ $menu->id }}"> <b>
                                            {{ $menu->nama_menu }}</b>
                                        <ul>
                                            @foreach ($menu->submenus as $submenu)
                                                @if (count($submenu->submenus) == 0)
                                                    <li>
                                                        <input type="checkbox" name="menu_id[]"
                                                            value="{{ $submenu->id }}"> <b>
                                                            {{ ucwords($submenu->nama_menu) }}</b>
                                                        @if (count($submenu->permissions) > 0)
                                                            <ul>
                                                                @foreach ($submenu->permissions as $permission)
                                                                    <li>
                                                                        <input type="checkbox" name="permission_id[]"
                                                                            value="{{ $permission->id }}">
                                                                        {!! $permission->detail . '<i>( ' . $permission->permission . ' )</i>' !!}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @else
                                                    <li>
                                                        <input type="checkbox" name="menu_id[]"
                                                            value="{{ $submenu->id }}"> <b>
                                                            {{ $submenu->nama_menu }}</b>
                                                        <ul>
                                                            @foreach ($submenu->submenus as $submenu2)
                                                                @if (count($submenu2->submenus) == 0)
                                                                    <li>
                                                                        <input type="checkbox" name="menu_id[]"
                                                                            value="{{ $submenu2->id }}"> <b>
                                                                            {{ $submenu2->nama_menu }}</b>
                                                                        @if (count($submenu2->permissions) > 0)
                                                                            <ul>
                                                                                @foreach ($submenu2->permissions as $permission)
                                                                                    <li>
                                                                                        <input type="checkbox"
                                                                                            name="permission_id[]"
                                                                                            value="{{ $permission->id }}">
                                                                                        {!! $permission->detail . '<i>(' . $permission->name . ' )</i>' !!}
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
            </div>
        </section>
    </div>

@endsection
@push('js')
@endpush
