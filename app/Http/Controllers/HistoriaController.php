<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Historia;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

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
        $request->validate([
            'mascota_id' => 'required', // Asegúrate de que el campo mascota_id esté presente y sea requerido
            'cliente_id' => 'required',
            'tipo_id' => 'required',
            'foto' => 'nullable', // Puedes ajustar las reglas de validación según tus necesidades
            'archivos_adjuntos' => 'nullable|array',
            'archivos_adjuntos.*' => 'file|mimes:jpeg,png,jpg,gif|max:2048',
            'estado_historia' => 'required',
            // Agrega otras validaciones según los campos de tu formulario
        ]);

        $citaExistente = Cita::find($request->cita_id);

        if (!$citaExistente) {
            // Manejar el caso donde la cita no existe
            return response()->json(['error' => 'La cita no existe'], 404);
        }

        $historia = new Historia();
        $historia->foto = $request->has('foto') ? $request->foto : null;
        $historia->mascota_id = $request->mascota_id;
        $historia->cliente_id = $request->cliente_id;
        $historia->cita_id = $request->cita_id;
        $historia->tipo_id = $request->tipo_id;
        $historia->notas_cita = $request->has('notas_cita') ? $request->notas_cita : null;
        $historia->receta = $request->has('receta') ? $request->receta : null;
        $historia->procedimiento = $request->has('procedimiento') ? $request->procedimiento : null;
        $historia->fecha_creacion = $request->has('fecha_creacion') ? $request->fecha_creacion : null;
        $historia->resultados_examenes = $request->has('resultados_examenes') ? $request->resultados_examenes : null;
        $historia->archivos_adjuntos = null; // Establecer como null por defecto
        $historia->vacunacion = $request->has('vacunacion') ? $request->vacunacion : null;
        $historia->estado_historia = $request->estado_historia;

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
        $historia->archivos_adjuntos = $request->archivos_adjuntos;
        $historia->estado_historia = $request->estado_historia;

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
    /*public function subirFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('foto');
        $path = $file->store('fotoHistorias'); // Guarda la imagen en la carpeta "fotoHistorias"

        return response()->json(['path' => $path]);
    }*/
}
