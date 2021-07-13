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
                            <th>Nombre</th>
                            <th width="200px">Slug</th>
                            <th width="100px">Image</th>
                            <th width="10px"></th>
                        </thead>
                        @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->slug }}</td>
                            <td><img src="{{ asset('storage') . '/' . $categoria->image }}" alt="" width="64" height="64" class="img img-thumbnail"></td>
                            <td>
                                @if ($categoria->deleted_at)
                                    <button class="btn btn-sm btn-secondary"><i class="fa fa-pen" disabled="disabled"></i></button>
                                    <button class="btn btn-sm btn-warning" wire:click="restore({{ $categoria->id }})"><i class="fa fa-sync"></i></button>
                                @else
                                    <button class="btn btn-sm btn-info" wire:click="edit({{ $categoria->id }})"><i class="fa fa-pen"></i></button>
                                    <button class="btn btn-sm btn-danger" wire:click="destroy({{ $categoria->id }})"><i class="fa fa-times-circle"></i></button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @if ($categorias->count())
                <div class="card-footer">
                    {{ $categorias->links() }}
                </div>
            @endif
        </div>
    </div>
    @include('livewire.categoriasForm')
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
