@include('commons.modalHeader')
<div class="row">
    <div class="col-sm-12">
        @if (!is_null($producto))
        <div class="form-group mb-4">
            <label>Producto:</label>
            <p class="form-control">{{ $producto->nombre }}</p>
        </div>
        @endif
        <div class="form-group mb-4">
            <label>Cantidad:</label>
            <input type="number" wire:model.lazy="cantidad" class="form-control">
            @if (!is_null($producto))
                <small class="text-right">Máximo: {{ $producto->stock }}</small>
            @endif
            @error('cantidad')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
@include('commons.modalFooter')
