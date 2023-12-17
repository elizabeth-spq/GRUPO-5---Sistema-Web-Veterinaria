<?php

namespace App\Http\Controllers;

use App\Models\Veterinario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

//use Illuminate\Database\QueryException;

class VeterinarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Gate::allows('administrador')) {

            $veterinario = Veterinario::whereIn('estado', [0, 1])
            ->with('especialidad')
            ->get();

            $veterinario->transform(function ($veterinario) {
                $veterinario->fec_nac = Carbon::parse($veterinario->fec_nac)->format('Y-m-d');
                return $veterinario;
            });

            return response()->json($veterinario);
        } else {
            return response()->json(['error' => 'Acceso denegado'], 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $repetido = $request->documento;
        $prev_veterinario = Veterinario::where('documento', $repetido)->first();

        if ($prev_veterinario) {
            $message = "El registro ya existe";
            $response = [
                'message' => $message
            ];
            return response()->json($response);
        } else {
            $veterinario = new Veterinario();
            $veterinario->nombre = $request->nombre;
            $veterinario->apellido = $request->apellido;
            $veterinario->fec_nac = $request->fec_nac;
            $veterinario->tip_doc = $request->tip_doc;
            $veterinario->documento = $request->documento;
            $veterinario->num_telefono = $request->num_telefono;
            $veterinario->espec_id = $request->espec_id;
            $veterinario->estado = $request->estado;
            $veterinario->horario_id = $request->horario_id;
            $veterinario->usu_registro = auth()->user()->id;

            $veterinario->save();
            return response()->json($veterinario);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $veterinario = Veterinario::find($id);

        return response()->json($veterinario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $veterinario = Veterinario::find($id);
        $veterinario->nombre = $request->nombre;
        $veterinario->apellido = $request->apellido;
        $veterinario->fec_nac = $request->fec_nac;
        $veterinario->tip_doc = $request->tip_doc;
        $veterinario->documento = $request->documento;
        $veterinario->num_telefono = $request->num_telefono;
        $veterinario->espec_id = $request->espec_id;
        $veterinario->estado = $request->estado;
        $veterinario->horario_id = $request->horario_id;
        $veterinario->usu_ult_mod = auth()->user()->id;

        if ($veterinario->save()) {
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
        $veterinario = Veterinario::find($id);
        $veterinario->estado =  3;
        $veterinario->save();

        $response = [
            'message' => "El registro ha sido eliminado"
        ];

        return response()->json($response);
    }
    public function veterinariosByEspecAndFec(int $id, string $date)
    {

        $fec_ini = $date;

        $time = strtotime($fec_ini);
        $newformat = date('H', $time);
        $hour = (int)$newformat;

        if ($hour > 8 && $hour < 13) {
            $veterinario = Veterinario::whereIn('horario_id', [0, 1])
            ->whereRaw("especialidad = '$id'")->get();
            return response()->json($veterinario);
        }else if($hour > 12 && $hour < 18){
            $veterinario = Veterinario::whereIn('horario_id', [0, 2])
                ->whereRaw(" especialidad = '$id'")->get();
            return response()->json($veterinario);
        }
        else {
            $response = [
                'message' => "No hay veterinarios disponibles"
            ];

            return response()->json($response);
        }
    }
}
