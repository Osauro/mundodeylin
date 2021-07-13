<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                @include('commons.search')
                <div class="row align-content-between">
                    <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-store"></i>
                                </span>
                            </div>
                            <p class="form-control">{{ $tienda->nombre }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-mobile-alt"></i>
                                </span>
                            </div>
                            <p class="form-control">{{ $tienda->telefono }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if ($articulos->count())
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-dark text-white">
                                <th>Nombre</th>
                                <th class="text-center">Codigo</th>
                                <th class="text-center">Codigo QR</th>
                                <th class="text-center">Medida</th>
                                <th class="text-right">Precio/U</th>
                                <th class="text-right">Precio/M</th>
                                <th class="text-center">Imagen</th>
                                <th class="text-right">Stock</th>
                            </thead>
                            @foreach ($articulos as $articulo)
                            <tr>
                                <td>{{ $articulo->nombre }}</td>
                                <td class="text-center">{{ $articulo->codigo }}</td>
                                <td class="text-center">{!! QrCode::size(100)->generate($articulo->codigo) !!}</td>
                                <td class="text-center">{{ $articulo->producto->unidad_medida }}</td>
                                <td class="text-right">{{ $articulo->producto->precio_unitario }}</td>
                                <td class="text-right">{{ $articulo->producto->precio_por_mayor }}</td>
                                <td class="text-center">
                                    @if ($articulo->producto->image)
                                    <img src="{{ asset('storage') . '/' . $articulo->producto->image }}" alt="" width="100" height="100">
                                    @else
                                    <img src="{{ asset('storage') }}/no-image.png" alt="" width="100" height="100">
                                    @endif
                                </td>
                                <td class="text-right">{{ $articulo->cantidad }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                @else
                    <h3>No se encontrarón resultados...</h3>
                @endif
            </div>
            @if ($articulos->count())
                <div class="card-footer">
                    {{ $articulos->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
