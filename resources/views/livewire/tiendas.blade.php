<div class="content">
    <div class="container-fluid">
        <div class="text-right">
            <button type="button" class="btn btn-default" data-toggle="modal" wire:click="resetUI()" data-target="#theModal">
                Agregar
            </button>
        </div>
        <div class="card">
            <div class="card-header">
                @include('commons.search')
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-dark text-white">
                            <th width="50px">#</th>
                            <th>Encargado</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Ciudad</th>
                            <th>Dirección</th>
                            <th width="10px"></th>
                        </thead>
                        @foreach ($tiendas as $tienda)
                        <tr>
                            <td>{{ $tienda->id }}</td>
                            <td>{{ $tienda->user->name }}</td>
                            <td>{{ $tienda->nombre }}</td>
                            <td>{{ $tienda->telefono }}</td>
                            <td>{{ $tienda->ciudad }}</td>
                            <td>{{ $tienda->direccion }}</td>
                            <td>
                                @if ($tienda->deleted_at)
                                    <button class="btn btn-sm btn-secondary"><i class="fa fa-pen" disabled="disabled"></i></button>
                                    <button class="btn btn-sm btn-warning" wire:click="restore({{ $tienda->id }})"><i class="fa fa-sync"></i></button>
                                @else
                                    <button class="btn btn-sm btn-info" wire:click="edit({{ $tienda->id }})"><i class="fa fa-pen"></i></button>
                                    <button class="btn btn-sm btn-danger" wire:click="destroy({{ $tienda->id }})"><i class="fa fa-times-circle"></i></button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @if ($tiendas->count())
                <div class="card-footer">
                    {{ $tiendas->links() }}
                </div>
            @endif
        </div>
    </div>
    @include('livewire.tiendasForm')
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
