<div class="card-body">
    <div class="table-responsive mt-3">
        <table class="table table-striped">
            <thead class="bg-dark text-white">
                <th>Produto</th>
                <th width="100px">Imagen</th>
                <th class="text-right" width="100px">Stock</th>
                <th width="10px"></th>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td><img src="{{ asset('storage') . '/' . $producto->image }}" alt="" width="48" height="48"></td>
                        <td class="text-right">
                            {{ $producto->stock }}
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" wire:click="addProducto({{ $producto->codigo }})"><i class="fa fa-plus"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        {{ $productos->links() }}
    </div>
</div>

