<?php

namespace Database\Seeders;

use App\Models\Calzado;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CalzadosDefault extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Declaramos el numero base
        $numero = 27;
        
        // Iteramos y agregamos los 20 calzados disponible
        for ($i = 0; $i <= 19; $i++ ){
            Calzado::create([
                'nombre' => 'calzado n°',
                'calzado' => $numero,
            ]);
            $numero = $numero + 1;
        }
    }
}
