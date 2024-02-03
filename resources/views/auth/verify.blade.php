<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('') }}assets/images/favicon-32x32.png" type="image/png" />
    <!-- loader-->
    <link href="{{ asset('') }}assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('') }}assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('') }}assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('') }}assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/css/icons.css" rel="stylesheet">
    <title>SIPENMARU UM JAMBI</title>
</head>

<body class="">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">
                    <div
                        class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body">
                                <img src="{{ asset('') }}assets/images/login-images/forgot-password-cover.svg" class="img-fluid"
                                    width="500" alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="p-3">
                                    <div class="text-center">
                                        @if (session('resent'))
                                            <div
                                                class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="mb-0 text-white">Link verifikasi telah dikirim ke email {{ Auth::user()->email }}</h6>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="text-muted">Terima kasih telah melakukan pendaftaran, email anda belum
                                        di verifikasi, silahkan cek email anda atau klik tombol dibawah ini untuk
                                        mengirim ulang link verifikasi.</p>

                                    <form method="POST" action="{{ route('verification.resend') }}">
                                        @csrf
                                        <div class="d-grid gap-2 mb-2">
                                            <button type="submit" class="btn btn-primary btn-sm">Kirim Ulang
                                                Verifikasi</button>
                                        </div>
                                    </form>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf                            
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-warning btn-sm">Keluar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('') }}assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('') }}assets/js/jquery.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

    <script>
        $(document).ready(function() {
            $(".alert-dismissible").fadeTo(2000, 500).slideUp(700, function() {
                $(".alert-dismissible").alert('close');
            });
        });
    </script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>
</body>

</html>
