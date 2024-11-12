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
        Schema::table('articulo_reposicion_mercaderia', function (Blueprint $table) {
            $table->integer('unidades_aceptadas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articulo_reposicion_mercaderia', function (Blueprint $table) {
            $table->dropColumn('unidades_aceptadas');
        });
    }
};
