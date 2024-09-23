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
        Schema::create('reposicion_mercaderias', function (Blueprint $table) {
            $table->id();
            $table->string('estado')->default('Pendiente'); // estados: pendiente, aceptada, cancelado
            $table->foreignId('id_categoria')->nullable()->constrained('categorias')->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reposicion_mercaderias');
    }
};
