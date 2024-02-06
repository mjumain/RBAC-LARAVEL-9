<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UM JAMBI</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('') }}plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    @stack('css')
    <link rel="stylesheet" href="{{ asset('') }}dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Preloader -->
    {{-- <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('') }}dist/img/logo-umjambi.png" alt="UM Jambi Logo"
            height="80" width="80">
    </div> --}}
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto ">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="../../dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2"
                            alt="User Image">
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <li class="user-header bg-info">
                            <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-3" alt="User Image">
                            <p>
                                {{ Auth::user()->name }}
                                <small>Universitas Muhammadiyah Jambi</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <a href="{{ route('profil.index') }}" class="btn btn-default btn-flat">Profil</a>
                            <a href="#" class="btn btn-default btn-flat float-right" data-toggle="modal"
                                data-target="#modal-logout"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="modal fade" id="modal-logout" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="modal-body text-center">
                            <h5>Apakah anda ingin keluar ?</h5>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-sm btn-default btn-flat"
                                data-dismiss="modal">Tidak</button>
                            <a class="btn btn-sm btn-info btn-flat float-right" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                            this.closest('form').submit();"><span>Ya,
                                    Keluar</span></a>
                        </div>
                    </form>
                </div>

            </div>

        </div>

        <aside class="main-sidebar main-sidebar-custom sidebar-dark-info elevation-4">
            <a href="{{ url('') }}" class="brand-link">
                <img src="{{ asset('') }}dist/img/logo-umjambi.png" alt="UM Jambi Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light "><strong>{{ env('APP_NAME', 'UM JAMBI') }}</strong></span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    @include('layouts.sidebar')
                </nav>
            </div>

            {{-- <div class="sidebar-custom">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="btn btn-info btn-block" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                this.closest('form').submit();"><i
                            class="fas fa-sign-out-alt"></i> <span>Keluar</span></a>
                </form>
            </div> --}}
        </aside>

        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>&copy; {{ date('Y') }} ICT Center</strong>
        </footer>
    </div>

    <script src="{{ asset('') }}plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('') }}plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    @stack('js')
    <script src="{{ asset('') }}dist/js/adminlte.min.js"></script>
</body>

</html>
