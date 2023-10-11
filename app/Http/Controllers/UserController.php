<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $user = User::whereIn('estado',[0,1])->get();
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name=$request->name;
        $user->apellido=$request->apellido;
        $user->email = $request->email;
        $user->rol_id = $request->rol_id;
        $user->usu_registro = $request->usu_registro;
        $user->usu_ult_mod = $request->usu_ult_mod;

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
        $user->name=$request->name;
        $user->apellido=$request->apellido;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->password = $request->password;
        $user->rol_id = $request->rol_id;
        $user->usu_registro = $request->usu_registro;
        $user->usu_ult_mod = $request->usu_ult_mod;

        if( $user->save()){
            $message = "El registro ha sido actualizado";
        }else {
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
        $user->estado =  3;
        $user->save();

        $response = [
            'message' => "El registro ha sido eliminado"
        ];

        return response()->json($response);
    }


}
