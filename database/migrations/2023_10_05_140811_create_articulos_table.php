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
            $table->string('genero')->nullable();
            $table->decimal('precio', 8, 2)->nullable();
            $table->string('marca')->nullable();
            $table->foreignId('id_categoria')->nullable()->constrained('categorias')->cascadeOnUpdate()->nullOnDelete();
            $table->string('color')->nullable();
            $table->integer('stock')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('tipo_producto')->nullable(); // calzado, ropa, accesorio
            $table->string('dirigido_a')->nullable(); //niños, adultos, ambos
            $table->string('foto',1000)->nullable();

            // Añade una columna para la relación con descuentos
            $table->unsignedBigInteger('descuento_id')->nullable()->unique()->constrained('descuentos')->onDelete('cascade');

            
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
