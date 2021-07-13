<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row align-content-between">
                    <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <small>
                                        <strong>
                                            DESDE
                                        </strong>
                                    </small>
                                </span>
                                <input type="date" wire:model="desde" class="form-control" autofocus>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <small>
                                        <strong>
                                            HASTA
                                        </strong>
                                    </small>
                                </span>
                                <input type="date" wire:model="hasta" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="bg-dark text-white">
                            <th width="200px">Fecha</th>
                            <th>Usuario</th>
                            <th>Cliente</th>
                            <th>NIT</th>
                            <th width="150px">Estado</th>
                            <th width="10px"></th>
                        </thead>
                        <tbody>
                            @foreach ($ventas as $venta)
                                <tr>
                                    <td>{{ $venta->created_at }}</td>
                                    <td>{{ $venta->user->name }}</td>
                                    <td>{{ $venta->cliente->nombre }}</td>
                                    <td>{{ $venta->cliente->nit }}</td>
                                    <td>{{ $venta->estado }}</td>
                                    <td>
                                        @if ($venta->estado == "Completado")
                                        <button class="btn btn-sm btn-success" wire:click="imprimirPDF({{ $venta->id }})">
                                            <span class="material-icons">
                                                print
                                            </span>
                                        </button>
                                        @else
                                        <button class="btn btn-sm btn-link">
                                            <span class="material-icons">
                                                print
                                            </span>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $ventas->links() }}
            </div>
        </div>
    </div>
</div>
@push('js')
<script src="{{ asset('material') }}/js/onscan.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
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

        try {
            onScan.attachTo(document, {
                suffixKeyCodes: [13],
                onScan: function(qrcode) { //función callback que se dispara después de una lectura
                    console.log(qrcode)
                    window.livewire.emit('addProducto', qrcode) //emitimos el evento para consultar la info y cobrar el ticket
                },
                onScanError: function(e){ //función callback para captura de errores de lectura
                }
            })
        } catch(e) {
            Swal.fire({
                position: 'top-end',
                icon: 'danger',
                title: e,
                showConfirmButton: false,
                timer: 1500
            })
        }
    })
</script>
@endpush
