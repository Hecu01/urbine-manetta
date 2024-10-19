<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CreateRopasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ropas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del tipo de producto
            $table->timestamps();
        });

        // Insertar tipos de productos
        DB::table('ropas')->insert([
            ['nombre' => 'Calzas térmicas'],
            ['nombre' => 'Camisetas técnicas'],
            ['nombre' => 'Chalecos'],
            ['nombre' => 'Chaquetas cortaviento'],
            ['nombre' => 'Leggings'],
            ['nombre' => 'Mallas'],
            ['nombre' => 'Musculosa'],
            ['nombre' => 'Pantalones de chándal'],
            ['nombre' => 'Remeras'],
            ['nombre' => 'Ropa de ciclismo'],
            ['nombre' => 'Shorts de running'],
            ['nombre' => 'Sujetadores deportivos'],
            ['nombre' => 'Top deportivo'],
            ['nombre' => 'Trajes de baño'],
            ['nombre' => 'Uniformes de equipo'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ropas');
    }
}
