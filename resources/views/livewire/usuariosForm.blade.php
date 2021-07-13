@include('commons.modalHeader')
<div class="row">
    <div class="col-sm-12">
        <div class="form-group mb-4">
            <label>Username:</label>
            <input type="text" wire:model.lazy="name" class="form-control" maxlength="16">
            @error('name')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Email:</label>
            <input type="email" wire:model.lazy="email" class="form-control">
            @error('email')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Carnet de identidad:</label>
            <input type="text" wire:model.lazy="dni" class="form-control">
            @error('dni')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Celular:</label>
            <input type="number" wire:model.lazy="celular" class="form-control">
            @error('celular')
            <span class="text-danger er">
                {{ $message }}
            </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Dirección:</label>
            <input type="text" wire:model.lazy="direccion" class="form-control">
            @error('direccion')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Tipo:</label>
            <select wire:model.lazy="tipo" class="form-control">
                <option value="Encargado">Encargado</option>
                <option value="Administrador">Administrador</option>
            </select>
            @error('tipo')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
@include('commons.modalFooter')
