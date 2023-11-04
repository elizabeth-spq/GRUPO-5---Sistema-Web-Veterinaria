<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cita = Cita::whereIn('estado_cita', [1, 2, 3, 4])->get();

        return response()->json($cita);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $from = $request->fec_ini;
        $to = $request->fec_fin;
        $vet = $request->vet_id;

        $cita_prev = Cita::whereBetween('fec_ini', [$from, $to])
            ->orWhereBetween('fec_fin', [$from, $to])
            ->get();
        if ($cita_prev) {
            $cita_prev_vet = $cita_prev->where('vet_id', $vet)->first();
            if ($cita_prev_vet) {
                $message = "Ya existe una cita asiganada en ese horario y con el profesional indicado, escoja otro horario y/o profesional";
                $response = [
                    'message' => $message
                ];
                return response()->json($response);
            } else {
                $cita = new Cita();
                $cita->tipo_id = $request->tipo_id;
                $cita->cliente_id = $request->cliente_id;
                $cita->mascota_id = $request->mascota_id;
                $cita->espec_id = $request->espec_id;
                $cita->fec_ini = $request->fec_ini;
                $cita->fec_fin = $request->fec_fin;
                $cita->vet_id = $request->vet_id;
                $cita->observaciones = $request->observaciones;
                $cita->cargos_adicionales = $request->cargos_adicionales;
                $cita->subtotal = $request->subtotal;
                $cita->monto_adicional = $request->monto_adicional;
                $cita->total = $request->total;
                $cita->pago_previo = $request->pago_previo;
                $cita->pago_pendiente = $request->pago_pendiente;
                $cita->estado_cita = $request->estado_cita;
                $cita->usu_registro = auth()->user()->id;
                $cita->usu_ult_mod = auth()->user()->id;
                $cita->save();
                return response()->json($cita);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
