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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();

            // preferentemente si está registrado
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            
            // si el cliente se niega a registrarse en la bd
            // entonces tiene que brindar nombre + apellido + dni 
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->integer('dni')->nullable();


            // otros campos importantes
            $table->integer('unidades'); // Campo para el total de unidades vendidas
            $table->decimal('total', 10, 2); // Campo para el total de la venta
            $table->string('payment_method')->nullable(); // Método de pago
            $table->string('invoice_number')->nullable(); // Número de factura
            $table->text('observacion')->nullable(); // Notas o comentarios

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
