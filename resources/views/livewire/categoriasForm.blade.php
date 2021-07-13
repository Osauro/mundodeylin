@include('commons.modalHeader')
<div class="row">
    <div class="col-sm-12">
        <div class="form-group mb-4">
            <label>Nombre:</label>
            <input type="text" wire:model.lazy="nombre" class="form-control">
            @error('nombre')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="mb-4">
            <label>Imagen:</label>
            <input type="file" wire:model="image" class="form-control">
            @error('image') <span class="error">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
@include('commons.modalFooter')
