@include('commons.modalHeader')
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group mb-4">
            <label>Categoria:</label>
            <select wire:model.lazy="categoria_id" class="form-control" placeholder="Seleccione...">
                <option>Seleccione...</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
            @error('categoria_id')
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
            <label>Precio unitario:</label>
            <input wire:model.lazy="precio_unitario" class="form-control" type="number">
            @error('precio_unitario')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Stock:</label>
            <input wire:model.lazy="stock" class="form-control" type="number">
            @error('stock')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group mb-4">
            <label>Medida:</label>
            <select wire:model.lazy="medida" class="form-control" placeholder="Seleccione...">
                <option>Seleccione...</option>
                @foreach ($medidas as $medida)
                    <option value="{{ $medida->nombre }}">{{ $medida->nombre }}</option>
                @endforeach
            </select>
            @error('categoria_id')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Unidad por mayor:</label>
            <input wire:model.lazy="unidad_por_mayor" class="form-control" type="number">
            @error('unidad_por_mayor')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Precio por mayor:</label>
            <input wire:model.lazy="precio_por_mayor" class="form-control" type="number">
            @error('precio_por_mayor')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Stock mínimo:</label>
            <input wire:model.lazy="stock_minimo" class="form-control" type="number">
            @error('stock_minimo')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group mb-4">
            <label>Descripción:</label>
            <textarea rows="2" wire:model.lazy="descripcion" class="form-control">

            </textarea>
            @error('descripcion')
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
