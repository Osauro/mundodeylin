<div class="content">
    <div class="container-fluid">
        <div class="text-right">
            <button type="button" class="btn btn-default" data-toggle="modal" wire:click="resetUI()" data-target="#theModal">
                Agregar
            </button>
        </div>
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
                    <table class="table table-striped table-bordered">
                        <thead class="bg-dark text-white">
                            <th width="150px">Fecha</th>
                            <th width="150px">Usuario</th>
                            <th width="150px">Detalle</th>
                            <th>Descripción</th>
                            <th width="150px" class="text-right">Ingreso</th>
                            <th width="150px" class="text-right">Egreso</th>
                            <th width="150px" class="text-right">Saldo</th>
                        </thead>
                        <tbody>
                            @foreach ($movimientos as $movimiento)
                                <tr>
                                    <td>{{ $movimiento->created_at }}</td>
                                    <td>{{ $movimiento->user->name }}</td>
                                    <td>{{ $movimiento->detalle }}</td>
                                    <td>{{ $movimiento->descripcion }}</td>
                                    <td class="text-right">{{ $movimiento->ingreso }}</td>
                                    <td class="text-right">{{ $movimiento->egreso }}</td>
                                    <td class="text-right">{{ $movimiento->saldo }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $movimientos->links() }}
            </div>
        </div>
    </div>
    @include('livewire.movimientosForm')
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

        window.livewire.on('message-error', msg => {
            $('#theModal').modal('hide');
            Swal.fire({
                position: 'top-end',
                icon: 'error',
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
