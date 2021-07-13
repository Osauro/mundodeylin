<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog" aria-labelledby="theModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="theModalLabel">
                    <b>{{ $componentName }}</b> | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}
                </h5>
                <h6 class="text-center text-warning" wire:loading>
                    Por favor espere...
                </h6>
            </div>
            <div class="modal-body"> 
