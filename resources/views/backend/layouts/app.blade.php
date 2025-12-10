<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Dashboard | GBI Tumbang Tambirah</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{$identitas?->favicon ? asset('storage/'.$identitas->favicon) : asset('assets/frontend/img/favicon.png')}}">

        <!-- third party css -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <!-- third party css end -->

        <!-- App css -->
        <link href="{{asset('assets/backend/css/icons.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/backend/css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style">
        <link href="{{asset('assets/backend/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
        @stack('styles')

        <style>
            input[type="text"],
                input[type="email"],
                input[type="password"],
                input[type="date"],
                input[type="number"],
                textarea  {
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 10px;
                width: 100%;
                transition: border-color 0.3s, box-shadow 0.3s;
                }

                input[type="text"]:focus,
                input[type="email"]:focus,
                input[type="password"]:focus,
                input[type="date"]:focus,
                input[type="number"]:focus,
                textarea:focus {
                border: 2px solid #727CF5;
                box-shadow: 0 0 8px #727CF5;
                outline: none;
                }

        </style>
    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"light","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">

            @include('backend.partials.navbar')

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">

                <div class="content">
                    <!-- Topbar Start -->
                    <div class="navbar-custom">
                        <ul class="list-unstyled topbar-menu float-end mb-0">


                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="account-user-avatar">
                                        <img src="{{ $identitas?->favicon ? asset('storage/'.$identitas?->favicon) : asset('assets/frontend/img/favicon.png')}}" alt="user-image" class="rounded-circle">
                                    </span>
                                    <span>
                                        <span class="account-user-name">{{auth()->user()->name}}</span>
                                        <span class="account-position">{{ auth()->user()->role === 'admin' ? 'Administrator' : 'Staf'}}</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">

                                    <a  href="{{route('beranda')}}" target="_blank" class="dropdown-item notify-item">
                                        <i class="mdi mdi-earth-arrow-right me-1"></i>
                                        <span>Lihat Website</span>
                                    </a>
                                    <a href="{{route('logout')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </li>

                        </ul>
                        <button class="button-menu-mobile open-left">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        <div class="app-search dropdown d-none d-lg-block">
                            <form>
                                <div class="input-group">
                                    <h4>Dashboard | Administrator</h4>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end Topbar -->

                    <!-- Start Content-->

                    <!-- container -->
                    @yield('content-backend')

                </div>
                <!-- content -->

                <!-- Footer Start -->
                  @include('backend.partials.footer')
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <!-- bundle -->
        <script src="{{asset('assets/backend/js/vendor.min.js')}}"></script>
        <script src="{{asset('assets/backend/js/app.min.js')}}"></script>

        <!-- third party js -->
        <!-- jQuery (harus ada duluan) -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        <!-- third party js ends -->

        {{-- <!-- demo app -->
        <script src="{{asset('assets')}}/backend/js/pages/demo.dashboard.js"></script>
        <!-- end demo js--> --}}
        @stack('script')
        @include('sweetalert::alert')
        @stack('alerts')
    </body>
</html>