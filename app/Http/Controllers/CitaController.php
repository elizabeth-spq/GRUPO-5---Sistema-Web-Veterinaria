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
        $cita = Cita::whereIn('estado_cita', [1, 2, 3, 4])
        ->with('cliente')
        ->with('mascota')
        ->with('especialidad')
        ->with('tipo')
        ->with('veterinario')
        ->get();

        return response()->json($cita);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $from = $request->fec_ini;
        $to = $request->fec_fin;
        $vet_id = $request->vet_id;

        if ($from != null && $to != null && $vet_id != null) {
            $prev_cita = Cita::whereIn('estado_cita', [1, 2])->where('vet_id', $vet_id)
                ->whereRaw("(
                            (fec_ini BETWEEN '$from' AND '$to')
                            OR
                            (fec_fin BETWEEN '$from' AND '$to')
                        ) ")
                ->first();

            if ($prev_cita) {
                $message = "Ya existe una cita asignada en ese horario y con el profesional indicado, escoja otro horario y/o profesional";
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
                //$cita->usu_registro = auth()->user()->id;
                //$cita->usu_ult_mod = auth()->user()->id;
                $cita->save();
                return response()->json($cita);
            }
        } else {
            $message = "Debe ingresar la fecha de inicio, fecha de fin y en veterinario";
            $response = [
                'message' => $message
            ];
            return response()->json($response, 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cita = Cita::find($id);
        $cita->cargos_adicionales =$request->cargos_adicionales;
        $cita->subtotal =$request->subtotal;
        $cita->monto_adicional =$request->monto_adicional;
        $cita->total =$request->total;
        $cita->pago_previo =$request->pago_previo;
        $cita->pago_pendiente =$request->pago_pendiente;

        if ($cita->save()) {
            $message = "El registro ha sido actualizado";
        } else {
            $message = "El registro no ha sido actualizado";
        }

        $response = [
            'message' => $message
        ];

        return response()->json($response);
    }
    public function status(Request $request, string $id)
    {
        $estado_cita = $request->estado_cita;

        $cita = Cita::find($id);
        $cita->estado_cita = $estado_cita;
        $cita->observaciones = $request->observaciones;
        $cita->save();
        if($estado_cita == 1){
            $response = [
                'message' => "El registro cambió su estado a Confirmada"
            ];
        }else if($estado_cita == 2){
            $response = [
                'message' => "El registro cambió su estado a En Atención"
            ];
        }else if($estado_cita == 3){
            $response = [
                'message' => "El registro cambió su estado a Atendida"
            ];
        }else{
            $response = [
                'message' => "El registro cambió su estado a Cancelada"
            ];
        }


        return response()->json($response);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
