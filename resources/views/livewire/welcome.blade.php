
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ url('/') }}">{{ env('APP_NAME') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorias</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categorias as $categoria)
                            <li>
                                <a class="dropdown-item btn btn-light btn-block" href="?categoria={{ $categoria->id }}">
                                    <img src="{{ asset('storage') }}/{{ $categoria->image }}" alt="" width="50px" height="50px">
                                    <span class="ml-3">
                                        {{ $categoria->nombre }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <div class="d-flex">
                @auth
                <div class="text-center">
                    <a class="btn btn-outline-dark" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </div>
                @else
                <div class="text-center">
                    <a class="btn btn-outline-dark" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">{{ env('APP_NAME') }}</h1>
            <p class="lead fw-normal text-white-50 mb-0">Ventas por mayor y menor</p>
        </div>
    </div>
</header>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($productos as $producto)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top img-fluid" src="{{ asset('storage') }}/{{ $producto->image }}" alt="{{ $producto->nombre }}" />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder text-truncate">{{ $producto->nombre }}</h5>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            <p>
                                Precio (u) {{ $producto->precio_unitario }} BOB
                            </p>
                            <p>
                                Precio (m) {{ $producto->precio_por_mayor }} BOB
                            </p>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-success mt-auto" href="http://wa.me/59173010688?text=Donde puedo adquirir el producto *{{ $producto->nombre }}*" target="new"><i class="bi bi-whatsapp"></i> Comprar</a></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center text-dark">
            {{ $productos->links() }}
        </div>
    </div>
</section>
