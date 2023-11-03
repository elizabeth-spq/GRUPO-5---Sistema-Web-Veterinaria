<?php

namespace Database\Seeders;

use App\Models\Cita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cita::create([
            'tipo_id' => 1,
            'cliente_id' => 1,
            'mascota_id' => 1,
            'espec_id' => 1,
            'fec_ini' => "2023-11-03 9:00:00",
            'fec_fin' => "2023-11-03 9:30:00",
            'vet_id' => 1,
            'observaciones' => null,
            'cargos_adicionales' =>null,
            'subtotal' => 30.00,
            'monto_adicional' => 0.00,
            'total' => 30.00,
            'pago_previo' => 0.00,
            'pago_pendiente' => 30.00,
            'estado_cita' => 1,

        ]);
    }
}
