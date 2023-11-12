<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permission as ModelsPermission;
use App\Models\Role as ModelsRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(EspecialidadSeeder::class);
        $this->call(TipocitaSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(HorarioSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(VeterinarioSeeder::class);
        $this->call(AnimalSeeder::class);
        $this->call(RazaSeeder::class);
        $this->call(MascotaSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(CitaSeeder::class);
    }
}
