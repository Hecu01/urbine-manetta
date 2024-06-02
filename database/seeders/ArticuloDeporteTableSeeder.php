<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticuloDeporteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('articulo_deporte')->insert([
            ['id' => 1, 'articulo_id' => 1, 'deporte_id' => 9, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 2, 'articulo_id' => 1, 'deporte_id' => 10, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'articulo_id' => 2, 'deporte_id' => 4, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 4, 'articulo_id' => 2, 'deporte_id' => 2, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'articulo_id' => 2, 'deporte_id' => 3, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 6, 'articulo_id' => 2, 'deporte_id' => 5, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 7, 'articulo_id' => 3, 'deporte_id' => 4, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 8, 'articulo_id' => 3, 'deporte_id' => 34, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 9, 'articulo_id' => 3, 'deporte_id' => 2, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 10, 'articulo_id' => 3, 'deporte_id' => 5, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 11, 'articulo_id' => 3, 'deporte_id' => 39, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 12, 'articulo_id' => 4, 'deporte_id' => 4, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 13, 'articulo_id' => 4, 'deporte_id' => 2, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 14, 'articulo_id' => 4, 'deporte_id' => 39, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 15, 'articulo_id' => 4, 'deporte_id' => 3, 'descuento_porcentaje' => 0.00, 'created_at' => NULL, 'updated_at' => NULL],
        ]);
    }
}
