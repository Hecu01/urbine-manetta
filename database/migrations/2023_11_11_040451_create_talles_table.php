<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('talles', function (Blueprint $table) {
            $table->id();
            $table->string('talle_ropa');
            $table->string('genero');
            $table->integer('largo_cm');
            $table->integer('ancho_cm');
            $table->string('cintura_para');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talles');
    }
};
