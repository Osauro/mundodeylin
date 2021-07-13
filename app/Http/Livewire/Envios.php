<?php

namespace App\Http\Livewire;

use App\Models\Articulo;
use App\Models\Envio;
use App\Models\Item;
use App\Models\Producto;
use App\Models\Tienda;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade as PDF;

class Envios extends Component
{
    use WithPagination;

    public $desde;
    public $hasta;
    public $producto;
    public $envio;
    public $tienda = null;
    public $enviar = false;
    public $selected_id;
    public $cantidad;

    public $componentName;

    protected $listeners = [
        'addProducto'           => 'addProducto'
    ];

    private $paginate = 8;
    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->componentName = 'Envios';
        $this->hasta = date("Y-m-d", strtotime(now()));
    }

    public function render()
    {
        if ($this->enviar == false) {
            if ($this->desde and $this->hasta) {
                $envios = Envio::whereDate('created_at', '>=', $this->desde)
                                    ->whereDate('created_at', '<=', $this->hasta)
                                    ->orderBy('created_at', 'DESC')
                                    ->paginate($this->paginate);
            } else {
                $envios = Envio::orderBy('created_at', 'DESC')->paginate($this->paginate);
            }

            $tiendas = Tienda::orderBy('nombre', 'ASC')->get();

            return view('livewire.envios', compact('envios', 'tiendas'))
            ->extends('layouts.main', ['titlePage' => 'Envios', 'activePage' => 'envios'])
            ->section('content');

        } else {
            $items = Item::where('envio_id', $this->envio->id)->paginate(3);
            return view('livewire.envios', compact('items'))
            ->extends('layouts.main', ['titlePage' => 'Envios', 'activePage' => 'envios'])
            ->section('content');
        }

    }

    public function enviar()
    {
        if (is_null($this->tienda)) {
            $this->emit('select-tienda', true);
        }
        else {
            $this->tienda = Tienda::find($this->tienda);
            Envio::create([
                'user_id'   => Auth::user()->id,
                'tienda_id' => $this->tienda->id,
                'estado'    => 'Pendiente'
            ]);
            return redirect()->to('envios');
        }
    }

    public function verEnvio(Envio $envio)
    {
        $this->envio = $envio;
        $this->tienda = $envio->tienda;
        $this->enviar = true;
    }

    public function addProducto($qrcode)
    {
        $this->producto = Producto::where('codigo', '=', $qrcode)->first();

        $item = $this->envio->items->where('producto_id', $this->producto->id)->first();

        if (!is_null($item)) {
            $this->edit($item);
        } else {
            $this->emit('show-modal', true);
        }
    }

    public function store()
    {
        if ($this->producto->stock >= $this->cantidad) {
            $rules = [
                'cantidad'   => 'required',
            ];

            $messages = [
                'cantidad.required' => 'La cantidad es requerida.',
            ];

            $this->validate($rules, $messages);

            $item                   = new Item;
            $item->envio_id         = $this->envio->id;
            $item->producto_id      = $this->producto->id;
            $item->cantidad         = $this->cantidad;
            $item->save();
            $this->resetUI();
            $this->emit('message-show', 'Producto agregado.');
        } else {
            $this->resetUI();
            $this->emit('message-error', 'La cantidad es superior al stock.');
        }
    }

    public function edit(Item $item)
    {
        $this->cantidad     = $item->cantidad;
        $this->selected_id  = $item->id;
        $this->emit('show-modal', true);
    }

    public function update()
    {
        $item = Item::find($this->selected_id);
        $item->cantidad = $this->cantidad;
        $item->save();
        $this->resetUI();
        $this->emit('message-show', 'Item actualizado.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
    }

    public function resetUI()
    {
        $this->selected_id    = 0;
        $this->cantidad       = '';
    }

    public function completar()
    {
        foreach ($this->envio->items as $item) {

            $producto = Producto::find($item->producto_id);
            $producto->stock = $producto->stock - $item->cantidad;
            $producto->save();

            $articulo = $this->tienda->articulos->where('producto_id', $producto->id)->first();

            if ($articulo) {
                $articulo->nombre = $producto->nombre;
                $articulo->cantidad = $articulo->cantidad + $item->cantidad;
                $articulo->save();
            } else {
                $articulo = new Articulo();
                $articulo->tienda_id = $this->envio->tienda->id;
                $articulo->producto_id = $producto->id;
                $articulo->nombre = $producto->nombre;
                $articulo->codigo = $producto->codigo;
                $articulo->cantidad = $item->cantidad;
                $articulo->save();
            }
        }
        $this->envio->estado = 'Completado';
        $this->envio->save();
        return redirect()->to(route('envios'));
    }

    public function cancelar()
    {
        $this->envio->estado = 'Cancelado';
        $this->envio->save();
        $this->enviar = false;
    }

    public function imprimirPDF(Envio $envio)
    {
        $pdf = PDF::loadView('reportes.envios', compact('envio'))->save('storage/reportes/envios.pdf');
        return response()->download('storage/reportes/envios.pdf');
    }
}
