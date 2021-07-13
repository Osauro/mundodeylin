@include('commons.modalHeader')
<div class="row">
    <div class="col-sm-12">
        <div class="form-group mb-4">
            <label>Encargado:</label>
            <select wire:model.lazy="user_id" class="form-control" placeholder="Seleccione...">
                <option>Seleccione...</option>
                @foreach ($usuarios as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Nombre:</label>
            <input wire:model.lazy="nombre" class="form-control" type="text">
            @error('nombre')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Teléfono:</label>
            <input wire:model.lazy="telefono" class="form-control" type="number">
            @error('telefono')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Ciudad:</label>
            <input wire:model.lazy="ciudad" class="form-control" type="text">
            @error('Ciudad')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Dirección:</label>
            <input wire:model.lazy="direccion" class="form-control" type="text">
            @error('direccion')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Ubicación: <small><a href="https://www.google.com.bo/maps/" target="new">Google Maps</a></small></label>
            <input wire:model.lazy="ubicacion" class="form-control" type="text">
            @error('ubicacion')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>

    </div>
</div>
@include('commons.modalFooter')
