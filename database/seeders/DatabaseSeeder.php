<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Position;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class); //Llamada a seeder que inserta un usuario de prueba
        $this->call(PositionSeeder::class); //Llamada a seeder que inserta posiciones (estados de tareas) de prueba
    }
}
