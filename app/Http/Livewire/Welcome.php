<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Component;

class Welcome extends Component
{
    public $activePage;
    public $title;
    public $categoria;

    public function mount()
    {
        if (request()->categoria) {
            $this->categoria = Categoria::where('slug', request()->categoria)->first();
            $this->title = $this->categoria->nombre;
        }
    }

    public function render()
    {

        $categorias = Categoria::orderBy('nombre', 'ASC')->get();

        if ($this->categoria) {
            $productos = Producto::where('categoria_id', '=', $this->categoria->id)->paginate();
            return view('livewire.welcome', compact('productos'))
            ->extends('layouts.welcome', ['titlePage' => 'Bienvenido', 'categorias' => $categorias, 'productos' => $productos, 'activePage' => $this->categoria->slug])
            ->section('content');
        } else {
            $productos = Producto::orderBy('nombre', 'ASC')->paginate();
            return view('livewire.welcome', compact('productos'))
            ->extends('layouts.welcome', ['titlePage' => 'Bienvenido', 'categorias' => $categorias, 'productos' => $productos, 'activePage' => ''])
            ->section('content');
        }

    }
}
