<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Mobile Web-app fullscreen -->

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    <!-- Meta tags -->
    <link rel="icon" href="assets/svg/favicon.ico">

    <!-- Title -->
    <title>{{ $titlePage }}</title>

    <!-- Vendor stylesheets -->

    <link rel="stylesheet" media="all" href="{{ asset('frontend') }}/css/vendor/animate.css" />
    <link rel="stylesheet" media="all" href="{{ asset('frontend') }}/css/vendor/font-awesome.css" />
    <link rel="stylesheet" media="all" href="{{ asset('frontend') }}/css/vendor/linear-icons.css" />
    <link rel="stylesheet" media="all" href="{{ asset('frontend') }}/css/vendor/owl.carousel.css" />
    <link rel="stylesheet" media="all" href="{{ asset('frontend') }}/css/vendor/jquery.lavalamp.css" />

    <!-- Template stylesheets -->

    <link rel="stylesheet" media="all" href="{{ asset('frontend') }}/css/style.css" />

    <!--HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script> <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    @livewireStyles
</head>

<body>
    <div class="loader">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Main navigation -->

    <nav class="navbar navbar-expand-lg navbar-sticky navbar-dark">
        <div class="container">

            <!-- Logo -->

            <a class="navbar-brand mr-1" href="index.html">
                <img src="{{ asset('frontend') }}/assets/svg/reveal-logo.svg" alt="">
            </a>

            <!-- Navbar toggler -->

            <div class="d-flex align-items-center">
                @guest
                <a class="btn btn-sm btn-primary btn-rounded ml-lg-4 px-3" href="{{ route('login') }}">
                    <i class="fa fa-user"></i> Entrar
                </a>
                @endguest
                @auth
                <a class="btn btn-sm btn-primary btn-rounded ml-lg-4 px-3" href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a>
                @endauth
                <div class="d-lg-none ml-3 mr-3">
                    <button class="btn btn-primary rounded-circle btn-sm toggle-show" data-show="open-mobile-filters">
                        <strong>
                            <i class="icon icon-text-align-center"></i>
                            <span class="d-none d-sm-inline-block">Filters</span>
                        </strong>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumbs -->

    <header class="header header-main header-sticky bg-dark">
        <div class="pb-2 py-lg-3">
            <div class="container text-light">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="mb-0 h4">Product list</h2>
                        <small class="pre-label d-none d-lg-block">Cards list preview</small>
                    </div>
                    <div class="col-lg-4 text-lg-right pt-2 pt-lg-0">
                        <ol class="breadcrumb breadcrumb-light justify-content-lg-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Sucursales</a></li>
                            <li class="breadcrumb-item">Contacto</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- SVG Divider -->

    <section class="divider bg-dark">
        <svg class="svg svg-light" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1920" height="100" viewBox="0 0 1920 100" preserveAspectRatio="none meet">
            <path d="M0,11S168.915,69.242,406.27,70.7,685.853,57.593,850.4,37.207,1259.752,73.448,1517.323,70.7,1920,19.667,1920,19.667V101H0Z" transform="translate(0 -1)" />
            <path d="M1920,102.048s-89.6,137.879-398.308,19.053c-162.379-62.5-391.708,20.855-598.484,20.855-206.775,22.449-295.6-77.886-503.833-39.909C286.864,132.511,0,110.668,0,110.668v62.337H1920Z" transform="translate(0 -73.005)" fill-opacity=".2" />
            <path d="M0,102.147S407.045,189.7,555.574,121.265C717.953,58.549,760.893,69.884,840.982,85.957c188.351,79.39,348.351-56.61,532.351,70.057C1489,91.538,1920,110.8,1920,110.8v62.551H0Z" transform="translate(0 -73.347)" fill-opacity=".4" />
        </svg>
    </section>

    <!-- Products list -->

    <section class="py-3">
        <div class="container">
            <div class="row">
                @include('layouts.navbars.welcomeSidebar')
                @yield('content')
            </div>
        </div>

    </section>

    <!-- Footer -->

    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row justify-content-between align-items-end text-center text-md-left">

                <div class="col-md-4 mb-4 mb-md-0">
                    <a href="../documentation/index.html" class="link link-underline link-light mr-3"><i class="icon icon-book"></i> Documentation</a>
                    <a href="http://helpdesk.elathemes.com/" class="link link-underline link-light mr-3"><i class="icon icon-heart-pulse"></i> Help</a>
                </div>

                <div class="col-md-6 text-md-right">
                    <a href="https://themeforest.net/item/reveal-responsive-multipurpose-ecommerce-bootstrap-html-template/29644121" class="btn btn-outline-light btn-rounded btn-sm px-3">
                        <i class="icon icon-cart"></i> Get the licence
                    </a>
                </div>

            </div>

            <div class="pt-5 text-muted text-center">
                <div class="mb-3"><img src="{{ asset('frontend') }}/assets/svg/reveal-logo.svg" alt=""></div>
                <div><small class="text-muted pre-label">A bold visual experience</small></div>
                <small>All rights reserved 2020 © Reveal</small>
            </div>
        </div>
    </footer>

    <!-- Vendor Scripts -->

    <script src="{{ asset('frontend') }}/js/vendor/jquery.min.js"></script>
    <script src="{{ asset('frontend') }}/js/vendor/bootstrap.bundle.js"></script>
    <script src="{{ asset('frontend') }}/js/vendor/in-view.min.js"></script>
    <script src="{{ asset('frontend') }}/js/vendor/jquery.lavalamp.js"></script>
    <script src="{{ asset('frontend') }}/js/vendor/owl.carousel.js"></script>
    <script src="{{ asset('frontend') }}/js/vendor/rellax.js"></script>
    <script src="{{ asset('frontend') }}/js/vendor/wow.js"></script>
    <script src="{{ asset('frontend') }}/js/vendor/tabzy.js"></script>
    <script src="{{ asset('frontend') }}/js/vendor/isotope.pkgd.js"></script>

    <!-- Template Scripts -->

    <script src="{{ asset('frontend') }}/js/main.js"></script>
    <script src="{{ asset('frontend') }}/js/custom.js"></script>
    @livewireScripts
    </body>

</html>
