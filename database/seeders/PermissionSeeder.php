<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['nombre' => 'Crear usuario', 'slug' => 'crear-usuario']);
        Permission::create(['nombre' => 'Editar usuario', 'slug' => 'editar-usuario']);
        Permission::create(['nombre' => 'Eliminar usuario', 'slug' => 'eliminar-usuario']);

        Permission::create(['nombre' => 'Crear veterinario', 'slug' => 'crear-veterinario']);
        Permission::create(['nombre' => 'Editar veterinario', 'slug' => 'editar-veterinario']);
        Permission::create(['nombre' => 'Eliminar veterinario', 'slug' => 'eliminar-veterinario']);

        Permission::create(['nombre' => 'Crear cliente', 'slug' => 'crear-cliente']);
        Permission::create(['nombre' => 'Editar cliente', 'slug' => 'editar-cliente']);
        Permission::create(['nombre' => 'Eliminar cliente', 'slug' => 'eliminar-cliente']);

        Permission::create(['nombre' => 'Crear mascota', 'slug' => 'crear-mascota']);
        Permission::create(['nombre' => 'Editar mascota', 'slug' => 'editar-mascota']);
        Permission::create(['nombre' => 'Eliminar mascota', 'slug' => 'eliminar-mascota']);

    }
}
