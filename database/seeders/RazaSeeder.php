<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Raza;

class RazaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Raza::create([
            'nombre' => 'Mestizo',
            'animal_id' => 2,
        ]);

        Raza::create([
            'nombre' => 'Viringo',
            'animal_id' => 2,
        ]);   
        
        Raza::create([
            'nombre' => 'Labrador retriever',
            'animal_id' => 2,
        ]);

        Raza::create([
            'nombre' => 'Pastor alemán',
            'animal_id' => 2,
        ]);

        Raza::create([
            'nombre' => 'Yorkshire terrier',
            'animal_id' => 2,
        ]);

        Raza::create([
            'nombre' => 'Beagle',
            'animal_id' => 2,
        ]);

        Raza::create([
            'nombre' => 'Golder retriever',
            'animal_id' => 2,
        ]);

        Raza::create([
            'nombre' => 'Bulldog',
            'animal_id' => 2,
        ]);

        Raza::create([
            'nombre' => 'Boxer',
            'animal_id' => 2,
        ]);

        Raza::create([
            'nombre' => 'Poodle',
            'animal_id' => 2,
        ]);

        Raza::create([
            'nombre' => 'Shih tzu',
            'animal_id' => 2,
        ]);

        Raza::create([
            'nombre' => 'Chow chow',
            'animal_id' => 2,
        ]);

        Raza::create([
            'nombre' => 'Pekines',
            'animal_id' => 2,
        ]);

        Raza::create([
            'nombre' => 'Mestizo',
            'animal_id' => 1,
        ]);
    }
}
