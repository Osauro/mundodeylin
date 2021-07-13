<div class="content">
    <div class="container-fluid">
        <div class="text-right">
            <button type="button" class="btn btn-default" data-toggle="modal" wire:click="resetUI()" data-target="#theModal">
                Agregar
            </button>
            <button type="button" class="btn btn-default" data-toggle="modal" wire:click="resetUI()" data-target="#theModalMedida">
                <i class="fa fa-balance-scale"></i>
            </button>
        </div>
        <div class="card">
            <div class="card-header">
                @include('commons.search')
                <div class="row align-content-between">
                    <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-tag"></i>
                                </span>
                            </div>
                            <select wire:model="categoria" class="form-control"  data-style="btn btn-link">
                                <option value="0">Todas la categorías</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if ($productos->count())
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-dark text-white">
                                <th width="50px">#</th>
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th class="text-center">Codigo</th>
                                <th class="text-right">Precio/U</th>
                                <th class="text-right">Precio/M</th>
                                <th class="text-center">Imagen</th>
                                <th class="text-right">Medida</th>
                                <th class="text-right">Stock</th>
                                <th class="text-right">Stock/M</th>
                                <th width="10px"></th>
                            </thead>
                            @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->categoria->nombre }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td class="text-center">{!! QrCode::size(100)->generate($producto->codigo) !!}</td>
                                <td class="text-right">{{ $producto->precio_unitario }}</td>
                                <td class="text-right">{{ $producto->precio_por_mayor }}</td>
                                <td class="text-center">
                                    @if ($producto->image)
                                    <img src="{{ asset('storage') . '/' . $producto->image }}" alt="" width="100" height="100">
                                    @else
                                    <img src="{{ asset('storage') }}/no-image.png" alt="" width="100" height="100">
                                    @endif
                                </td>
                                <td class="text-right">{{ $producto->unidad_medida }}</td>
                                <td class="text-right">{{ $producto->stock }}</td>
                                <td class="text-right">{{ $producto->stock_minimo }}</td>
                                <td>
                                    @if ($producto->deleted_at)
                                        <button class="btn btn-sm btn-secondary"><i class="fa fa-pen" disabled="disabled"></i></button>
                                        <button class="btn btn-sm btn-warning" wire:click="restore({{ $producto->id }})"><i class="fa fa-sync"></i></button>
                                    @else
                                        <button class="btn btn-sm btn-info" wire:click="edit({{ $producto->id }})"><i class="fa fa-pen"></i></button>
                                        <button class="btn btn-sm btn-danger" wire:click="destroy({{ $producto->id }})"><i class="fa fa-times-circle"></i></button>
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
            @if ($productos->count())
                <div class="card-footer">
                    {{ $productos->links() }}
                </div>
            @endif
        </div>
    </div>
    @include('livewire.productosForm')
    @include('livewire.productosMedidaForm')
</div>
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show');
        });

        window.livewire.on('message-show', msg => {
            $('#theModal').modal('hide');
            $('#theModalMedida').modal('hide');
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
