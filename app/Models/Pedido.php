<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tienda_id',
        'producto_id',
        'cantidad',
        'estado'
    ];

    public function producto()
    {
        return $this->hasOne(Producto::class, 'id', 'producto_id');
    }

    public function tienda()
    {
        return $this->hasOne(Tienda::class, 'id', 'tienda_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
