<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipocita;

class TipocitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tipocita::create([
            'nombre' => 'Cita de control',
            'tiempo' => 0.5,
            'precio' => 30.00,
        ]);
        Tipocita::create([
            'nombre' => 'Cita preoperatoria',
            'tiempo' => 0.34,
            'precio' => 25.00,
        ]);
        Tipocita::create([
            'nombre' => 'Cita de seguimiento',
            'tiempo' => 0.25,
            'precio' => 10.00,
        ]);
        Tipocita::create([
            'nombre' => 'Cita por dolencia',
            'tiempo' => 0.5,
            'precio' => 40.00,
        ]);
        Tipocita::create([
            'nombre' => 'Cita de urgencia',
            'tiempo' => 1,
            'precio' => 60.00,
        ]);
    }
}
