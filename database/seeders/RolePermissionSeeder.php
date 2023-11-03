<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $administrador = Role::where('nombre', 'administrador')->first();
        $veterinario = Role::where('nombre', 'veterinario')->first();
        $recepcionista = Role::where('nombre', 'recepcionista')->first();

        $allPermissions = Permission::all();

        $administrador->permissions()->sync($allPermissions->pluck('id'));

        $veterinario->permissions()->sync($allPermissions->whereIn('slug', [
            'crear-cliente',
            'editar-cliente',
            'crear-mascota',
            'editar-mascota',
        ])->pluck('id'));

        $recepcionista->permissions()->sync($allPermissions->whereIn('slug', [
            'crear-cliente',
            'editar-cliente',
            'crear-mascota',
            'editar-mascota',
        ])->pluck('id'));
    }
}
