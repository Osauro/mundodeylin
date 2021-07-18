<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Component;

class Welcome extends Component
{

    public $activePage;
    public $title = null;
    private $paginate = 8;
    protected $productos;

    public function render()
    {
        if (request('categoria')) {
            $this->productos = Producto::where('categoria_id', request('categoria'))->simplePaginate($this->paginate);
        }

        if (is_null($this->productos)) {
            $this->productos = Producto::orderBy('nombre', 'ASC')->simplePaginate($this->paginate);
        }

        $categorias = Categoria::orderBy('nombre', 'ASC')->get();
        return view('livewire.welcome', ['productos' => $this->productos, 'categorias' => $categorias])
        ->extends('layouts.welcome')
        ->section('content');

    }
}
