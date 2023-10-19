<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Horario;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Horario::create([
            'jornada' => 'Completa',
            'turno' => 0,
            'horas' => 8,
        ]);

        Horario::create([
            'jornada' => 'Parcial/M',
            'turno' => 1,
            'horas' => 5,
        ]);

        Horario::create([
            'jornada' => 'Parcial/T',
            'turno' => 2,
            'horas' => 5,
        ]);
    }
}
