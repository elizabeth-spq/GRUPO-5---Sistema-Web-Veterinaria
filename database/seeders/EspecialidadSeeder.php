<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Especialidad::create([
            'nombre' => 'Medicina Interna',
        ]);
        Especialidad::create([
            'nombre' => 'Cirugía',
        ]);
        Especialidad::create([
            'nombre' => 'Fisioterapia',
        ]);
        Especialidad::create([
            'nombre' => 'Anestesiología',
        ]);
        Especialidad::create([
            'nombre' => 'Cardiología',
        ]);
        Especialidad::create([
            'nombre' => 'Dermatología',
        ]);
        Especialidad::create([
            'nombre' => 'Neurología',
        ]);
        Especialidad::create([
            'nombre' => 'Oftalmología',
        ]);
        Especialidad::create([
            'nombre' => 'Oncología',
        ]);
        Especialidad::create([
            'nombre' => 'Medicina de Fauna silvestre',
        ]);
        Especialidad::create([
            'nombre' => 'Radiología',
        ]);
        Especialidad::create([
            'nombre' => 'Ultrasonografía',
        ]);
        Especialidad::create([
            'nombre' => 'Radiología',
        ]);

    }
}
