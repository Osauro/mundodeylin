@include('commons.modalHeader')
<div class="row">
    <div class="col-sm-12">
        <div class="form-group mb-4">
            <label>Producto:</label>
            <select wire:model.lazy="producto" class="form-control">
                <option>Seleccione...</option>
                @foreach ($articulos as $articulo)
                    <option value="{{ $articulo->producto_id }}">{{ $articulo->producto->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-4">
            <label>Cantidad:</label>
            <input type="number" wire:model.lazy="cantidad" class="form-control">
            @error('cantidad')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
@include('commons.modalFooter')
