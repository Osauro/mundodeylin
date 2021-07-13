<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\Item;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade as PDF;

class Compras extends Component
{
    use WithPagination;

    public $desde;
    public $hasta;
    public $producto;
    public $compra;
    public $comprar = false;
    public $selected_id;
    public $precio;
    public $cantidad;

    public $componentName;

    protected $listeners = [
        'addProducto'           => 'addProducto'
    ];

    private $paginate = 8;
    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->componentName = 'Compras';
        $this->hasta = date("Y-m-d", strtotime(now()));
    }

    public function render()
    {


        if ($this->comprar == false) {
            if ($this->desde and $this->hasta) {
                $compras = Compra::whereDate('created_at', '>=', $this->desde)
                ->whereDate('created_at', '<=', $this->hasta)
                ->orderBy('created_at', 'DESC')
                ->paginate($this->paginate);
            } else {
                $compras = Compra::orderBy('created_at', 'DESC')->paginate($this->paginate);
            }

            return view('livewire.compras', compact('compras'))
            ->extends('layouts.main', ['titlePage' => 'Compras', 'activePage' => 'compras'])
            ->section('content');
        } else {
            $productos = Producto::orderBy('nombre','ASC')->get();
            $items = Item::where('compra_id', $this->compra->id)->paginate(3);
            return view('livewire.compras', compact('items','productos'))
            ->extends('layouts.main', ['titlePage' => 'Compras', 'activePage' => 'compras'])
            ->section('content');
        }
    }

    public function comprar()
    {
        $compra = Compra::create([
            'user_id'   => Auth::user()->id,
            'estado'    => 'Pendiente'
        ]);
        $this->compra = $compra;
        $this->comprar = true;
    }

    public function verCompra($compra)
    {
        $compra = Compra::find($compra);
        $this->compra = $compra;
        $this->comprar = true;
    }

    public function addProducto($qrcode)
    {
        $this->resetUI();

        $this->producto = Producto::where('codigo', '=', $qrcode)->first();

        $item = Item::where('compra_id', $this->compra->id)
                    ->where('producto_id', $this->producto->id)->first();

        if ($item) {
            $this->edit($item);
        } else {
            $this->emit('show-modal', true);
        }

    }

    public function store()
    {
        $rules = [
            'cantidad'   => 'required',
            'precio'    => 'required'
        ];

        $messages = [
            'cantidad.required' => 'La cantidad es requerida.',
            'precio.required'   => 'El precio es requerido.'
        ];
        $this->validate($rules, $messages);

        $item                   = new Item;
        $item->compra_id        = $this->compra->id;
        $item->producto_id      = $this->producto->id;
        $item->cantidad         = $this->cantidad;
        $item->precio_unitario  = $this->precio / $this->cantidad;
        $item->precio_total     = $this->precio;
        $item->save();
        $this->resetUI();
        $this->emit('message-show', 'Producto agregado.');
    }

    public function edit(Item $item)
    {
        $this->cantidad     = $item->cantidad;
        $this->precio       = $item->precio_total;
        $this->selected_id  = $item->id;
        $this->emit('show-modal', true);
    }

    public function update()
    {
        $item = Item::find($this->selected_id);
        $item->cantidad = $this->cantidad;
        $item->precio_total = $this->precio;
        $item->precio_unitario = $this->precio / $this->cantidad;
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
        $this->precio         = '';
        $this->cantidad       = '';
    }

    public function completar()
    {
        foreach ($this->compra->items as $item) {
            $producto = Producto::find($item->producto_id);
            $producto->stock = $producto->stock + $item->cantidad;
            $producto->save();
        }

        $this->compra->estado = 'Completado';
        $this->compra->save();
        $this->comprar = false;
    }

    public function cancelar()
    {
        $this->compra->estado = 'Cancelado';
        $this->compra->save();
        $this->comprar = false;
    }

    public function imprimirPDF(Compra $compra)
    {
        $pdf = PDF::loadView('reportes.compras', compact('compra'))->save('storage/reportes/compras.pdf');
        return response()->download('storage/reportes/compras.pdf');
    }
}
