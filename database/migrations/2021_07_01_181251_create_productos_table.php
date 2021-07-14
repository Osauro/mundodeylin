<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->string('nombre')->unique();
            $table->string('slug')->unique()->nullable();
            $table->string('codigo')->nullable();
            $table->string('image')->nullable();
            $table->string('descripcion');
            $table->string('unidad_medida');
            $table->decimal('precio_unitario', 9, 2)->nullable();
            $table->integer('unidad_por_mayor')->nullable();
            $table->decimal('precio_por_mayor', 9, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->integer('stock_minimo')->default(0);
            //$table->bigInteger('ventas')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('productos');
    }
}
