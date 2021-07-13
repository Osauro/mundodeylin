<?php

namespace App\Http\Livewire;

use App\Models\Tienda;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Tiendas extends Component
{
    use WithPagination;

    public $search;
    public $user_id;
    public $nombre;
    public $telefono;
    public $ciudad;
    public $direccion;
    public $ubicacion;
    public $selected_id;

    public $componentName;
    private $paginate = 5;
    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->componentName = "Tiendas";
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $usuarios = User::orderBy('name', 'ASC')->get();

        $tiendas = Tienda::withTrashed()
                            ->where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('ciudad', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('telefono', 'LIKE', '%' . $this->search . '%')
                            ->paginate($this->paginate);

        return view('livewire.tiendas', compact('tiendas', 'usuarios'))
        ->extends('layouts.main', ['titlePage' => 'Tiendas', 'activePage' => 'tiendas'])
        ->section('content');
    }

    public function store()
    {
        $rules = [
            'user_id'   => 'required|unique:tiendas',
            'nombre'    => 'required|unique:tiendas|min:5',
            'telefono'  => 'required|unique:tiendas',
            'ciudad'    => 'required',
            'direccion' => 'required',
            'ubicacion' => 'required'
        ];

        $messages = [
            'user_id.required'      => 'La tienda debe tener un encargado.',
            'user_id.unique'        => 'El encargado esta ocupado.',
            'nombre.required'       => 'El nombre es requerido.',
            'nombre.unique'         => 'El nombre ya esta en uso.',
            'nombre.min'            => 'El nombre debe contener almenos tres caracteres.',
            'telefono.required'     => 'El teléfono es requerido.',
            'telefono.unique'       => 'El teléfono ya esta en uso.',
            'ciudad.required'       => 'La ciudad es requerida.',
            'direccion'             => 'La dirección es requerida.',
            'ubicacion'             => 'La ubicación es requerida.'
        ];

        $this->validate($rules, $messages);

        Tienda::create([
            'user_id'   => $this->user_id,
            'nombre'    => $this->nombre,
            'telefono'  => $this->telefono,
            'ciudad'    => $this->ciudad,
            'direccion' => $this->direccion,
            'ubicacion' => $this->ubicacion
        ]);

        $this->resetUI();
        $this->emit('message-show', 'Tienda agregada.');
    }

    public function edit(Tienda $tienda)
    {
        $this->selected_id  = $tienda->id;
        $this->user_id      = $tienda->user_id;
        $this->nombre       = $tienda->nombre;
        $this->telefono     = $tienda->telefono;
        $this->ciudad       = $tienda->ciudad;
        $this->direccion    = $tienda->direccion;
        $this->ubicacion    = $tienda->ubicacion;
        $this->emit('show-modal', true);
    }

    public function update()
    {
        $rules = [
            'user_id'   => "required|unique:tiendas,user_id, {$this->selected_id}",
            'nombre'    => "required|min:5|unique:tiendas,nombre, {$this->selected_id}",
            'telefono'  => "required|unique:tiendas,telefono, {$this->selected_id}",
            'ciudad'    => 'required',
            'direccion' => 'required',
            'ubicacion' => 'required'
        ];

        $messages = [
            'user_id.required'      => 'La tienda debe tener un encargado.',
            'user_id.unique'        => 'El encargado esta ocupado.',
            'nombre.required'       => 'El nombre es requerido.',
            'nombre.unique'         => 'El nombre ya esta en uso.',
            'nombre.min'            => 'El nombre debe contener almenos tres caracteres.',
            'telefono.required'     => 'El teléfono es requerido.',
            'telefono.unique'       => 'El teléfono ya esta en uso.',
            'ciudad.required'       => 'La ciudad es requerida.',
            'direccion'             => 'La dirección es requerida.',
            'ubicacion'             => 'La ubicación es requerida.'
        ];

        $this->validate($rules, $messages);

        $tienda = Tienda::find($this->selected_id);

        $tienda->user_id   = $this->user_id;
        $tienda->nombre    = $this->nombre;
        $tienda->telefono  = $this->telefono;
        $tienda->ciudad    = $this->ciudad;
        $tienda->direccion = $this->direccion;
        $tienda->ubicacion = $this->ubicacion;

        $tienda->save();

        $this->resetUI();

        $this->emit('message-show', 'Tienda actualizada');
    }

    public function destroy(Tienda $tienda)
    {
        $tienda->user_id = 1;
        $tienda->save();
        $tienda->delete();
        $this->emit('message-show', 'Tienda eliminada.');
    }

    public function restore($tienda)
    {
        $tienda = Tienda::withTrashed()->find($tienda);
        $tienda->restore();
        $this->edit($tienda);
    }

    public function resetUI()
    {
        $this->user_id      = '';
        $this->nombre       = '';
        $this->telefono     = '';
        $this->ciudad       = '';
        $this->direccion    = '';
        $this->ubicacion    = '';
        $this->selected_id  = 0;
    }
}
