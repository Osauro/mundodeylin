<div wire:ignore.self class="modal fade" id="theModalMedida" tabindex="-1" role="dialog" aria-labelledby="theModalMedidaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="theModalLabel">
                    <b>Medida</b> | CREAR
                </h5>
                <h6 class="text-center text-warning" wire:loading>
                    Por favor espere...
                </h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group mb-4">
                            <label>Nombre:</label>
                            <input wire:model.lazy="medida" class="form-control" type="text">
                            @error('medida')
                                <span class="text-danger er">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="addMedida()" type="button" class="btn btn-default">Guardar</button>
            </div>
        </div>
    </div>
</div>
