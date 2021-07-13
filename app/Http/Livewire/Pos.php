<?php

namespace App\Http\Livewire;

use App\Models\Articulo;
use App\Models\Cliente;
use App\Models\Item;
use App\Models\Movimiento;
use App\Models\Producto;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Illuminate\Support\Str;

class Pos extends Component
{
    use WithPagination;

    public $venta;
    public $efectivo;
    public $cambio;
    public $total = 0;
    public $vender = false;
    public $tienda;
    public $cliente = null;
    public $nit;
    public $nombre;
    public $componentName;
    public $selected_id = 0;

    private $paginate = 8;
    protected $paginationTheme = "bootstrap";

    protected $listeners = [
        'addProducto'           => 'addProducto'
    ];

    public function mount()
    {
        $this->componentName = 'Cliente';

        if (isset($_GET['venta'])) {
            $this->venta = Venta::find($_GET['venta']);
            $this->vender = $_GET['vender'];
        }
        $this->tienda = Auth()->user()->tienda;

        if (is_null($this->tienda)) {
            abort(401);
        }
    }

    public function render()
    {
        if ($this->vender == false) {
            return view('livewire.pos', ['items' => null])
            ->extends('layouts.main', ['titlePage' => 'POS', 'activePage' => 'pos'])
            ->section('content');
        }

        $items = Item::where('venta_id', '=', $this->venta->id)->paginate($this->paginate);
        return view('livewire.pos', compact('items'))
        ->extends('layouts.main', ['titlePage' => 'POS', 'activePage' => 'pos'])
        ->section('content');
    }

    public function addMoney($monto)
    {
        if ($this->venta) {
            $this->efectivo = $this->efectivo + $monto;
            $this->calcularPago();
        } else {
            $this->emit('message-error', 'Inicia una venta.');
        }
    }

    public function calcularPago()
    {
        $this->total = $this->venta->items->sum('precio_total');
        $this->cambio = $this->efectivo - $this->total;
    }

    public function resetUI()
    {
        $this->efectivo = null;
        $this->cambio = null;
        $this->total = null;
    }

    public function addProducto($qrcode)
    {
        if (is_null($this->venta)) {
            $this->emit('message-error', 'Inicia una venta.');
        } else {
            if ($this->venta->estado == "Pendiente") {
                $articulo = $this->tienda->articulos->where('codigo', '=', $qrcode)->first();
                if (!is_null($articulo)) {
                    $item = $this->venta->items->where('producto_id', '=', $articulo->producto_id)->first();
                    if (!is_null($item)) {
                        $cantidad = $item->cantidad + 1;
                        if ($cantidad > $articulo->cantidad) {
                            $this->emit('message-error', 'Producto insuficiente.');
                        } else {
                            $item->cantidad = $cantidad;
                            if ($cantidad >= $item->producto->unidad_por_mayor) {
                                $item->precio_unitario = $item->producto->precio_por_mayor;
                                $item->precio_total = $item->producto->precio_por_mayor * $cantidad;
                                $item->save();
                            } else {
                                $item->precio_total = $item->precio_unitario * $cantidad;
                                $item->save();
                            }
                        }
                    } else {
                        if ($articulo->cantidad > 0) {
                            $item = new Item();
                            $item->venta_id = $this->venta->id;
                            $item->producto_id = $articulo->producto->id;
                            $item->cantidad = 1;
                            $item->precio_unitario = $articulo->producto->precio_unitario;
                            $item->precio_total = $item->cantidad * $item->precio_unitario;
                            $item->save();
                        } else {
                            $this->emit('message-error', 'Producto insuficiente.');
                        }
                    }
                } else {
                    $this->emit('message-error', 'El articulo no existe.');
                }
            } else {
                $this->emit('message-error', 'Venta cancelada.');
            }
        }


    }

    public function iniciarVenta()
    {
        if ($this->cliente) {
            $this->resetUI();
            $this->venta = new Venta();
            $this->venta->user_id = Auth::id();
            $this->venta->tienda_id = Auth()->user()->tienda->id;
            $this->venta->cliente_id = $this->cliente->id;
            $this->venta->save();
            $this->vender = true;
        } else {
            $this->emit('show-modal', true);
        }
    }

    public function store()
    {
        $rules = [
            'nit' => 'required|unique:clientes',
            'nombre' => 'required'
        ];

        $messages = [
            'nit.required'      => 'El NIT o DNI es requerido.',
            'nit.unique'        => 'El NIT o DNI esta registrado.',
            'nombre.required'   => 'El nombre o razón social es requerido.'
        ];

        $this->validate($rules, $messages);

        $this->cliente = new Cliente();
        $this->cliente->nit = $this->nit;
        $this->cliente->nombre = $this->nombre;
        $this->cliente->save();
        $this->emit('message-show', 'Cliente agregado.');
        $this->iniciarVenta();
    }

    public function buscar()
    {
        $this->cliente = Cliente::where('nit', $this->nit)->first();
        if (!is_null($this->cliente)) {
            $this->emit('message-show', 'Cliente encontrado.');
            $this->iniciarVenta();
        }
    }

    public function completar()
    {
        $this->calcularPago();

        if ($this->total > $this->efectivo) {
            $this->emit('message-error', 'Efectivo insuficiente.');
        } else {
            foreach ($this->venta->items as $item) {
                $articulo = $this->tienda->articulos->where('producto_id', $item->producto_id)->first();
                $articulo->cantidad = $articulo->cantidad - $item->cantidad;
                $articulo->save();
            }

            $saldo = $this->tienda->movimientos()->orderBy('created_at', 'DESC')->first();
            if ($saldo) {
                $saldo = $saldo->saldo;
            }

            $movimiento = new Movimiento();
            $movimiento->user_id = Auth()->user()->id;
            $movimiento->tienda_id = $this->tienda->id;
            $movimiento->detalle = "Venta";
            $movimiento->descripcion = "Venta de productos.";
            $movimiento->ingreso = $this->total;
            $movimiento->saldo = $saldo + $this->total;
            $movimiento->save();

            $this->venta->estado = "Completado";
            $this->venta->save();
            $this->vender = false;
            $this->cliente = null;
            $this->nombre = null;
            $this->nit = null;

            $this->imprimirPOS($this->venta);
            $this->resetUI();
            $this->emit('message-show', 'Venta completada.');
        }
    }

    public function cancelar()
    {
        $this->venta->estado = "Cancelado";
        $this->venta->save();
        $this->vender = false;
        $this->cliente = null;
        $this->nombre = null;
        $this->nit = null;
        $this->resetUI();
    }

    public function destroy(Item $item)
    {
        $item->delete();
        $this->emit('message-show', 'Item eliminado.');
    }

    public function imprimirPOS(Venta $venta)
    {
        $nombreImpresora = "TMT20";
        //$nombreImpresora = "POS58";
        $conector = new WindowsPrintConnector($nombreImpresora);
        $impresora = new Printer($conector);
        $impresora->setJustification(Printer::JUSTIFY_CENTER);
        $impresora->setTextSize(2, 2);
        $impresora->text(env("APP_NAME") . "\n");
        $impresora->setTextSize(1, 1);
        $impresora->feed(1);
        $impresora->text("**** V E N T A ****\n");
        $impresora->feed(1);
        $impresora->setJustification(Printer::JUSTIFY_LEFT);
        $impresora->text(Str::padRight("FECHA:", 9, " ") . Carbon::parse($venta->created_at)->format('d/m/Y H:i:s') . "\n");
        $impresora->text(Str::padRight("CLIENTE:", 9, " ") . $venta->cliente->nombre . "\n");
        $impresora->text(Str::padRight("NIT/CI:", 9, " ") . $venta->cliente->nit . "\n");
        $impresora->setJustification(Printer::JUSTIFY_CENTER);
        $impresora->feed(1);
        $impresora->text("====== P R O D U C T O S ======\n");
        $impresora->feed(1);
        $impresora->setJustification(Printer::JUSTIFY_RIGHT);
        foreach ($venta->items as $item) {

            $cantidad = $item->cantidad . " (" . $item->producto->unidad_medida . ") ";

            $producto = Str::of(Str::padRight($cantidad . $item->producto->nombre, 100, '.'))->limit(35);

            $precio = Str::padLeft($item->precio_total, 10, '.');

            $impresora->text($producto . $precio . "\n");
        }
        $impresora->setJustification(Printer::JUSTIFY_RIGHT);
        $impresora->text("____________________\n");
        $impresora->text(Str::padRight("TOTAL:", 12, " "));
        $impresora->text(Str::padLeft(number_format($venta->items->sum('precio_total'), 2, '.', ''), 7, ' ') . "\n");
        $impresora->feed(1);
        $impresora->text(Str::padRight("EFECTIVO:", 12, " "));
        $impresora->text(Str::padLeft(number_format($this->efectivo, 2, '.', ''), 7, ' ') . "\n");
        $impresora->text(Str::padRight("CAMBIO:", 12, " "));
        $impresora->text(Str::padLeft(number_format($this->cambio, 2, '.', ''), 7, ' ') . "\n");
        $impresora->setJustification(Printer::JUSTIFY_CENTER);
        $impresora->feed(2);
        $impresora->setTextSize(1, 1);
        $impresora->text("___GRACIAS POR SU COMPRA___");
        $impresora->feed(5);
        $impresora->cut();
        $impresora->close();
    }
}
