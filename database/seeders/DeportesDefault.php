<?php

namespace Database\Seeders;
use App\Models\Deporte;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeportesDefault extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deportes = [
            ['deporte' => 'Polo', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Fútbol', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Fútbol 11', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Baby futbol', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Futbol sala (futsal)', 'categoria_deporte' => 'Deportes de gimnasio'],
            ['deporte' => 'Rugby', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Rugby 11', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Rugby 7', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Voleyball', 'categoria_deporte' => 'Deportes cerrados'],
            ['deporte' => 'Voleyball playa', 'categoria_deporte' => 'Deportes cerrados'],
            ['deporte' => 'Handball', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Hockey sobre césped', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Hockey sobre hielo', 'categoria_deporte' => 'Deportes cerrados'],
            ['deporte' => 'Ultimate Frisbee', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Críquet', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Tenis', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Badminton', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Golf', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Béisbol', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Softbol', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Fútbol Américano', 'categoria_deporte' => 'Deportes de campo'],
            ['deporte' => 'Básquetball', 'categoria_deporte' => 'Deportes de gimnasio'],
            ['deporte' => 'Esgrima', 'categoria_deporte' => 'Deportes de gimnasio'],
            ['deporte' => 'Running', 'categoria_deporte' => 'Running'],
            ['deporte' => 'Trail running', 'categoria_deporte' => 'Running'],
            ['deporte' => 'Ping Pon', 'categoria_deporte' => 'Deportes cerrados'],
            ['deporte' => 'Natación', 'categoria_deporte' => 'Deportes cerrados'],
            ['deporte' => 'Patinaje', 'categoria_deporte' => 'Deportes cerrados'],
            ['deporte' => 'Waterpolo', 'categoria_deporte' => 'Deportes cerrados'],
            ['deporte' => 'Patinaje Artístico', 'categoria_deporte' => 'Deportes cerrados'],
            ['deporte' => 'Patinaje sobre hielo', 'categoria_deporte' => 'Deportes cerrados'],
            ['deporte' => 'Atletismo', 'categoria_deporte' => 'Deportes cerrados'],
            ['deporte' => 'Ciclismo', 'categoria_deporte' => 'Deportes de calle'],
            ['deporte' => 'BXM', 'categoria_deporte' => 'Deportes de calle'],
            ['deporte' => 'Surfing', 'categoria_deporte' => 'Otros'],
            ['deporte' => 'Esquí y Snowboard', 'categoria_deporte' => 'Otros'],
            
            // Artes marciales
            ['deporte' => 'Boxeo', 'categoria_deporte' => 'Artes marciales'],
            ['deporte' => 'Hapkido', 'categoria_deporte' => 'Artes marciales'],
            ['deporte' => 'Taekwondo', 'categoria_deporte' => 'Artes marciales'],
            ['deporte' => 'Karate', 'categoria_deporte' => 'Artes marciales'],
            ['deporte' => 'MMA', 'categoria_deporte' => 'Artes marciales'],
     


        ];

        // Insertar los registros en la tabla 'deportes'
        DB::table('deportes')->insert($deportes);
    }
}
