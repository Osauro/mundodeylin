<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    public function producto()
    {
        return $this->hasOne(Producto::class, 'id', 'producto_id');
    }
}
