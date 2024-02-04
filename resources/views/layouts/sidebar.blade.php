<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    {{-- @dd(json_decode(MenuHelper::Menu())) --}}
    @foreach (json_decode(MenuHelper::Menu()) as $menu)
        <li class="nav-header">{{ strtoupper($menu->nama_menu) }}</li>
        @foreach ($menu->submenu as $submenu)
            @if (count($submenu->submenu1) == '0')
                <li class="nav-item">
                    <a href="{{ url($submenu->url) }}" class="nav-link">
                        <i class="nav-icon {{ $submenu->icon }}"></i>
                        <p>
                            {{ ucwords($submenu->nama_menu) }}
                        </p>
                    </a>
                </li>
            @else
                @foreach ($submenu->submenu1 as $url)
                    @php
                        $urls[] = $url->url;
                    @endphp
                @endforeach
                <li class="nav-item {{ in_array(Request::segment(1), $urls) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ in_array(Request::segment(1), $urls) ? 'active' : '' }}">
                        <i class="nav-icon {{ $submenu->icon }}"></i>
                        <p>
                            {{ ucwords($submenu->nama_menu) }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($submenu->submenu1 as $endmenu)
                            <li class="nav-item">
                                <a href="{{ url($endmenu->url) }}"
                                    class="nav-link {{ Request::segment(1) == $endmenu->url ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ ucwords($endmenu->nama_menu) }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    @endforeach
</ul>
