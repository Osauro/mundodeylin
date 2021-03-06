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
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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
    public $search;

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
        if(strlen($this->search) > 0) {
            $productos = Producto::where('nombre', 'LIKE', '%' . $this->search . '%')->paginate($this->paginate);
            return view('livewire.envios', compact('productos'))
            ->extends('layouts.main', ['titlePage' => 'Envios', 'activePage' => 'envios'])
            ->section('content');
        }

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

        }

        if ($this->enviar == true) {
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
        $this->emit('message-show', 'Item eliminado.');
    }

    public function resetUI()
    {
        $this->selected_id    = null;
        $this->cantidad       = null;
        $this->search         = null;
        $this->producto       = null;
    }

    public function completar()
    {
        $cabecera = '';
        $cabecera .= Str::padRight("FECHA:", 12, " ") . Carbon::parse($this->envio->created_at)->format('d/m/Y H:i:s') . "\n";
        $cabecera .= Str::padRight("TIENDA:", 12, " ") . $this->envio->tienda->nombre . "\n";
        $cabecera .= Str::padRight("DIRECCION:", 12, " ") . $this->envio->tienda->direccion . "\n";
        $cabecera .= Str::padRight("ENCARGADO:", 12, " ") . $this->envio->user->name . "\n";

        $productos = '';

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

            $cantidad = Str::padLeft($item->cantidad, 4, '0') . " (" . Str::limit($item->producto->unidad_medida, '3') . ") ";
            $producto = Str::of($cantidad . $item->producto->nombre)->limit(45);
            $productos .= $producto . "\n";
        }
        $this->envio->estado = 'Completado';
        $this->envio->save();
        $this->emit('imprimir', ['cabecera' => $cabecera, 'productos' => $productos]);
        $this->enviar = false;
        $this->envio = null;
        $this->tienda = null;
    }

    public function cancelar()
    {
        $this->envio->estado = 'Cancelado';
        $this->envio->save();
        $this->enviar = false;
        $this->envio = null;
        $this->tienda = null;
        $this->emit('message-show', 'Envio cancelado.');
    }

    public function imprimirPDF(Envio $envio)
    {
        $pdf = PDF::loadView('reportes.envios', compact('envio'))->save('storage/reportes/envios.pdf');
        return response()->download('storage/reportes/envios.pdf');
    }
}
