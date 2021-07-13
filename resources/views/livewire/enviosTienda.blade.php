<div wire:ignore.self class="modal fade" id="theModalTienda" tabindex="-1" role="dialog" aria-labelledby="theModalTiendaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="theModalTiendaLabel">
                    Seleccionar Tienda
                </h5>
                <h6 class="text-center text-warning" wire:loading>
                    Por favor espere...
                </h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group mb-4">
                            <label>Tienda:</label>
                            <select wire:model.lazy="tienda" class="form-control">
                                <option value="">Seleccione...</option>
                                @foreach ($tiendas as $tienda)
                                    <option value="{{ $tienda->id }}">{{ $tienda->nombre }}</option>
                                @endforeach
                            </select>
                            @error('tienda')
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
                <button wire:click.prevent="enviar()" type="button" class="btn btn-default">Seleccionar</button>
            </div>
        </div>
    </div>
</div>

