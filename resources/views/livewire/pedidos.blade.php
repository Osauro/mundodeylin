<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="text-right">
                    <button type="button" class="btn btn-default" data-toggle="modal" wire:click="resetUI()" data-target="#theModal">
                        Agregar
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if ($pedidos->count())
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-dark text-white">
                                <th width="200px">Fecha</th>
                                <th>Producto</th>
                                <th class="text-right" width="200px">Cantidad</th>
                                <th class="text-center" width="200px">Estado</th>
                                <th width="10px"></th>
                            </thead>
                            @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->created_at }}</td>
                                <td>{{ $pedido->producto->nombre }}</td>
                                <td class="text-right">{{ $pedido->cantidad }}</td>
                                <td class="text-center">{{ $pedido->estado }}</td>
                                <td>
                                    @if ($pedido->estado == 'Pendiente')
                                        <button class="btn btn-sm btn-danger" wire:click="cancelar({{ $pedido->id }})"><i class="fa fa-times-circle"></i></button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                @else
                    <h3>No se encontrarón resultados...</h3>
                @endif
            </div>
            @if ($pedidos->count())
                <div class="card-footer">
                    {{ $pedidos->links() }}
                </div>
            @endif
        </div>
    </div>
    @include('livewire.pedidosForm')
</div>
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show');
        });

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
