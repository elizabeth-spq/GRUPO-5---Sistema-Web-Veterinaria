<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Historia;

class HistoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Historia::create([
            'cita_id' => 1,
            'mascota_id' => 1,
            'cliente_id' => 1,
            'notas_cita' => 'Notas de la cita de prueba',
            'receta' => 'Receta de prueba',
            'procedimiento' => 'Procedimiento de prueba',
            'fecha_creacion' => now(),
            'resultados_examenes' => 'Resultados de exámenes de prueba',
            'archivos_adjuntos' => 'archivo_adjunto.pdf',
            'vacunacion' => 'Información de vacunación',
            'foto' => 'ruta_de_la_foto.jpg',
            'estado_historia' => 1,
        ]);
    }
}
