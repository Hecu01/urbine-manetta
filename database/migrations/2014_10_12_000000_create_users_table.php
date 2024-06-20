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
        Schema::create('users', function (Blueprint $table) {

            // Data primary users
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->bigInteger('dni');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('foto',1000)->nullable();

            // Data Admin
            $table->boolean('administrator')->default(false);
            $table->boolean('super_administrator')->default(false);

            // Data Sportivo
            $table->decimal('dinero_en_cuenta', 8, 2)->nullable();
            $table->integer('puntos_sportivo')->nullable();
            $table->integer('compras_realizadas')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
