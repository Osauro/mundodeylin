<div class="card-body">
    @if ($compras->count() > 0)
        <div class="table-responsive">
            <table class="table">
                <thead class="bg-dark text-white">
                    <th width="50px">#</th>
                    <th>Usuario</th>
                    <th width="200px">Estado</th>
                    <th width="200px">Fecha</th>
                    <th width="10px"></th>
                </thead>
                @foreach ($compras as $compra)
                <tr>
                    <td>{{ $compra->id }}</td>
                    <td>{{ $compra->user->name }}</td>
                    <td>{{ $compra->estado }}</td>
                    <td>{{ $compra->created_at }}</td>
                    <td>
                        @if ($compra->estado == 'Completado')
                            <button class="btn btn-sm btn-success" wire:click="imprimirPDF({{ $compra->id }})">
                                <span class="material-icons">
                                    print
                                </span>
                            </button>
                        @endif
                        @if ($compra->estado == 'Cancelado')
                            <button class="btn btn-sm btn-danger">
                                <span class="material-icons">
                                    close
                                </span>
                            </button>
                        @endif
                        @if ($compra->estado == 'Pendiente')
                            <button class="btn btn-sm btn-info" wire:click="verCompra({{ $compra->id }})">
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
@if ($compras->count())
    <div class="card-footer">
        {{ $compras->links() }}
    </div>
@endif
