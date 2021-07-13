<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Medida;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Productos extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search;
    public $categoria;

    public $categoria_id;
    public $nombre;
    public $slug;
    public $codigo;
    public $image;
    public $descripcion;
    public $medida;
    public $precio_unitario;
    public $unidad_por_mayor;
    public $precio_por_mayor;
    public $stock;
    public $stock_minimo;
    public $selected_id;

    public $componentName;
    private $paginate = 3;
    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->componentName = "Productos";
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $medidas = Medida::orderBy('nombre')->get();

        $categorias = Categoria::orderBy('nombre', 'ASC')->get();

        if ($this->categoria > 0) {
            $categoria = Categoria::find($this->categoria);
            $productos = Producto::withTrashed()
                                    ->where('categoria_id', $categoria->id)
                                    ->where('nombre', 'LIKE', '%' . $this->search . '%')
                                    ->paginate($this->paginate);
        } else {
            $productos = Producto::withTrashed()
                                    ->where('nombre', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('codigo', 'LIKE', '%' . $this->search . '%')
                                    ->paginate($this->paginate);
        }

        return view('livewire.productos', compact('productos', 'categorias', 'medidas'))
                ->extends('layouts.main', ['titlePage' => 'Productos', 'activePage' => 'productos'])
                ->section('content');
    }

    public function store()
    {
        $rules = [
            'categoria_id'      => 'required',
            'nombre'            => 'required|min:5|unique:productos',
            'descripcion'       => 'required|min:5|max:255',
            'medida'            => 'required',
            'precio_unitario'   => 'required|min:0',
            'unidad_por_mayor'  => 'required|min:1',
            'precio_por_mayor'  => 'required|min:1',
            'stock'             => 'required|min:1',
            'stock_minimo'      => 'required|min:1'

        ];

        $messages = [
            'categoria_id'              => 'La categoria es requerida',
            'nombre.required'           => 'El nombre es requerido.',
            'nombre.min'                => 'El nombre debe tener al menos 5 caracteres.',
            'nombre.unique'             => 'El nombre esta en uso.',
            'descripcion.required'      => 'La descripción es requerida.',
            'descripcion.min'           => 'La descripción de tener al menos 5 caracteres.',
            'descripcion.max'           => 'La descripcion no debe tener más de 255 caracteres.',
            'medida.required'           => 'La medida es requerida.',
            'precio_unitario.required'  => 'El precio unitario es requerido.',
            'unidad_por_mayor.required' => 'La unidad por mayor es requerida.',
            'stock.required'            => 'El stock es requerido.',
            'stock_minimo.required'     => 'El stock mínimo es requerido.'
        ];

        $this->validate($rules, $messages);

        $producto = Producto::create([
            'categoria_id'      => $this->categoria_id,
            'nombre'            => $this->nombre,
            'slug'              => Str::slug($this->nombre),
            'descripcion'       => $this->descripcion,
            'unidad_medida'     => $this->medida,
            'precio_unitario'   => $this->precio_unitario,
            'unidad_por_mayor'  => $this->unidad_por_mayor,
            'precio_por_mayor'  => $this->precio_por_mayor,
            'stock'             => $this->stock,
            'stock_minimo'      => $this->stock_minimo,
        ]);

        $prefijo = '73010688';
        $sufijo = str_pad($producto->id, 6, '0', STR_PAD_LEFT);
        $producto->codigo = $prefijo . $sufijo;
        $customFileName = '';
        if ($this->image) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/productos', $customFileName);
            $producto->image = 'productos/' . $customFileName;
        }
        $producto->save();

        $this->resetUI();
        $this->emit('message-show', 'Producto agregado.');
    }

    public function edit(Producto $producto)
    {
        $this->categoria_id = $producto->categoria_id;
        $this->nombre = $producto->nombre;
        $this->slug = $producto->slug;
        $this->codigo = $producto->codigo;
        $this->descripcion = $producto->descripcion;
        $this->medida = $producto->unidad_medida;
        $this->precio_unitario = $producto->precio_unitario;
        $this->unidad_por_mayor = $producto->unidad_por_mayor;
        $this->precio_por_mayor = $producto->precio_por_mayor;
        $this->stock = $producto->stock;
        $this->stock_minimo = $producto->stock_minimo;
        $this->selected_id = $producto->id;
        $this->emit('show-modal', true);
    }

    public function update()
    {
        $rules = [
            'categoria_id'      => 'required',
            'nombre'            => "required|min:5|unique:productos,nombre,{$this->selected_id}",
            'descripcion'       => 'required|min:5|max:255',
            'medida'            => 'required',
            'precio_unitario'   => 'required|min:0',
            'unidad_por_mayor'  => 'required|min:1',
            'precio_por_mayor'  => 'required|min:1',
            'stock'             => 'required|min:1',
            'stock_minimo'      => 'required|min:1'

        ];

        $messages = [
            'categoria_id'              => 'La categoria es requerida',
            'nombre.required'           => 'El nombre es requerido.',
            'nombre.min'                => 'El nombre debe tener al menos 5 caracteres.',
            'nombre.unique'             => 'El nombre esta en uso.',
            'descripcion.required'      => 'La descripción es requerida.',
            'descripcion.min'           => 'La descripción de tener al menos 5 caracteres.',
            'descripcion.max'           => 'La descripcion no debe tener más de 255 caracteres.',
            'medida.required'           => 'La medida es requerida.',
            'precio_unitario.required'  => 'El precio unitario es requerido.',
            'unidad_por_mayor.required' => 'La unidad por mayor es requerida.',
            'stock.required'            => 'El stock es requerido.',
            'stock_minimo.required'     => 'El stock mínimo es requerido.'
        ];

        $this->validate($rules, $messages);

        $producto = Producto::find($this->selected_id);

        $producto->categoria_id      = $this->categoria_id;
        $producto->nombre            = $this->nombre;
        $producto->slug              = Str::slug($this->nombre);
        $producto->descripcion       = $this->descripcion;
        $producto->unidad_medida     = $this->medida;
        $producto->precio_unitario   = $this->precio_unitario;
        $producto->unidad_por_mayor  = $this->unidad_por_mayor;
        $producto->precio_por_mayor  = $this->precio_por_mayor;
        $producto->stock             = $this->stock;
        $producto->stock_minimo      = $this->stock_minimo;

        $prefijo = '73010688';
        $sufijo = str_pad($producto->id, 6, '0', STR_PAD_LEFT);
        $producto->codigo = $prefijo . $sufijo;

        if ($this->image) {
            if ($producto->image != null) {
                if (file_exists('storage/' . $producto->image)) {
                    unlink('storage/' . $producto->image);
                }
            }
            $customFileName = '';
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/productos', $customFileName);
            $producto->image = 'productos/' . $customFileName;
        }

        $producto->save();
        $this->resetUI();
        $this->emit('message-show', 'Producto actualizado.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        $this->emit('message-show', 'Producto eliminado.');
    }

    public function restore($producto)
    {
        $producto = Producto::withTrashed()->find($producto);
        $producto->restore();
        $this->emit('message-show', 'Producto restaurado.');
    }

    public function resetUI()
    {
        $this->categoria_id     = '';
        $this->nombre           = '';
        $this->slug             = '';
        $this->codigo           = '';
        $this->image            = '';
        $this->descripcion      = '';
        $this->medida           = '';
        $this->precio_unitario  = '';
        $this->unidad_por_mayor = '';
        $this->precio_por_mayor = '';
        $this->stock            = '';
        $this->stock_minimo     = '';
        $this->selected_id      = 0;
    }

    public function addMedida()
    {
        $rules = [
            'medida' => 'required'
        ];

        $messages = [
            'medida.required'   => 'El nombre de medida es requerido.',
            'medida.unique'     => 'El nombre de medida está en uso.'
        ];

        $this->validate($rules, $messages);

        Medida::create([
            'nombre' => $this->medida
        ]);

        $this->resetUI();

        $this->emit('message-show', 'Medida agregada.');
    }
}
