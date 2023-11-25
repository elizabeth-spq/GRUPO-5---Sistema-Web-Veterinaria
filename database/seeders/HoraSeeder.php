<?php

namespace Database\Seeders;

use App\Models\Hora;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hora::create([
            'hora_ini' => '8:00',
            'hora_fin' => '8:30',
        ]);
        Hora::create([
            'hora_ini' => '8:30',
            'hora_fin' => '9:00',
        ]);
        Hora::create([
            'hora_ini' => '9:00',
            'hora_fin' => '9:30',
        ]);
        Hora::create([
            'hora_ini' => '9:30',
            'hora_fin' => '10:00',
        ]);
        Hora::create([
            'hora_ini' => '10:00',
            'hora_fin' => '10:30',
        ]);
        Hora::create([
            'hora_ini' => '10:30',
            'hora_fin' => '11:00',
        ]);
        Hora::create([
            'hora_ini' => '11:00',
            'hora_fin' => '11:30',
        ]);
        Hora::create([
            'hora_ini' => '11:30',
            'hora_fin' => '12:00',
        ]);
        Hora::create([
            'hora_ini' => '12:00',
            'hora_fin' => '12:30',
        ]);
        Hora::create([
            'hora_ini' => '12:30',
            'hora_fin' => '13:00',
        ]);
        Hora::create([
            'hora_ini' => '14:00',
            'hora_fin' => '14:30',
        ]);
        Hora::create([
            'hora_ini' => '14:30',
            'hora_fin' => '15:00',
        ]);
        Hora::create([
            'hora_ini' => '15:00',
            'hora_fin' => '15:30',
        ]);
        Hora::create([
            'hora_ini' => '15:30',
            'hora_fin' => '16:00',
        ]);
        Hora::create([
            'hora_ini' => '16:00',
            'hora_fin' => '16:30',
        ]);
        Hora::create([
            'hora_ini' => '16:30',
            'hora_fin' => '17:00',
        ]);
    }
}
