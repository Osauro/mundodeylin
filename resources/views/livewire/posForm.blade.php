@include('commons.modalHeader')
<div class="row">
    <div class="col-sm-12">
        <div class="form-group mb-4">
            <label>NIT/CI:</label>
            <input type="number" wire:model.lazy="nit" wire:keydown.enter="buscar()" class="form-control">
            @error('nit')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Nombre/Razón:</label>
            <input type="text" wire:model.lazy="nombre" class="form-control">
            @error('nombre')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
@include('commons.modalFooter')
