<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{

    public function index()
    {
        $roles = Rol::all();
        return response()->json($roles);
    }

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
    }
}
