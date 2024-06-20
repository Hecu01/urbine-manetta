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
        Schema::create('descuento_usuarios', function (Blueprint $table) {
            $table->id();

            // Foreign key
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('profesion_usuario')->nullable(); 
            $table->text('motivo_descuento')->nullable();
            $table->string('foto_certificado',1000)->nullable();
            $table->integer('porcentaje_descuento')->nullable();
            $table->boolean('descuento_activo')->deafult(false);
            $table->boolean('aceptado')->nullable();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descuento_usuarios');
    }
};
