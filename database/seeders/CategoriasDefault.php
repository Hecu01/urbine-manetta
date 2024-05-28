<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasDefault extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            'categoria' => 'Articulos deportivos',
            'detalle' => 'Este seria el detalle de articulos deportivos',
        ]);
        Categoria::create([
            'categoria' => 'Ropa deportiva',
            'detalle' => 'Este seria el detalle de ropa deportiva',
        ]);
        Categoria::create([
            'categoria' => 'Suplementos y dieta',
            'detalle' => 'Este seria el detalle de suplementos y dieta',
        ]);
    }
}
