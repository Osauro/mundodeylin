@if (!is_null($items))
    <div class="card">
        <div class="card-header bg-dark text-white">
            PRODUCTOS
        </div>
        @if ($items->count()>0)
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-striped">
                        <thead>
                            <th>Nombre</th>
                            <th>Código</th>
                            <th width="100px">Imagen</th>
                            <th width="100px" class="text-right">Medida</th>
                            <th width="100px" class="text-right">Precio/U</th>
                            <th class="text-right" width="100px">Cantidad</th>
                            <th width="100px" class="text-right">Precio/T</th>
                            <th width="10px"></th>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->producto->nombre }}</td>
                                    <td>{{ $item->producto->codigo }}</td>
                                    <td><img src="{{ asset('storage') . '/' . $item->producto->image }}" alt="" width="48" height="48"></td>
                                    <td class="text-right">{{ $item->producto->unidad_medida }}</td>
                                    <td class="text-right">{{ $item->precio_unitario }}</td>
                                    <td class="text-right">
                                        {{ $item->cantidad }}
                                    </td>
                                    <td class="text-right">{{ $item->precio_total }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" wire:click="destroy({{ $item->id }})"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="text-right"><strong>PRODUCTOS:</strong> </th>
                                <th class="text-right">({{ $items->sum('cantidad') }})</th>
                                <th class="text-right"><strong>TOTAL:</strong></th>
                                <th class="text-right">
                                    {{ number_format($items->sum('precio_total'), 2, '.', '') }}
                                </th>
                                <th></th>
                            </tfoot>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    {{ $items->links() }}
                </div>
            </div>
            <div class="card-footer justify-content-center">
                <div class="row">
                    @if ($venta->estado == "Completado")
                        <button class="btn btn-link">COMPLETADO</button>
                    @endif
                    @if ($venta->estado == "Cancelado")
                        <button class="btn btn-link">CANCELADO</button>
                    @endif
                    @if ($venta->estado == "Pendiente")
                        <button class="btn btn-success" wire:click="completar()">
                            <span class="material-icons">
                                attach_money
                            </span>
                            Completar
                        </button>
                        <button class="btn btn-danger" wire:click="cancelar()">
                            <span class="material-icons">
                                close
                            </span>
                            Cancelar
                        </button>
                    @endif
                </div>
            </div>
        @else
            <div class="card-body text-center">
                <h3>No se agregaron productos aún.</h3>
            </div>
        @endif
    </div>
@endif
