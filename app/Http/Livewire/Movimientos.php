<?php

namespace App\Http\Livewire;

use App\Models\Movimiento;
use Livewire\Component;
use Livewire\WithPagination;

class Movimientos extends Component
{
    use WithPagination;

    public $tienda;
    public $tipo;
    public $monto;
    public $detalle;
    public $descripcion;
    public $desde;
    public $hasta;
    public $saldo = 0;

    public $componentName;
    public $selected_id;

    private $paginate = 8;
    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->componentName = "Movimientos";
        $this->tienda = Auth()->user()->tienda;
        $this->hasta = date("Y-m-d", strtotime(now()));

        if (is_null($this->tienda)) {
            abort(401);
        }
    }

    public function render()
    {
        $movi = $this->tienda->movimientos()->orderBy('created_at', 'DESC')->first();
        if ($movi) {

            $this->saldo = $movi->saldo;
        }

        if ($this->desde and $this->hasta) {
            $movimientos = $this->tienda->movimientos()->whereDate('created_at', '>=', $this->desde)
            ->whereDate('created_at', '<=', $this->hasta)
            ->orderBy('created_at', 'DESC')
            ->paginate($this->paginate);
        } else {
            $movimientos = $this->tienda->movimientos()->orderBy('created_at', 'DESC')->paginate($this->paginate);
        }
        return view('livewire.movimientos', compact('movimientos'))
        ->extends('layouts.main', ['titlePage' => 'Movimientos', 'activePage' => 'movimientos'])
        ->section('content');
    }

    public function resetUI()
    {
        $this->tipo = '';
        $this->monto = '';
        $this->detalle = '';
        $this->descripcion = '';
        $this->selected_id = 0;
    }

    public function store()
    {
        $rules = [
            'tipo' => 'required',
            'detalle' => 'required',
            'monto' => 'required'
        ];

        $messages = [
            'tipo.required'     => 'El tipo es requerido.',
            'detalle.required'  => 'El detalle es requerido.',
            'monto.required'    => 'El monto es requerido.'
        ];

        $this->validate($rules, $messages);

        $saldo = $this->tienda->movimientos()->orderBy('created_at', 'DESC')->first();
        if ($saldo) {
            $saldo = $saldo->saldo;
        }
        $movimiento = new Movimiento();
        $movimiento->user_id = Auth()->user()->id;
        $movimiento->tienda_id = $this->tienda->id;
        $movimiento->detalle = $this->detalle;
        $movimiento->descripcion = $this->descripcion;
        if ($this->tipo == 'Ingreso') {
            $movimiento->ingreso = $this->monto;
            $movimiento->saldo = $saldo + $this->monto;
            $movimiento->save();
            $this->resetUI();
            $this->emit('message-show', 'Moviemiento agregado.');
        } else {
            if ($this->saldo >= $this->monto) {
                $movimiento->egreso = $this->monto;
                $movimiento->saldo = $saldo - $this->monto;
                $movimiento->save();
                $this->resetUI();
                $this->emit('message-show', 'Moviemiento agregado.');
            } else {
                $this->emit('message-error', 'Saldo insuficiente.');
            }
        }
    }
}
