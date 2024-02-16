<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create([
            'position' => 'No Asignada',
        ]);

        Position::create([
            'position' => 'Asignada',
        ]);

        Position::create([
            'position' => 'En Desarrollo',
        ]);

        Position::create([
            'position' => 'En Revisión',
        ]);

        Position::create([
            'position' => 'Finalizada',
        ]);

        Position::create([
            'position' => 'En Espera',
        ]);
    }
}
