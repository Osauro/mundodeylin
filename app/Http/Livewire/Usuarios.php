<?php

namespace App\Http\Livewire;

use App\Mail\UserPassword;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class Usuarios extends Component
{
    use WithPagination;

    public $search;
    public $name;
    public $email;
    public $dni;
    public $celular;
    public $direccion;
    public $selected_id;
    public $tipo;

    public $componentName;
    private $paginate = 5;
    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->componentName = "Usuarios";
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $usuarios = User::withTrashed()
                        ->where('name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                        ->paginate($this->paginate);

        return view('livewire.usuarios', compact('usuarios'))
                ->extends('layouts.main', ['titlePage' => 'Usuarios', 'activePage' => 'usuarios'])
                ->section('content');

    }

    public function store()
    {
        $rules = [
            'name'      => 'required|unique:users|min:5|max:16',
            'email'     => 'required|email|unique:users',
            'dni'       => 'required',
            'celular'   => 'required|unique:users',
            'direccion' => 'required',
        ];

        $messages = [
            'name.required'         => 'El nombre de usuario es requerido.',
            'name.unique'           => 'El nombre de usuario ya esta registrado.',
            'name.min'              => 'El nombre de usuario debe tener al menos 5 caracteres.',
            'name.max'              => 'El nombre de usuario debe tener máximo 16 caracteres.',
            'email.required'        => 'El email es requerido.',
            'email.unique'          => 'El email ya esta registrado.',
            'dni.required'          => 'El carnet de indentidad es requerido.',
            'name.required'         => 'El celular es requerido.',
            'name.unique'           => 'El celular ya esta registrado.',
            'direccion.required'    => 'La dirección es requerida.',
            'tipo.required'         => 'El tipo es requerido.',
        ];

        $this->validate($rules, $messages);

        $clave = rand(10000, 99999);

        $user = User::create([
            'name'          => $this->name,
            'email'         => $this->email,
            'dni'           => $this->dni,
            'celular'       => $this->celular,
            'direccion'     => $this->direccion,
            'password'      => Hash::make($clave)
        ]);

        Mail::to($user->email)->send(new UserPassword($user, $clave));

        $this->emit('message-show', 'Usuario agregado');
    }

    public function edit(User $user)
    {
        $this->name         = $user->name;
        $this->email        = $user->email;
        $this->dni          = $user->dni;
        $this->celular      = $user->celular;
        $this->direccion    = $user->direccion;
        $this->tipo         = $user->tipo;
        $this->selected_id  = $user->id;
        $this->emit('show-modal', true);
    }

    public function update()
    {
        $rules = [
            'name'      => ['required', 'min:3', 'unique:users,name,' . $this->selected_id],
            'email'     => ['required', 'unique:users,email,' . $this->selected_id],
            'dni'       => ['required', 'unique:users,dni,' . $this->selected_id],
            'celular'   => ['required', 'unique:users,celular,' . $this->selected_id],
            'direccion' => ['required'],
        ];

        $messages = [
            'name.required'         => 'El nombre de usuario es requerido.',
            'name.unique'           => 'El nombre de usuario ya esta registrado.',
            'name.min'              => 'El nombre de usuario debe tener al menos 5 caracteres.',
            'name.max'              => 'El nombre de usuario debe tener máximo 16 caracteres.',
            'email.required'        => 'El email es requerido.',
            'email.unique'          => 'El email ya esta registrado.',
            'dni.required'          => 'El carnet de indentidad es requerido.',
            'celular.required'      => 'El celular es requerido.',
            'celular.unique'        => 'El celular ya esta registrado.',
            'direccion.required'    => 'La dirección es requerida.',
            'tipo.required'         => 'El tipo es requerido.',
        ];

        $this->validate($rules, $messages);

        $clave = rand(10000, 99999);

        $user = User::find($this->selected_id);
        $user->name          = $this->name;
        $user->email         = $this->email;
        $user->password      = Hash::make($clave);
        $user->dni           = $this->dni;
        $user->celular       = $this->celular;
        $user->direccion     = $this->direccion;
        $user->tipo          = $this->tipo;
        $user->save();
        Mail::to($user->email)->send(new UserPassword($user, $clave));
        $this->emit('message-show', 'Usuario actualizado.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        $this->emit('message-show', 'Usuario eliminado');
    }

    public function restore($user)
    {
        $user = User::withTrashed()->find($user);
        $user->restore();
        $this->emit('message-show', 'Usuario restaurado');
    }

    public function resetUI()
    {
        $this->name         = '';
        $this->email        = '';
        $this->dni          = '';
        $this->celular      = '';
        $this->direccion    = '';
        $this->selected_id  = 0;
    }
}
