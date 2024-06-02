<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArticulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('articulos')->insert([
            [
                'id' => 1,
                'nombre' => 'Pelota de Voley amarilla y azul',
                'talle' => NULL,
                'genero' => 'U',
                'precio' => 13000.00,
                'marca' => 'Gold',
                'id_categoria' => 1,
                'color' => 'Amarillo',
                'stock' => 10,
                'descripcion' => NULL,
                'tipo_producto' => 'accesorio',
                'dirigido_a' => 'ambos',
                'foto' => 'pelota-de-voley-gold-numero-5-amarilla-121040000330002-1.jpg',
                'descuento_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'nombre' => 'Pelota de Fútbol rojo y azul',
                'talle' => NULL,
                'genero' => 'U',
                'precio' => 20000.00,
                'marca' => 'Otro',
                'id_categoria' => 1,
                'color' => 'Rojo',
                'stock' => 13,
                'descripcion' => NULL,
                'tipo_producto' => 'accesorio',
                'dirigido_a' => 'ambos',
                'foto' => '1414-2.jpg',
                'descuento_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'nombre' => 'Botines de futbol 11',
                'talle' => NULL,
                'genero' => 'U',
                'precio' => 34350.00,
                'marca' => 'Adidas',
                'id_categoria' => 1,
                'color' => 'Blanco',
                'stock' => 10,
                'descripcion' => NULL,
                'tipo_producto' => 'calzado',
                'dirigido_a' => 'adultos',
                'foto' => 'ADHQ8944-1.JPG',
                'descuento_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'nombre' => 'Botines de futbol 11 rosa adidas',
                'talle' => NULL,
                'genero' => 'F',
                'precio' => 45320.00,
                'marca' => 'Adidas',
                'id_categoria' => 1,
                'color' => 'Fuxia',
                'stock' => 9,
                'descripcion' => NULL,
                'tipo_producto' => 'calzado',
                'dirigido_a' => 'adultos',
                'foto' => 'botines.JPG',
                'descuento_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
