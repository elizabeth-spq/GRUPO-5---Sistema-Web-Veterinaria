<?php

namespace Database\Seeders;

//use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//use Spatie\Permission\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        $administrador = Role::create(['name' => 'administrador', 'descripcion' => 'Es el usuario administrador del sistema.']);
        $veterinario = Role::create(['name' => 'veterinario', 'descripcion' => 'El usuario solo tiene acceso a los modulos de usuarios, veterinaria y cliente.']);
        $recepcionista = Role::create(['name' => 'recepcionista', 'descripcion' => 'El usuario solo tiene acceso al modulo cliente.']);

        Permission::create(['name' => 'roles'])->syncnRole([$administrador]);
        Permission::create(['name' => 'users'])->syncnRole([$administrador, $veterinario]);
        Permission::create(['name' => 'veterinario'])->syncnRole([$administrador, $veterinario, $recepcionista]);
        */
    }
}
