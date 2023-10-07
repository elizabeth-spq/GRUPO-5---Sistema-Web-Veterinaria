<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->save();

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = user::find($id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;

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

    /**
     * Remove the specified resource from storage.
     */
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
