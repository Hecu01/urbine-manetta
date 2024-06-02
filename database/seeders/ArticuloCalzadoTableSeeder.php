<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticuloCalzadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('articulo_calzado')->insert([
            ['id' => 1, 'articulo_id' => 3, 'calzado_id' => 13, 'stocks' => 3, 'precio' => 34350.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 2, 'articulo_id' => 3, 'calzado_id' => 15, 'stocks' => 2, 'precio' => 34350.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'articulo_id' => 3, 'calzado_id' => 18, 'stocks' => 5, 'precio' => 34350.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 4, 'articulo_id' => 4, 'calzado_id' => 11, 'stocks' => 3, 'precio' => 45320.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'articulo_id' => 4, 'calzado_id' => 17, 'stocks' => 3, 'precio' => 45320.00, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 6, 'articulo_id' => 4, 'calzado_id' => 20, 'stocks' => 3, 'precio' => 45320.00, 'created_at' => NULL, 'updated_at' => NULL],
        ]);
    }
}
