<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Talle;

class TalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        // TALLES VARONES Y MUJERES
        $talles = ['XS','S','M','L','XL','XXL', 'XXXL'];
        $qTalles = count($talles);

        // MEDIDAS MUJERES
        $largo_mujer = ['57','58','59','60','63','65', '66'];
        $ancho_mujer = ['39','41','43','45','48','50', '53'];

        // MEDIDAS MUJERES
        $largo_hombre = ['67','70','73','77','79','82', '84'];
        $ancho_hombre = ['47','50','53','55','57','63', '66'];
        
        // CREAMOS TALLES MUJERES
        for($i = 0; $i < $qTalles; $i++){
            Talle::create([
                'talle_ropa' => $talles[$i] ,
                'largo_cm' => $largo_mujer[$i],
                'ancho_cm' => $ancho_mujer[$i],
                'genero' => 'femenino',
            ]); 
        }

        // CREAMOS TALLES VARONES
        for($i = 0; $i < $qTalles; $i++){
            Talle::create([
                'talle_ropa' => $talles[$i] ,
                'largo_cm' => $largo_hombre[$i],
                'ancho_cm' => $ancho_hombre[$i],
                'genero' => 'masculino',
            ]); 
        }
    }
}
