<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Categorias extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search;
    public $nombre;
    public $slug;
    public $image;
    public $selected_id;

    public $componentName;
    private $paginate = 5;
    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->componentName = "Categorias";
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categorias = Categoria::withTrashed()
                            ->where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->paginate($this->paginate);

        return view('livewire.categorias', compact('categorias'))
        ->extends('layouts.main', ['titlePage' => 'Categorias', 'activePage' => 'categorias'])
        ->section('content');
    }

    public function store()
    {
        $rules = [
            'nombre' => 'required|unique:categorias|min:5'
        ];

        $messages = [
            'nombre.required'   => 'El nombre de categoría es obligatorio.',
            'nombre.unique'     => 'El nombre de categoría ya esta registrado.',
            'nombre.min'        => 'El nombre de categoria debe tener al menos 5 catacteres.'
        ];

        $this->validate($rules, $messages);

        $categoria = Categoria::create([
            'nombre'    => $this->nombre,
            'slug'      => Str::slug($this->nombre)
        ]);

        $customFileName = '';

        if ($this->image) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/categorias', $customFileName);
            $categoria->image = 'categorias/' . $customFileName;
            $categoria->save();
        }

        $this->resetUI();
        $this->emit('message-show', 'Categoria agregada');
        //return redirect()->to(route('categorias'));
    }

    public function edit(Categoria $categoria)
    {
        $this->selected_id  = $categoria->id;
        $this->nombre       = $categoria->nombre;
        $this->slug         = $categoria->slug;
        $this->emit('show-modal', true);
    }

    public function update()
    {
        $rules = [
            'nombre' => "required|min:5|unique:categorias,nombre,{$this->selected_id}"
        ];

        $messages = [
            'nombre.required'   => 'El nombre de categoría es obligatorio.',
            'nombre.unique'     => 'El nombre de categoría ya esta registrado.',
            'nombre.min'        => 'El nombre de categoria debe tener al menos 5 catacteres.'
        ];

        $this->validate($rules, $messages);
        $categoria          = Categoria::find($this->selected_id);
        $categoria->nombre  = $this->nombre;
        $categoria->slug    = Str::slug($this->nombre);

        if ($this->image) {

            if ($categoria->image != null) {
                if (file_exists('storage/' . $categoria->image)) {
                    unlink('storage/' . $categoria->image);
                }
            }

            $customFileName = '';
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/categorias', $customFileName);
            $categoria->image = 'categorias/' . $customFileName;
        }

        $categoria->save();

        $this->resetUI();
        $this->emit('message-show', 'Categoria editada.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        $this->emit('message-show', 'Categoria eliminada.');
    }

    public function restore($categoria)
    {
        $categoria = Categoria::withTrashed()->find($categoria);
        $categoria->restore();
        $this->emit('message-show', 'Categoria estaurada.');
    }

    public function resetUI()
    {
        $this->nombre       = '';
        $this->slug         = '';
        $this->imagen       = null;
        $this->selected_id  = 0;
    }
}
