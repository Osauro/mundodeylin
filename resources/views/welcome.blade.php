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
    <title>Reveal - Product list</title>

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

            <!-- Collapse -->

            <div class="collapse navbar-collapse navbar-collapse-sidebar" id="mainNavbar">

                <!-- Mobile search -->

                <div class="d-block d-lg-none">
                    <div class="p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <img src="{{ asset('frontend') }}/assets/svg/reveal-symbol.svg" alt="">
                            <button class="btn p-0" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon icon-cross font-size-lg"></span>
                            </button>
                        </div>
                    </div>
                    <div class="bg-light">
                        <div class="form-group form-group-icon">
                            <input type="text" class="form-control form-control-simple" placeholder="Search site">
                            <button class="btn btn-clean"><i class="icon icon-magnifier"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Navbar links -->

                <ul class="navbar-nav ml-auto">
                    <!-- Links mobile -->
                    <li class="nav-item d-block d-lg-none">
                        <hr>
                        <a href="https://www.dieguitosoft.com" class="nav-link"><small>DieguitoSoft</small></a>
                        <hr>
                        <div class="row row-sm">
                            <div class="col-6">
                                <a href="http://wa.me/59173010688" target="new" class="btn btn-block btn-sm btn-outline-secondary">
                                    <i class="icon icon-phone-handset"></i>
                                    <span>Contactate</span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Navbar toggler -->

            <div class="d-flex align-items-center">
                @guest
                <a class="btn btn-sm btn-primary btn-rounded ml-lg-4 px-3" href="">
                    <i class="fa fa-user"></i> Entrar
                </a>
                @endguest
                @auth
                <a class="btn btn-sm btn-primary btn-rounded ml-lg-4 px-3" href="">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a>
                @endauth
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon icon-menu"></span>
                </button>
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

                <!-- Product sidebar -->

                <div class="col-lg-3 sidebar sidebar-mobile" id="open-mobile-filters">
                    <div class="sidebar-content">

                        <!-- Header -->

                        <div class="sidebar-header clearfix d-lg-none">
                            <button type="button" class="close toggle-show p-3" data-show="open-mobile-filters" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Search -->

                        <div class="bg-white p-2 p-lg-3 mb-2 mb-lg-4 shadow-sm br-sm">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Go!</button>
                                </div>
                            </div>
                        </div>

                        <!-- Slider range -->

                        <div class="bg-white p-2 p-lg-3 mb-2 mb-lg-4 shadow-sm br-sm">
                            <a class="pre-label px-0" data-toggle="collapse" href="#collapseExamplePrice" role="button" aria-expanded="false" aria-controls="collapseExamplePrice">
                                <small>PRECIO</small>
                            </a>

                            <div class="collapse show" id="collapseExamplePrice">
                                <div class="pt-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Price</span>
                                        <span>
                                            $ <b class="price-value"></b>
                                        </span>
                                    </div>
                                    <input type="range" class="custom-range price-range" id="customRange1" min="{{ $productos->min('precio_unitario') }}" max="{{ $productos->max('precio_unitario') }}" step="1">
                                    <div class="d-flex justify-content-between">
                                        <small>$ {{ $productos->min('precio_unitario') }}</small>
                                        <small>$ {{ $productos->max('precio_unitario') }}</small>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Radio buttons group -->

                        <div class="bg-white p-2 p-lg-3 mb-2 mb-lg-4 shadow-sm br-sm">

                            <a class="pre-label px-0" data-toggle="collapse" href="#collapseExampleRadio" role="button" aria-expanded="false" aria-controls="collapseExampleRadio">
                                <small>Categorías</small>
                            </a>

                            <div class="collapse show" id="collapseExampleRadio">
                                <ul class="list-group list-group-clean pt-4">
                                    @foreach ($categorias as $categoria)
                                    <li class="list-group-item">
                                            <button class="btn btn-outline-primary text-left btn-block text-truncate pl-2 pr-1{{ $activeCategory == $categoria->slug ? ' active' : '' }}" wire:click="filtrarCategoria({{ $categoria->slug }})">
                                                <img src="{{ asset('storage') . '/' . $categoria->image }}" width="36" height="36" alt="">
                                                {{ $categoria->nombre }}
                                            </button>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Products content -->

                <div class="col-lg-9">

                    <!-- Products header -->

                    <div class="bg-white p-2 p-lg-3 shadow-sm mb-2 mb-lg-4">
                        <div class="d-flex justify-content-between">

                            <!-- Left -->

                            <div>
                                <div class="form-inline">
                                    <div class="form-group mb-0">
                                        <select class="form-control form-control-sm" id="exampleFormControlSelect1">
                                            <option>20</option>
                                            <option>50</option>
                                            <option>100</option>
                                            <option>All</option>
                                        </select>
                                        <label for="exampleFormControlSelect1" class="ml-3 d-none d-lg-block"><small>Showing all 24 of 128 products</small></label>
                                    </div>
                                </div>
                            </div>

                            <!-- Right -->

                            <div>
                                <div class="form-inline">
                                    <div class="form-group mb-0">
                                        <label for="exampleFormControlSelect2" class="mr-3 d-none d-lg-block"><small>Sort by</small></label>
                                        <select class="form-control form-control-sm" id="exampleFormControlSelect2">
                                            <option>Name</option>
                                            <option>Price</option>
                                        </select>
                                    </div>
                                    <div class="d-lg-none ml-2">
                                        <button class="btn btn-primary btn-sm toggle-show" data-show="open-mobile-filters">
                                            <strong>
                                                <i class="icon icon-text-align-center"></i>
                                                <span class="d-none d-sm-inline-block">Filters</span>
                                            </strong>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products collection -->

                    <div class="clearfix">

                        <div class="card card-fill border-0 mb-2 mb-lg-4 shadow-sm">
                            <div class="row align-items-center no-gutters">
                                <div class="col-5">
                                    <div class="card-image">
                                        <img src="{{ asset('frontend') }}/assets/images//demo/product-1.png" class="card-img-top" alt="Product image">
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="px-3 px-lg-4 py-3 py-lg-4">
                                        <h4 class="card-title mb-2">
                                            <a href="product.html">Coretta</a>
                                        </h4>
                                        <div class="d-none d-xl-block mb-4">
                                            <p>Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue.</p>
                                        </div>
                                        <div class="text-muted pre-label">
                                            <span>$490</span>
                                            <s>$877</s>
                                        </div>
                                        <div class="pt-4 d-none d-lg-block">
                                            <a href="product.html" class="btn btn-primary">
                                                Add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-fill border-0 mb-2 mb-lg-4 shadow-sm">
                            <div class="row align-items-center no-gutters">
                                <div class="col-5">
                                    <div class="card-image">
                                        <img src="{{ asset('frontend') }}/assets/images//demo/product-2.png" class="card-img-top" alt="Product image">
                                        <span class="card-badge badge badge-danger text-uppercase mr-2">50%</span>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="px-3 px-lg-4 py-3 py-lg-4">
                                        <h4 class="card-title mb-2">
                                            <a href="product.html">Tonya</a>
                                        </h4>
                                        <div class="d-none d-xl-block mb-4">
                                            <p>Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum et ultrices posuere cubilia Curae; Donec pharetra.</p>
                                        </div>
                                        <div class="text-muted pre-label">
                                            <span>$419</span>
                                            <s>$958</s>
                                        </div>
                                        <div class="pt-4 d-none d-lg-block">
                                            <a href="product.html" class="btn btn-primary">
                                                Add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-fill border-0 mb-2 mb-lg-4 shadow-sm">
                            <div class="row align-items-center no-gutters">
                                <div class="col-5">
                                    <div class="card-image">
                                        <img src="{{ asset('frontend') }}/assets/images//demo/product-3.png" class="card-img-top" alt="Product image">
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="px-3 px-lg-4 py-3 py-lg-4">
                                        <h4 class="card-title mb-2">
                                            <a href="product.html">Raven</a>
                                        </h4>
                                        <div class="d-none d-xl-block mb-4">
                                            <p>Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere.</p>
                                        </div>
                                        <div class="text-muted pre-label">
                                            <span>$502</span>
                                            <s>$857</s>
                                        </div>
                                        <div class="pt-4 d-none d-lg-block">
                                            <a href="product.html" class="btn btn-primary">
                                                Add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-fill border-0 mb-2 mb-lg-4 shadow-sm">
                            <div class="row align-items-center no-gutters">
                                <div class="col-5">
                                    <div class="card-image">
                                        <img src="{{ asset('frontend') }}/assets/images//demo/product-4.png" class="card-img-top" alt="Product image">
                                        <span class="card-badge badge badge-dark text-uppercase mr-2">Last offer</span>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="px-3 px-lg-4 py-3 py-lg-4">
                                        <h4 class="card-title mb-2">
                                            <a href="product.html">Mufi</a>
                                        </h4>
                                        <div class="d-none d-xl-block mb-4">
                                            <p>In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus primis in faucibus orci luctus.</p>
                                        </div>
                                        <div class="text-muted pre-label">
                                            <span>$584</span>
                                            <s>$838</s>
                                        </div>
                                        <div class="pt-4 d-none d-lg-block">
                                            <a href="product.html" class="btn btn-primary">
                                                Add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-fill border-0 mb-2 mb-lg-4 shadow-sm">
                            <div class="row align-items-center no-gutters">
                                <div class="col-5">
                                    <div class="card-image">
                                        <img src="{{ asset('frontend') }}/assets/images//demo/product-5.png" class="card-img-top" alt="Product image">
                                        <span class="card-badge badge badge-success text-uppercase mr-2">New</span>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="px-3 px-lg-4 py-3 py-lg-4">
                                        <h4 class="card-title mb-2">
                                            <a href="product.html">Audrie</a>
                                        </h4>
                                        <div class="d-none d-xl-block mb-4">
                                            <p>Fusce consequat. Nulla nisl. Nunc nisl.</p>
                                        </div>
                                        <div class="text-muted pre-label">
                                            <span>$470</span>
                                            <s>$937</s>
                                        </div>
                                        <div class="pt-4 d-none d-lg-block">
                                            <a href="product.html" class="btn btn-primary">
                                                Add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-fill border-0 mb-2 mb-lg-4 shadow-sm">
                            <div class="row align-items-center no-gutters">
                                <div class="col-5">
                                    <div class="card-image">
                                        <img src="{{ asset('frontend') }}/assets/images//demo/product-6.png" class="card-img-top" alt="Product image">
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="px-3 px-lg-4 py-3 py-lg-4">
                                        <h4 class="card-title mb-2">
                                            <a href="product.html">Kira</a>
                                        </h4>
                                        <div class="d-none d-xl-block mb-4">
                                            <p>Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.</p>
                                        </div>
                                        <div class="text-muted pre-label">
                                            <span>$579</span>
                                            <s>$915</s>
                                        </div>
                                        <div class="pt-4 d-none d-lg-block">
                                            <a href="product.html" class="btn btn-primary">
                                                Add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-fill border-0 mb-2 mb-lg-4 shadow-sm">
                            <div class="row align-items-center no-gutters">
                                <div class="col-5">
                                    <div class="card-image">
                                        <img src="{{ asset('frontend') }}/assets/images//demo/product-7.png" class="card-img-top" alt="Product image">
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="px-3 px-lg-4 py-3 py-lg-4">
                                        <h4 class="card-title mb-2">
                                            <a href="product.html">Dianne</a>
                                        </h4>
                                        <div class="d-none d-xl-block mb-4">
                                            <p>Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum. Curabitur in libero ut massa volutpat convallis.</p>
                                        </div>
                                        <div class="text-muted pre-label">
                                            <span>$526</span>
                                            <s>$1111</s>
                                        </div>
                                        <div class="pt-4 d-none d-lg-block">
                                            <a href="product.html" class="btn btn-primary">
                                                Add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-fill border-0 mb-2 mb-lg-4 shadow-sm">
                            <div class="row align-items-center no-gutters">
                                <div class="col-5">
                                    <div class="card-image">
                                        <img src="{{ asset('frontend') }}/assets/images//demo/product-8.png" class="card-img-top" alt="Product image">
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="px-3 px-lg-4 py-3 py-lg-4">
                                        <h4 class="card-title mb-2">
                                            <a href="product.html">Chery</a>
                                        </h4>
                                        <div class="d-none d-xl-block mb-4">
                                            <p>Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.</p>
                                        </div>
                                        <div class="text-muted pre-label">
                                            <span>$424</span>
                                            <s>$901</s>
                                        </div>
                                        <div class="pt-4 d-none d-lg-block">
                                            <a href="product.html" class="btn btn-primary">
                                                Add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-fill border-0 mb-2 mb-lg-4 shadow-sm">
                            <div class="row align-items-center no-gutters">
                                <div class="col-5">
                                    <div class="card-image">
                                        <img src="{{ asset('frontend') }}/assets/images//demo/product-9.png" class="card-img-top" alt="Product image">
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="px-3 px-lg-4 py-3 py-lg-4">
                                        <h4 class="card-title mb-2">
                                            <a href="product.html">Willi</a>
                                        </h4>
                                        <div class="d-none d-xl-block mb-4">
                                            <p>Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci.</p>
                                        </div>
                                        <div class="text-muted pre-label">
                                            <span>$494</span>
                                            <s>$1088</s>
                                        </div>
                                        <div class="pt-4 d-none d-lg-block">
                                            <a href="product.html" class="btn btn-primary">
                                                Add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Pagination -->

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center py-3 py-lg-4">
                            <li class="page-item disabled">
                                <a class="page-link page-link-first" href="#" tabindex="-1" aria-disabled="true">Prev</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>

                </div>
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

    </body>

</html>
