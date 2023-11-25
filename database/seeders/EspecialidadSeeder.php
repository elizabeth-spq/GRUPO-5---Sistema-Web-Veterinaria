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
            'codigo' => 'MI',
            'nombre' => 'Medicina Interna',
        ]);
        Especialidad::create([
            'codigo' => 'CIR',
            'nombre' => 'Cirugía',
        ]);
        Especialidad::create([
            'codigo' => 'FIS',
            'nombre' => 'Fisioterapia',
        ]);
        Especialidad::create([
            'codigo' => 'ANE',
            'nombre' => 'Anestesiología',
        ]);
        Especialidad::create([
            'codigo' => 'CAR',
            'nombre' => 'Cardiología',
        ]);
        Especialidad::create([
            'codigo' => 'DER',
            'nombre' => 'Dermatología',
        ]);
        Especialidad::create([
            'codigo' => 'NEU',
            'nombre' => 'Neurología',
        ]);
        Especialidad::create([
            'codigo' => 'OFT',
            'nombre' => 'Oftalmología',
        ]);
        Especialidad::create([
            'codigo' => 'OCL',
            'nombre' => 'Oncología',
        ]);
        Especialidad::create([
            'codigo' => 'MFS',
            'nombre' => 'Medicina de Fauna silvestre',
        ]);
        Especialidad::create([
            'codigo' => 'RAD',
            'nombre' => 'Radiología',
        ]);
        Especialidad::create([
            'codigo' => 'UTR',
            'nombre' => 'Ultrasonografía',
        ]);
    }
}
