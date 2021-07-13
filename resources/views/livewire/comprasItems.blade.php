@if ($items->count() > 0)
<div class="card-body">
    <div class="table-responsive mt-3">
        <table class="table table-striped">
            <thead class="bg-dark text-white">
                <th>Produto</th>
                <th width="100px">Imagen</th>
                <th class="text-right" width="100px">Precio/U</th>
                <th class="text-right" width="100px">Cantidad</th>
                <th class="text-right" width="100px">Precio/T</th>
                <th width="10px"></th>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->producto->nombre }}</td>
                        <td><img src="{{ asset('storage') . '/' . $item->producto->image }}" alt="" width="48" height="48"></td>
                        <td class="text-right">
                            {{ $item->precio_unitario }}
                        </td>
                        <td class="text-right">
                            {{ $item->cantidad }}
                        </td>
                        <td class="text-right">
                            {{ $item->precio_total }}
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" wire:click="edit({{ $item->id }})"><i class="fa fa-pen"></i></button>
                            <button class="btn btn-sm btn-danger" wire:click="destroy({{ $item->id }})"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                <tr class="bg-dark text-white">
                    <td></td>
                    <td class="text-right"><strong>PRODUCTOS:</strong></td>
                    <td class="text-right">{{ $items->total() }}</td>
                    <td class="text-right"><strong>TOTAL:</strong></td>
                    <td class="text-right">
                        {{ number_format($items->sum('precio_total'), 2, ',', '.') }}
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        {{ $items->links() }}
    </div>
</div>
<div class="card-footer justify-content-center">
    <div class="row">
        <button class="btn btn-success" wire:click="completar()">
            <span class="material-icons">
                done
            </span>
            Guardar
        </button>
        <button class="btn btn-danger" wire:click="cancelar()">
            <span class="material-icons">
                close
            </span>
            Cancelar
        </button>
    </div>
</div>
@else
<div class="card-body text-center">
    <h3>No se agregaron productos aún.</h3>
    <button class="btn btn-danger" wire:click="cancelar()">
        <span class="material-icons">
            close
        </span>
        Cancelar
    </button>
</div>
@endif
