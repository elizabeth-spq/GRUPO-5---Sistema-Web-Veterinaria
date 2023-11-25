<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Veterinario;

class VeterinarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Veterinario::create([
            'nombre' => 'Jose Emilio',
            'apellido' => 'Martinez de la Vega',
            'fec_nac' => '1985-01-15',
            'tip_doc' => 1,
            'documento' => 74785412,
            'num_telefono' => 902548536,
            'espec_id' => 1,
            'horario_id' => 1,
        ]);

        Veterinario::create([
            'nombre' => ' Maria Luisa',
            'apellido' => 'Medina Prado',
            'fec_nac' => '1988-07-30',
            'tip_doc' => 1,
            'documento' => 74145201,
            'num_telefono' => 999547525,
            'espec_id' => 1,
            'horario_id' => 1,
        ]);
    }
}
