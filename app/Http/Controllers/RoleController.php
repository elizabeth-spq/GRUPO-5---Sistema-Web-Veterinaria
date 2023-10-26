<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        if (Gate::allows('administrador')){

            $role = Role::with('permissions')->get();

            return response()->json($role);

        } else {
            return response()->json(['error' => 'Acceso denegado'], 403);
        }
    }

    public function store(Request $request)
    {
        /*$request->validate([
            'name' => 'required|string|max:255',
            'modulos' => 'required|string|max:250',
        ]);*/

        $role = new Role();
        $role->nombre = $request->nombre;

        $role->save();

        return response()->json($role);
    }

    public function show(string $id)
    {
        $role = Role::find($id);

        return response()->json($role);
    }


    public function update(Request $request, string $id)
    {

        $role = Role::find($id);

        if (!$role) {

            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        /*$request->validate([
            'nombre' => 'required|string|max:255',
            'modulos' => 'required|string|max:250',
        ]);*/

        $role->nombre = $request->name;

        if ($role->save()) {
            $message = "El registro ha sido actualizado";
        } else {
            $message = "El registro no ha sido actualizado";
        }

        $response = [
            'message' => $message
        ];

        return response()->json($response);
    }


    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->estado =  3;
        $role->save();

        $response = [
            'message' => "El registro ha sido eliminado"
        ];

        return response()->json($response);
    }
}
