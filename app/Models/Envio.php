<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Envio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tienda_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function tienda()
    {
        return $this->hasOne(Tienda::class, 'id', 'tienda_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'envio_id', 'id');
    }
}
