@include('commons.modalHeader')
<div class="row">
    <div class="col-sm-12">
        <div class="form-group mb-4">
            <label>Tipo:</label>
            <select wire:model.lazy="tipo" class="form-control">
                <option>Seleccione...</option>
                <option value="Ingreso">Ingreso</option>
                <option value="Egreso">Egreso</option>
            </select>
            @error('tipo')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Detalle:</label>
            <select wire:model.lazy="detalle" class="form-control">
                <option>Seleccione...</option>
                <option value="Apertura de caja">Apertura de caja</option>
                <option value="Cierre de caja">Cierre de caja</option>
                <option value="Depósito">Depósito</option>
                <option value="Retiro">Retiro</option>
            </select>
            @error('detalle')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Descripción:</label>
            <input type="text" wire:model.lazy="descripcion" class="form-control">
            @error('descripcion')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label>Monto:</label>
            <input type="text" wire:model.lazy="monto" class="form-control" placeholder="Disponible: {{ $saldo }}">
            @error('monto')
                <span class="text-danger er">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
@include('commons.modalFooter')
