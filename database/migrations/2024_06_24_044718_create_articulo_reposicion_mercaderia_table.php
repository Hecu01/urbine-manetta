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
        Schema::create('articulo_reposicion_mercaderia', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('articulo_id'); // Articulo a reponer
            $table->unsignedBigInteger('reposicion_mercaderia_id'); // operacion de reposicion de mercaderia
            $table->unsignedBigInteger('talla_id')->nullable(); // talla si es ropa deportiva       
            $table->unsignedBigInteger('calzado_id')->nullable(); // calzado si es un botín o zapatilla (por ejemplo)
            $table->string('valor_calzado_talle')->nullable(); 
            $table->integer('cantidad');

            // Claves foráneas
            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('cascade');
            $table->foreign('reposicion_mercaderia_id')->references('id')->on('reposicion_mercaderias')->onDelete('cascade');
            $table->foreign('talla_id')->references('id')->on('talles')->onDelete('set null');
            $table->foreign('calzado_id')->references('id')->on('calzados')->onDelete('set null');
       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulo_reposicion_mercaderia');
    }
};
