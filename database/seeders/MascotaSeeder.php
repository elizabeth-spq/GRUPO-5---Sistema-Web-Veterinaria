<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mascota;

class MascotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mascota::create([
            'nombre' => 'Bobby',
            'cliente_id' => 1,
            'animal_id' => 2,
            'raza_id' => 7,
            'fec_nac' => '2015-09-17',
            'sexo' => 0,
            'color' => 'naranja',
            'altura' => 65,
            'peso' => 8.2,
            'estirilizado' => 1,
            'vacunas' => 1,
        ]);

        Mascota::create([
            'nombre' => 'Abby',
            'cliente_id' => 2,
            'animal_id' => 2,
            'raza_id' => 13,
            'fec_nac' => '2021-11-21',
            'sexo' => 1,
            'color' => 'blanco',
            'altura' => 35,
            'peso' => 0.8,
            'estirilizado' => 1,
            'vacunas' => 1,
        ]);
    }
}
