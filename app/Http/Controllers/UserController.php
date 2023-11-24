<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        if (Gate::allows('administrador')){

            $user = User::whereIn('estado',[0,1])->get();

            return response()->json($user);

        } else {
            return response()->json(['error' => 'Acceso denegado'], 403);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:250',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'rol_id' => 'required|integer',
            'usu_registro' => 'integer',
            'usu_ult_mod' => 'integer',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->rol_id = $request->rol_id;
        $user->usu_registro = auth()->user()->id;


        $user->save();

        return response()->json($user);
    }

    public function show(string $id)
    {
        $user = User::find($id);

        return response()->json($user);
    }


    public function update(Request $request, string $id)
    {

        $user = User::find($id);

        if (!$user) {

            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:250',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'rol_id' => 'required|integer',
            'usu_registro' => 'integer',
            'usu_ult_mod' => 'integer',
            'motivoDesactivacion' => 'nullable  |string|max:255',
        ]);

        $user->name = $request->name;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->rol_id = $request->rol_id;
        $user->usu_ult_mod = auth()->user()->id;
        $user->isDeactivated = $request->isDeactivated;
        $user->motivoDesactivacion = $request->motivoDesactivacion;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {
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
        $user = User::find($id);
        $user->estado =  2;
        $user->save();

        $response = [
            'message' => "El registro ha sido eliminado"
        ];

        return response()->json($response);
    }
}
