<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'REGARMARKET') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('/img/favicon/favicon.ico')}}" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('/template/sneat-1.0.0/fonts/boxicons.scss')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('/template/sneat-1.0.0/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('/template/sneat-1.0.0/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('/template/sneat-1.0.0/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('/template/sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('/template/sneat-1.0.0/assets/vendor/css/pages/page-auth.css')}}" />
    <!-- Helpers -->
    <script src="{{asset('/template/sneat-1.0.0/assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('/template/sneat-1.0.0/assets/js/config.js')}}"></script>
</head>

<body>

    <div id="app">
        <main class="py-4">

            <!-- Layout wrapper -->
            <div class="layout-wrapper layout-content-navbar">
                <div class="layout-container">
                    <!-- Menu -->

                    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                        <div class="app-brand demo">
                            <a href="index.html" class="app-brand-link">
                                <span class="app-brand-logo demo">
                                    <img width="30" src="{{asset('template/sneat-1.0.0/assets/img/logo.png')}}" alt="">
                                </span>
                                <span class="app-brand-text demo menu-text fw-bolder ms-2">Hastadewa</span>
                            </a>

                            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                                <i class="bx bx-chevron-left bx-sm align-middle"><i class="fas fa-arrow-circle-left"></i></i>
                            </a>
                        </div>

                        <div class="menu-inner-shadow"></div>

                        <ul class="menu-inner py-1">
                            <!-- Dashboard -->
                            <li class="menu-item active">
                                <a href="index.html" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                                    <div data-i18n="Analytics">Dashboard</div>
                                </a>
                            </li>

                            <!-- Layouts -->
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons bx bx-layout"></i>
                                    <div data-i18n="Layouts">Report</div>
                                </a>

                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="layouts-without-menu.html" class="menu-link">
                                            <div data-i18n="Without menu">Without menu</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="layouts-without-navbar.html" class="menu-link">
                                            <div data-i18n="Without navbar">Without navbar</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="layouts-container.html" class="menu-link">
                                            <div data-i18n="Container">Container</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="layouts-fluid.html" class="menu-link">
                                            <div data-i18n="Fluid">Fluid</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="layouts-blank.html" class="menu-link">
                                            <div data-i18n="Blank">Blank</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>



                    </aside>
                    <!-- / Menu -->

                    <!-- Layout container -->
                    <div class="layout-page">
                        <!-- Navbar -->

                        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                    <i class="bx bx-menu bx-sm"><i class="fas fa-list"></i></i>
                                </a>
                            </div>

                            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                                <!-- Search -->
                                <div class="navbar-nav align-items-center">
                                    <div class="nav-item d-flex align-items-center">
                                        <i class="bx bx-search fs-4 lh-0"></i>
                                        <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
                                    </div>
                                </div>
                                <!-- /Search -->

                                <ul class="navbar-nav flex-row align-items-center ms-auto">

                                    <!-- User -->
                                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                            <div class="avatar avatar-online">
                                                <img src="{{ asset('template/sneat-1.0.0/assets/img/avatars/1.png')}}" alt class="w-px-40 h-auto rounded-circle" />
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar avatar-online">
                                                                <img src="{{ asset('template/sneat-1.0.0/assets/img/avatars/1.png')}}" alt class="w-px-40 h-auto rounded-circle" />
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <span class="fw-semibold d-block">John Doe</span>
                                                            <small class="text-muted">Admin</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="dropdown-divider"></div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="bx bx-user me-2"></i>
                                                    <span class="align-middle">My Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="bx bx-cog me-2"></i>
                                                    <span class="align-middle">Settings</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <span class="d-flex align-items-center align-middle">
                                                        <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                        <span class="flex-grow-1 align-middle">Billing</span>
                                                        <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="dropdown-divider"></div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="auth-login-basic.html">
                                                    <i class="bx bx-power-off me-2"></i>
                                                    <span class="align-middle">Log Out</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!--/ User -->
                                </ul>
                            </div>
                        </nav>

                        <!-- / Navbar -->

                        <!-- Content wrapper -->
                        <div class="content-wrapper px-4 py-2">
                            @yield('content')
                        </div>
                        <!-- / Content -->

                        <!-- Footer -->
                        <footer class="content-footer footer bg-footer-theme">
                            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                                <div class="mb-2 mb-md-0">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    , made with ❤️ by
                                    <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                                </div>
                                <div>
                                    <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                                    <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                                    <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>

                                    <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">Support</a>
                                </div>
                            </div>
                        </footer>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

        </main>
    </div>
</body>

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('template/sneat-1.0.0/assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('template/sneat-1.0.0/assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{asset('template/sneat-1.0.0/assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('template/sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

<script src="{{asset('template/sneat-1.0.0/assets/vendor/js/menu.js')}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script src="{{asset('template/sneat-1.0.0/assets/js/main.js')}}"></script>

<!-- Page JS -->

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>