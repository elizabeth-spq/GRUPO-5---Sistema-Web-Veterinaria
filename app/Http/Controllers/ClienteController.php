<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $cliente = Cliente::whereIn('estado', [0, 1])->get();
        return response()->json($cliente);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->tip_doc = $request->tip_doc;
        $cliente->documento = $request->documento;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->email = $request->email;
        $cliente->estado = $request->estado;
        $cliente->usu_registro = 1;
        $cliente->usu_ult_mod = 1;

        $cliente->save();

        return response()->json($cliente);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::find($id);
        return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::find($id);
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->tip_doc = $request->tip_doc;
        $cliente->documento = $request->documento;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->email = $request->email;
        $cliente->estado = $request->estado;
        $cliente->usu_ult_mod = 1;

        if ($cliente->save()) {
            $message = "El registro ha sido actualizado";
        } else {
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
        $cliente = Cliente::find($id);
        $cliente->estado =  3;
        $cliente->save();

        $response = [
            'message' => "El registro ha sido eliminado"
        ];

        return response()->json($response);
    }
}
