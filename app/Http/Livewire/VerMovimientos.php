<?php

namespace App\Http\Livewire;

use App\Models\Movimiento;
use App\Models\Tienda;
use Livewire\Component;
use Livewire\WithPagination;

class VerMovimientos extends Component
{
    use WithPagination;

    public $desde;
    public $hasta;
    public $componentName;
    public $search;
    private $paginate = 8;
    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->componentName = "Movimientos";
        $this->hasta = date("Y-m-d", strtotime(now()));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $tiendas = Tienda::orderBy('nombre', 'ASC')->get();
        if ($this->search) {
            if ($this->desde and $this->hasta) {
                $movimientos = Movimiento::where('tienda_id', 'LIKE', $this->search)
                ->whereDate('created_at', '>=', $this->desde)
                ->whereDate('created_at', '<=', $this->hasta)
                ->orderBy('created_at', 'DESC')
                ->paginate($this->paginate);
            } else {
                $movimientos = Movimiento::where('tienda_id', 'LIKE', $this->search)
                ->orderBy('created_at', 'DESC')->paginate($this->paginate);
            }
        } else {
            $movimientos = null;
        }
        return view('livewire.ver-movimientos', compact('movimientos', 'tiendas'))
        ->extends('layouts.main', ['titlePage' => 'Movimientos', 'activePage' => 'movimientos'])
        ->section('content');
    }
}
