<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Historia;
use Illuminate\Http\Request;

class HistoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $historias = Historia::with('mascota')->whereIn('estado_historia', [0, 1])->get();
        return response()->json($historias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $historia = new Historia();
        $historia->mascota_id = $request->mascota_id;
        $historia->foto = $request->foto;
        $historia->documentos = $request->documentos;
        $historia->estado_historia = $request->estado;

        $historia->save();

        return response()->json($historia);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $historia = Historia::with('mascota')->find($id);

        return response()->json($historia);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $historia = Historia::find($id);
        $historia->foto = $request->foto;
        $historia->documentos = $request->documentos;
        $historia->estado_historia = $request->estado;

        if ($historia->save()) {
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
        $historia = Historia::find($id);
        $historia->estado_historia =  3;
        $historia->save();

        $response = [
            'message' => "El registro ha sido eliminado"
        ];

        return response()->json($response);
    }
    public function subirFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('foto');
        $path = $file->store('fotoHistorias'); // Guarda la imagen en la carpeta "fotoHistorias"

        return response()->json(['path' => $path]);
    }
}
