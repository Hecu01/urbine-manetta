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
        $this->call(CategoriasDefault::class);
        $this->call(AdminDefault::class);
        $this->call(CalzadosDefault::class);
        $this->call(DeportesDefault::class);
        // $this->call(TalleSeeder::class);
    }
}
