<?php

namespace App\Http\Livewire;

use App\Models\Venta;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade as PDF;

class Ventas extends Component
{
    use WithPagination;

    public $desde;
    public $hasta;
    public $tienda;
    public $componentName;
    public $selected_id;

    private $paginate = 8;
    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->componentName = "Ventas";
        $this->tienda = Auth()->user()->tienda;
        $this->hasta = date("Y-m-d", strtotime(now()));

        if (is_null($this->tienda)) {
            abort(401);
        }
    }

    public function render()
    {
        $pendientes = $this->tienda->ventas->where('estado', "Pendiente");

        foreach ($pendientes as $venta) {
            $venta->estado = "Cancelado";
            $venta->save();
        }

        if ($this->desde and $this->hasta) {
            $ventas = $this->tienda->ventas()->whereDate('created_at', '>=', $this->desde)
            ->whereDate('created_at', '<=', $this->hasta)
            ->orderBy('created_at', 'DESC')
            ->paginate($this->paginate);
        } else {
            $ventas = $this->tienda->ventas()->orderBy('created_at', 'DESC')->paginate($this->paginate);
        }
        return view('livewire.ventas', compact('ventas'))
        ->extends('layouts.main', ['titlePage' => 'Ventas', 'activePage' => 'ventas'])
        ->section('content');
    }

    public function imprimirPDF(Venta $venta)
    {
        $pdf = PDF::loadView('reportes.ventas', compact('venta'))->save('storage/reportes/ventas.pdf');
        return response()->download('storage/reportes/ventas.pdf');
    }
}
