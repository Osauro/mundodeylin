<?php

namespace App\Http\Livewire;

use App\Models\Devolucion;
use Livewire\Component;
use Livewire\WithPagination;

class Devoluciones extends Component
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
        $this->componentName = "Devoluciones";
        $this->tienda = Auth()->user()->tienda;
        if (is_null($this->tienda)) {
            abort(401);
        }
    }

    public function render()
    {
        $articulos = $this->tienda->articulos()->orderBy('nombre', 'ASC')->get();

        $devoluciones = $this->tienda->devoluciones()->orderBy('created_at', 'DESC')->paginate($this->paginate);
        return view('livewire.devoluciones', compact('devoluciones', 'articulos'))
        ->extends('layouts.main', ['titlePage' => 'Devoluciones', 'activePage' => 'devoluciones'])
        ->section('content');
    }

    public function resetUI()
    {
        $this->producto = null;
        $this->selected_id = null;
    }

    public function store()
    {
        Devolucion::create([
            'user_id'       => Auth()->user()->id,
            'tienda_id'     => $this->tienda->id,
            'producto_id'   => $this->producto,
            'cantidad'      => $this->cantidad,
            'estado'        => 'Pendiente'
        ]);
        $this->emit('message-show', 'Devolcucion creada.');
        $this->resetUI();
    }

    public function cancelar(Devolucion $devolucion)
    {
        $devolucion->estado = "Cancelado";
        $devolucion->save();
        $this->emit('message-show', 'Devolcucion cancelada.');
    }
}
