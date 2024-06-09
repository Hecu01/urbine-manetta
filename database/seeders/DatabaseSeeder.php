<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CategoriasDefault::class,
            AdminDefault::class,
            CalzadosDefault::class,
            DeportesDefault::class,
            TalleSeeder::class,

            // Productos de prueba por defectos
            ArticulosTableSeeder::class,
            ArticuloCalzadoTableSeeder::class,
            ArticuloDeporteTableSeeder::class,
        ]);


        // $this->call(TalleSeeder::class);
    }
}
