<div class="card">
    <div class="card-header bg-dark text-white">
        EFECTIVO
    </div>
    <div class="card-body">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-money"></i>
                </span>
            </div>
            <input type="number" wire:model.lazy="efectivo" wire:keydown.enter="calcularPago()" class="form-control p-3" placeholder="0.00">
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-dark text-white">
        CAMBIO
    </div>
    <div class="card-body">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-money"></i>
                </span>
            </div>
            <input type="text" wire:model="cambio" class="form-control p-3" placeholder="0.00" readonly>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-dark text-white">
        NOMINACIONES:
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <button class="btn btn-lg btn-default w-25" wire:click="addMoney(0.50)">0.50</button>
            <button class="btn btn-lg btn-default w-25" wire:click="addMoney(1.00)">1.00</button>
            <button class="btn btn-lg btn-default w-25" wire:click="addMoney(2.00)">2.00</button>
            <button class="btn btn-lg btn-default w-25" wire:click="addMoney(5.00)">5.00</button>
            <button class="btn btn-lg btn-default w-25" wire:click="addMoney(10.00)">10.00</button>
            <button class="btn btn-lg btn-default w-25" wire:click="addMoney(20.00)">20.00</button>
            <button class="btn btn-lg btn-default w-25" wire:click="addMoney(50.00)">50.00</button>
            <button class="btn btn-lg btn-default w-25" wire:click="addMoney(100.00)">100.00</button>
            <button class="btn btn-lg btn-default w-25" wire:click="addMoney(200.00)">200.00</button>
            <button class="btn btn-lg btn-default w-50" wire:click="resetUI()">BORRAR</button>
        </div>
    </div>
</div>
