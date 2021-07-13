<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
        ,<div class="card">
            <div class="card-body">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-store"></i>
                        </span>
                    </div>
                    <select wire:model="tienda" class="form-control" style="font-size: 20px; padding: 3px">
                        <option value="">Seleccione...</option>
                        @foreach ($tiendas as $tienda)
                            <option value="{{ $tienda->id }}">{{ $tienda->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title">PEDIDOS</h4>
                <p class="category">Pedidos pendientes.</p>
            </div>
            <div class="card-body mt-3">
                @if ($pedidos->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>Tienda</th>
                                <th>Usuario</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Estado</th>
                                <th width="10px"></th>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $pedido)
                                    <tr>
                                        <td>{{ $pedido->tienda->nombre }}</td>
                                        <td>{{ $pedido->user->name }}</td>
                                        <td>{{ $pedido->producto->nombre }}</td>
                                        <td>{{ $pedido->cantidad }}</td>
                                        <td>{{ $pedido->estado }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-success" wire:click="aceptarPedido({{ $pedido->id }})">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" wire:click="cancelarPedido({{ $pedido->id }})">
                                                <i class="fa fa-times-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h5>No hay pedidos pendientes.</h5>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header card-header-danger">
                <h4 class="card-title">DEVOLUCIONES</h4>
                <p class="category">Devoluciones pendientes.</p>
            </div>
            <div class="card-body mt-3">
                @if ($devoluciones->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>Tienda</th>
                                <th>Usuario</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Estado</th>
                                <th width="10px"></th>
                            </thead>
                            <tbody>
                                @foreach ($devoluciones as $devolucion)
                                    <tr>
                                        <td>{{ $devolucion->tienda->nombre }}</td>
                                        <td>{{ $devolucion->user->name }}</td>
                                        <td>{{ $devolucion->producto->nombre }}</td>
                                        <td>{{ $devolucion->cantidad }}</td>
                                        <td>{{ $devolucion->estado }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-success" wire:click="aceptarDevolucion({{ $devolucion->id }})">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" wire:click="cancelarDevolucion({{ $devolucion->id }})">
                                                <i class="fa fa-times-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h5>No hay devoluciones pendientes.</h5>
                @endif
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('message-show', msg => {
            $('#theModal').modal('hide');
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                timer: 1500
            })
        });
    });
</script>
@endpush
