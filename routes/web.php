<?php

use App\Http\Livewire\Articulos;
use App\Http\Livewire\Categorias;
use App\Http\Livewire\Compras;
use App\Http\Livewire\Devoluciones;
use App\Http\Livewire\Envios;
use App\Http\Livewire\Movimientos;
use App\Http\Livewire\Pedidos;
use App\Http\Livewire\Pos;
use App\Http\Livewire\Productos;
use App\Http\Livewire\Tiendas;
use App\Http\Livewire\Usuarios;
use App\Http\Livewire\Ventas;
use App\Http\Livewire\VerMovimientos;
use App\Http\Livewire\Welcome;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/', Welcome::class)->name('welcome');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// ADMINISTRADOR
Route::get('usuarios', Usuarios::class)->name('usuarios')->middleware('admin');
Route::get('categorias', Categorias::class)->name('categorias')->middleware('admin');
Route::get('tiendas', Tiendas::class)->name('tiendas')->middleware('admin');
Route::get('productos', Productos::class)->name('productos')->middleware('admin');
Route::get('compras', Compras::class)->name('compras')->middleware('admin');
Route::get('envios', Envios::class)->name('envios')->middleware('admin');
Route::get('ver-movimientos', VerMovimientos::class)->name('ver-movimientos')->middleware('admin');

// ENCARGADOS
Route::get('pos', Pos::class)->name('pos')->middleware('auth');
Route::get('articulos', Articulos::class)->name('articulos')->middleware('auth');
Route::get('ventas', Ventas::class)->name('ventas')->middleware('auth');
Route::get('pedidos', Pedidos::class)->name('pedidos')->middleware('auth');
Route::get('devoluciones', Devoluciones::class)->name('devoluciones')->middleware('auth');
Route::get('movimientos', Movimientos::class)->name('movimientos')->middleware('auth');
