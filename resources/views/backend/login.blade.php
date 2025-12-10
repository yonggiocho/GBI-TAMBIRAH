<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login | GBI Tumbang Tambirah </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Login Pages" name="description" />
        <meta content="TumbangTambirah" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/frontend/img/favicon.png')}}">

        <!-- App css -->
        <link href="{{asset('assets/backend/css/icons.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/backend/css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style">
        <link href="{{asset('assets/backend/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style">
        <style>
                input[type="text"],
                input[type="email"],
                input[type="password"] {
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 10px;
                width: 100%;
                transition: border-color 0.3s, box-shadow 0.3s;
                }

                /* Efek border menyala saat fokus */
                input[type="text"]:focus,
                input[type="email"]:focus,
                input[type="password"]:focus {
                border: 2px solid #727CF5;
                box-shadow: 0 0 8px #727CF5;
                outline: none;
                }

        </style>
    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header pt-2 pb-2 text-center bg-primary">
                                <a href="{{route('login')}}">
                                    <span><img src="{{$identitas?->logo ? asset('storage/'.$identitas->logo) : asset('assets/frontend/img/logo/gbi-tt.png')}}" alt="Gereja Bethel Indonesia Tumbang Tambirah" height="70px"></span>
                                </a>
                            </div>

                            <div class="card-body p-4">

                                <div class="text-center m-auto">
                                    <h4 class="text-dark-50 text-center pb-0 fw-bold">Halaman Login</h4>
                                    <p class="text-muted mb-3">Silahkan masukkan email dan kata sandi anda</p>
                                    @if(session()->has('loginError'))
                                    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        {{session('loginError')}}
                                    </div>
                                    @endif



                                </div>

                                <form action="{{route('backend.auth')}}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email</label>
                                        <input class="form-control" type="email" id="emailaddress" name="email" placeholder="Masukkan email anda">
                                        @error('email')
                                            <small class="form-text text-danger">
                                                {{$message}}
                                            </small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">

                                        <label for="password" class="form-label">Kata Sandi</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan kata sandi anda">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>

                                        </div>
                                        @error('password')
                                            <small class="form-text text-danger">
                                                {{$message}}
                                            </small>
                                        @enderror
                                    </div>




                                    <div class="mt-4 mb-0 text-center">
                                        <button class="btn btn-success w-100" type="submit"> Masuk </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
           2025 © {{$identitas->nama_website ?? 'Develop by Yonggi Kawoco'}}
        </footer>

        <!-- bundle -->
         <script src="{{asset('assets/backend/js/vendor.min.js')}}"></script>
        <script src="{{asset('assets/backend/js/app.min.js')}}"></script>

    </body>
</html>
