<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articulo_compra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compra_id');
            $table->unsignedBigInteger('articulo_id');
            $table->unsignedBigInteger('talle_id')->nullable();
            $table->unsignedBigInteger('calzado_id')->nullable();
            $table->integer('cantidad'); // Cantidad de cada artículo en esta compra
            $table->decimal('precio_unitario', 10, 2); // Precio unitario en esta compra
            $table->timestamps();

            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('cascade');
            $table->foreign('talle_id')->references('id')->on('talles')->onDelete('cascade');
            $table->foreign('calzado_id')->references('id')->on('calzados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulo_compra');
    }
};
