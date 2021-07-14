<div class="content">
    <div class="container-fluid">
        <div class="text-right">
            @if ($enviar == false)
            <button type="button" class="btn btn-default" data-toggle="modal" wire:click="enviar()">
                Agregar
            </button>
            @endif
        </div>
        <div class="card">
            <div class="card-header">
                @if ($enviar == false)
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
                @else
                    <div class="row align-content-between">
                        <div class="col-lg-3 col-md-3 col-sm-12 mt-3">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <span class="material-icons">
                                        person
                                    </span>
                                </span>
                                <p class="form-control">{{ $envio->user->name }}</p>
                            </div>
                            <div class="input-group mt-3">
                                <span class="input-group-text">
                                    <span class="material-icons">
                                        store
                                    </span>
                                </span>
                                <p class="form-control">{{ $envio->tienda->nombre }}</p>
                            </div>
                            <div class="input-group mt-3">
                                <span class="input-group-text">
                                    <span class="material-icons">
                                        event
                                    </span>
                                </span>
                                <p class="form-control">{{ $envio->created_at }}</p>
                            </div>
                        </div>
                    </div>
                    @include('commons.search')
                @endif
            </div>
            @if ($enviar == false)
                @include('livewire.enviosList')
            @endif

            @if (strlen($search) > 0)
                @include('livewire.enviosProductos')
            @endif

            @if ($enviar == true and strlen($search) == 0)
                @include('livewire.enviosItems')
            @endif
        </div>
    </div>
    @if ($enviar == true)
        @include('livewire.enviosForm')
    @else
        @include('livewire.enviosTienda')
    @endif
</div>
@push('js')
<script src="{{ asset('material') }}/js/onscan.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show');
        });

        window.livewire.on('select-tienda', msg => {
            $('#theModalTienda').modal('show');
        });

        window.livewire.on('selected-tienda', msg => {
            $('#theModalTienda').modal('hide');
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
