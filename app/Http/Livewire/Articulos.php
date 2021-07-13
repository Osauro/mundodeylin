<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Articulos extends Component
{
    use WithPagination;

    public $search;
    public $tienda;
    public $componentName;
    private $paginate = 5;
    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->componentName = "Articulos";
        $this->tienda = Auth()->user()->tienda;
        if (is_null($this->tienda)) {
            abort(401);
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $articulos = $this->tienda->articulos()
        ->where('nombre', 'LIKE', '%' . $this->search . '%')
        ->paginate($this->paginate);
        return view('livewire.articulos', compact('articulos'))
        ->extends('layouts.main', ['titlePage' => 'Articulos', 'activePage' => 'articulos'])
        ->section('content');
    }
}
