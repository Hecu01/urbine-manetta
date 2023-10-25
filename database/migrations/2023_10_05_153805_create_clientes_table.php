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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->bolean('calzado_34')->nullable();
            $table->bolean('calzado_35')->nullable();
            $table->bolean('calzado_36')->nullable();
            $table->bolean('calzado_37')->nullable();
            $table->bolean('calzado_38')->nullable();
            $table->bolean('calzado_39')->nullable();
            $table->bolean('calzado_40')->nullable();
            $table->bolean('calzado_41')->nullable();
            $table->bolean('calzado_42')->nullable();
            $table->bolean('calzado_43')->nullable();
            $table->bolean('calzado_44')->nullable();
            $table->bolean('calzado_45')->nullable();
            $table->bolean('calzado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
