<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tienda extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'nombre',
        'telefono',
        'ciudad',
        'direccion',
        'ubicacion'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function articulos()
    {
        return $this->hasMany(Articulo::class, 'tienda_id', 'id');
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'tienda_id', 'id');
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'tienda_id', 'id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'tienda_id', 'id');
    }

    public function devoluciones()
    {
        return $this->hasMany(Devolucion::class, 'tienda_id', 'id');
    }
}
