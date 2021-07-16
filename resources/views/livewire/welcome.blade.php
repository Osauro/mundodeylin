<div class="col-lg-9">
    <div class="bg-white p-2 p-lg-3 shadow-sm mb-2 mb-lg-4">
        <div class="d-flex justify-content-between">
            <div>
                <div class="form-inline">
                    <div class="mr-5">
                        {{ $title != '' ? 'Categoria: ' . $title : 'Todos las categorias' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        @foreach ($productos as $producto)
        <div class="card card-fill border-0 mb-2 mb-lg-4 shadow-sm">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-3 col-sm-12">
                    <div class="card-image">
                        <img src="{{ asset('storage') . '/' . $producto->image}}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}">
                    </div>
                </div>
                <div class="col-lg-7 col-md-9 col-sm-12">
                    <div class="px-3 px-lg-4 py-3 py-lg-4">
                        <h4 class="card-title mb-2">
                            <a href="#">{{ $producto->nombre }}</a>
                        </h4>
                        <div class="d-none d-xl-block mb-4">
                            <p>{{ $producto->descripcion }}</p>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <small><strong>PRECIO UNITARIO</strong></small><br>
                                <h3 class="text-muted">{{ $producto->precio_unitario }} <small style="font-size: 1rem"><strong>BOB</strong></small></h3>
                            </div>
                            <div class="col-md-6">
                                <small><strong>PRECIO POR MAYOR</strong></small><br>
                                <h3 class="text-muted">{{ $producto->precio_por_mayor }} <small style="font-size: 1rem"><strong>BOB</strong></small></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if ($productos->count() > 0)
        {{ $productos->links() }}
    @endif
</div>
