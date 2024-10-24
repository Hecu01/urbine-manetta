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
        Schema::create('domicilios', function (Blueprint $table) {
            $table->id();
            
            // Foreign key
            $table->unsignedBigInteger('user_id')->unique();

            // Domicilio
            $table->string('pais');
            $table->string('provincia');
            $table->string('calle');
            $table->string('barrio')->nullable();
            $table->string('departamento')->nullable();
            $table->string('piso')->nullable();
            $table->string('ciudad');
            $table->string('codigo_postal');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domicilios');
    }
};
