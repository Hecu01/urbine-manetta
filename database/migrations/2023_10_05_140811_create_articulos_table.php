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
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('talle')->nullable();
            $table->string('genero')->nullable();
            $table->string('precio')->nullable();
            $table->string('marca')->nullable();
            
            // Categoria
            $table ->foreignId('id_categoria')
                   ->nullable()
                   ->constrained('categorias')
                   ->cascadeOnUpdate()
                   ->nullOnDelete();

            $table->string('color')->nullable();
            $table->string('stock')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('foto',1000)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos');
    }
};
