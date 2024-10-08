<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->decimal('total', 10, 2); // Total de compra
            $table->dateTime('fecha'); // Fecha de compra
            $table->unsignedBigInteger('user_id')->nullable(); // Añadir user_id como columna
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
