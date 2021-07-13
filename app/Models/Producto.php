<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'categoria_id',
        'nombre',
        'slug',
        'descripcion',
        'unidad_medida',
        'precio_unitario',
        'unidad_por_mayor',
        'precio_por_mayor',
        'stock',
        'stock_minimo'
    ];

    public function categoria()
    {
        return $this->hasOne(Categoria::class, 'id', 'categoria_id');
    }

    public function articulos()
    {
        return $this->hasMany(Articulo::class, 'id', 'id');
    }

    public function tiendas()
    {
        return $this->hasMany(Tienda::class, 'id', 'tienda_id');
    }
}
