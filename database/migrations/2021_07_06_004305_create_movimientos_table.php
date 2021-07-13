<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('tienda_id')->constrained('tiendas');
            $table->enum('detalle', ['Apertura de caja', 'Cierre de caja', 'Depósito', 'Retiro', 'Venta']);
            $table->string('descripcion')->nullable();
            $table->decimal('ingreso', 9, 2)->nullable();
            $table->decimal('egreso', 9, 2)->nullable();
            $table->decimal('saldo', 9, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
