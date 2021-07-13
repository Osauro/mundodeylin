<?php

namespace App\Http\Livewire;

use App\Models\Pedido;
use Livewire\Component;
use Livewire\WithPagination;

class Pedidos extends Component
{
    use WithPagination;

    public $tienda;
    public $producto;
    public $cantidad;
    public $selected_id;
    public $componentName;

    private $paginate = 8;
    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->componentName = "Pedidos";
        $this->tienda = Auth()->user()->tienda;
        if (is_null($this->tienda)) {
            abort(401);
        }
    }

    public function render()
    {
        $articulos = $this->tienda->articulos()->orderBy('nombre', 'ASC')->get();

        $pedidos = $this->tienda->pedidos()->orderBy('created_at', 'DESC')->paginate($this->paginate);
        return view('livewire.pedidos', compact('pedidos', 'articulos'))
        ->extends('layouts.main', ['titlePage' => 'Pedidos', 'activePage' => 'pedidos'])
        ->section('content');
    }

    public function resetUI()
    {
        $this->producto = null;
        $this->selected_id = null;
    }

    public function store()
    {
        Pedido::create([
            'user_id'       => Auth()->user()->id,
            'tienda_id'     => $this->tienda->id,
            'producto_id'   => $this->producto,
            'cantidad'      => $this->cantidad,
            'estado'        => 'Pendiente'
        ]);
        $this->emit('message-show', 'Pedido creado.');
        $this->resetUI();
    }

    public function cancelar(Pedido $pedido)
    {
        $pedido->estado = "Cancelado";
        $pedido->save();
        $this->emit('message-show', 'Pedido cancelado.');
    }
}
