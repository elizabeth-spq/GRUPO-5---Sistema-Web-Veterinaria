<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create([
            'nombre' => 'Paul',
            'apellido' => 'Sanchez Rojas',
            'tip_doc' => 1,
            'documento' => 48521574,
            'telefono' => 963258523,
            'direccion' => 'Jr. Los Andes 475. Surquillo',
            'email' => 'psanchez@gmail.com',
        ]);

        Cliente::create([
            'nombre' => 'Martha',
            'apellido' => 'Bobadilla Gutierrez',
            'tip_doc' => 2,
            'documento' => 75412452,
            'telefono' => 987456258,
            'direccion' => 'Av.Mariscal Castilla Mz 12. Lince',
            'email' => 'mbobadilla@gmail.com',
        ]);
    }
}
