<?php

namespace App\Http\Livewire;

use App\Models\Articulo;
use App\Models\Devolcucion;
use App\Models\Devolucion;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Tienda;
use Livewire\Component;

class Admin extends Component
{

    public $tienda;

    public function render()
    {
        $tiendas = Tienda::orderBy('nombre', 'ASC')->get();

        if ($this->tienda) {
            $tienda = Tienda::find($this->tienda);
            $pedidos = $tienda->pedidos->where('estado', '=', 'Pendiente');
            $devoluciones = $tienda->devoluciones->where('estado', '=', 'Pendiente');
        } else {
            $pedidos = Pedido::where('estado', '=', 'Pendiente')->orderBy('created_at', 'DESC')->get();
            $devoluciones = Devolucion::where('estado', '=', 'Pendiente')->orderBy('created_at', 'DESC')->get();
        }
        return view('livewire.admin', compact('pedidos', 'devoluciones', 'tiendas'));
    }

    public function cancelarPedido(Pedido $pedido)
    {
        $pedido->estado = "Cancelado";
        $pedido->save();
        $this->emit('message-show', 'Pedido cancelado.');
    }

    public function aceptarPedido(Pedido $pedido)
    {
        $pedido->estado = "Completado";
        $pedido->save();
        $this->emit('message-show', 'Pedido completado.');

    }

    public function cancelarDevolucion(Devolucion $devolucion)
    {
        $devolucion->estado = "Cancelado";
        $devolucion->save();
        $this->emit('message-show', 'Devolución cancelada.');
    }

    public function aceptarDevolucion(Devolucion $devolucion)
    {
        // DEVOLVEMOS EL PRODUCTO
        $producto = Producto::find($devolucion->producto_id);
        $producto->stock = $producto->stock + $devolucion->cantidad;
        $producto->save();
        // DISMINUIMOS EL ESTOCK EN TIENDA
        $articulo = Articulo::where('producto_id', $producto->id)
        ->where('tienda_id', $devolucion->tienda_id)->first();
        $articulo->cantidad = $articulo->cantidad - $devolucion->cantidad;
        $articulo->save();
        // ACTUALIZAMOS LA DEVOLUCIONS
        $devolucion->estado = "Completado";
        $devolucion->save();
        $this->emit('message-show', 'Devolución completada.');
    }
}
