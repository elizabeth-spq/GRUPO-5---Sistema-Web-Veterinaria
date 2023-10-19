<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    /*
    public function Crear_Roles()
    {
        $roles = [
            [
                'nombre' => 'administrador',
                'modulos' => 'todos',
                'estado' => 1,
            ],
            [
                'nombre' => 'veterinario',
                'modulos' => 'modulos_veterinario',
                'estado' => 1,
            ],
            [
                'nombre' => 'recepcionista',
                'modulos' => 'modulos_recepcionista',
                'estado' => 1,
            ],
        ];

        foreach ($roles as $rol) {
            Role::create($rol);
        }

        return response()->json(['message' => 'Roles creados exitosamente']);
    }
    */
}