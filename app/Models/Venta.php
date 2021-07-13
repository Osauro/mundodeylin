<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(Item::class, 'venta_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function tienda()
    {
        return $this->hasOne(Tienda::class, 'id', 'tienda_id');
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id', 'cliente_id');
    }
}
