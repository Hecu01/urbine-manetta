<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;;

class AdminDefault extends Seeder
{
    /**
     * Run the database seeds.
    */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('20406080'),
            'administrator' => true
        ]);

    }
}
