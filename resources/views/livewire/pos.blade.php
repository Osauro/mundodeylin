<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-lg-9 col-md-7">
                        @include('livewire.posItems')
                        @if ($vender == false)
                            <div class="text-center p-5 mt-5">
                                <button type="button" class="btn btn-link" wire:click="iniciarVenta()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                    <p>INICAR VENTA</p>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-3 col-md-5">
                        @include('livewire.posSidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.posForm')
</div>
@push('js')
<script src="{{ asset('material') }}/js/onscan.min.js"></script>
<script src="https://parzibyte.github.io/plugin-ticket-js/Impresora.js"></script>
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

        window.livewire.on('imprimir', msg => {
            let nombreImpresora = "TMT20";
            let impresora = new Impresora();
            impresora.cut();
            // CORTA LA PARTE DE LA CABECERA
            // setFont A - B
            // setEmphasize 0 - 1
            // setAlign left - center - right
            impresora.setFontSize(2, 2);
            impresora.setEmphasize(1);
            impresora.write("MUNDO DEYLIN\n");

            impresora.setFontSize(1, 1);
            impresora.feed(1);
            impresora.write("V E N T A\n");
            impresora.feed(1);

            impresora.setAlign('left');
            impresora.write(msg['cabecera']);

            impresora.feed(1);
            impresora.setAlign("center");
            impresora.write("P R O D U C T O S\n");
            impresora.feed(1);

            impresora.setAlign('left');
            impresora.write(msg['productos']);

            impresora.setAlign("right");
            impresora.write(msg['total']);
            impresora.write(msg['pagado']);

            impresora.feed(2);
            impresora.setAlign("center");
            impresora.write("G R A C I A S\n");
            impresora.write("P O R   S U   C O M P R A\n");
            impresora.feed(2);
            impresora.setFont('B');
            impresora.setAlign("center");
            impresora.write("www.dieguitosoft.com\n");
            impresora.write("CEL: 73010688\n");
            impresora.setFont('A');
            impresora.cut();
            impresora.imprimirEnImpresora(nombreImpresora);
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
                icon: 'error',
                title: e,
                showConfirmButton: false,
                timer: 1500
            })
        }
    })
</script>
@endpush
