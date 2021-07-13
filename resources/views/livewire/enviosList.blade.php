<div class="card-body">
    @if ($envios->count() > 0)
        <div class="table-responsive">
            <table class="table">
                <thead class="bg-dark text-white">
                    <th width="50px">#</th>
                    <th>Usuario</th>
                    <th>Tienda</th>
                    <th width="200px">Estado</th>
                    <th width="200px">Fecha</th>
                    <th width="10px"></th>
                </thead>
                @foreach ($envios as $envio)
                <tr>
                    <td>{{ $envio->id }}</td>
                    <td>{{ $envio->user->name }}</td>
                    <td>{{ $envio->tienda->nombre }}</td>
                    <td>{{ $envio->estado }}</td>
                    <td>{{ $envio->created_at }}</td>
                    <td>
                        @if ($envio->estado == 'Completado')
                            <button class="btn btn-sm btn-success" wire:click="imprimirPDF({{ $envio->id }})">
                                <span class="material-icons">
                                    print
                                </span>
                            </button>
                        @endif
                        @if ($envio->estado == 'Cancelado')
                            <button class="btn btn-sm btn-danger">
                                <span class="material-icons">
                                    close
                                </span>
                            </button>
                        @endif
                        @if ($envio->estado == 'Pendiente')
                            <button class="btn btn-sm btn-info" wire:click="verEnvio({{ $envio->id }})">
                                <span class="material-icons">
                                    visibility
                                </span>
                            </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    @else
        <h3>No se encontraron resultados.</h3>
    @endif
</div>
@if ($envios->count())
    <div class="card-footer">
        {{ $envios->links() }}
    </div>
@endif
