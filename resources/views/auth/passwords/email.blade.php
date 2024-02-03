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
                                <img src="{{ asset('') }}assets/images/login-images/forgot-password-cover.svg"
                                    class="img-fluid" width="500" alt="" />
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="">
                                    <div class="mb-3 text-center">
                                        {{ session()->get('status') }}
                                        {{-- <img src="assets/images/logo-icon.png" width="60" alt=""> --}}
                                    </div>
                                    <div class="text-center mb-4">
                                        <h3 class="">LUPA PASSWORD</h3>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" action="{{ route('password.email') }}" method="POST">
                                            @csrf
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Alamat Email</label>
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="inputEmailAddress" placeholder="Alamat Email"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <a href="{{ route('login') }}" class="btn btn-light"><i
                                                            class='bx bx-arrow-back me-1'></i>Back to
                                                        Login</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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

    <!--app JS-->
    <script src="{{ asset('') }}assets/js/app.js"></script>
</body>

</html>
