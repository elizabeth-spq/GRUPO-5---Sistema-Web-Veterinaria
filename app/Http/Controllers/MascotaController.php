<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Cliente;
use App\Models\Mascota;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$mascota = Mascota::whereIn('estado',[0,1])->get()->animal();
        $mascotas = Mascota::with('cliente')->whereIn('estado',[0,1])->get();
        //$mascota = Mascota::find(3)->animal()->first();;

        return response()->json($mascotas);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mascota = new Mascota();
        $mascota->nombre=$request->nombre;
        $mascota->cliente_id=$request->cliente_id;
        $mascota->animal_id = $request->animal_id;
        $mascota->raza_id = $request->raza_id;
        $mascota->fec_nac = $request->fec_nac;
        $mascota->sexo = $request->sexo;
        $mascota->color = $request->color;
        $mascota->altura = $request->altura;
        $mascota->peso = $request->peso;
        $mascota->estirilizado = $request->estirilizado;
        $mascota->vacunas = $request->vacunas;
        $mascota->estado = $request->estado;
        $mascota->usu_registro = 1;
        $mascota->usu_ult_mod = 1;

        $mascota->save();

        return response()->json( $mascota);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mascota = Mascota::with('animal')->find($id);

        return response()->json($mascota);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mascota = Mascota::find($id);
        $mascota->nombre=$request->nombre;
        $mascota->cliente_id=$request->cliente_id;
        $mascota->animal_id = $request->animal_id;
        $mascota->raza_id = $request->raza_id;
        $mascota->fec_nac = $request->fec_nac;
        $mascota->sexo = $request->sexo;
        $mascota->color = $request->color;
        $mascota->altura = $request->altura;
        $mascota->peso = $request->peso;
        $mascota->estirilizado = $request->estirilizado;
        $mascota->vacunas = $request->vacunas;
        $mascota->estado = $request->estado;
        $mascota->usu_ult_mod = 1;

        if( $mascota->save()){
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
        $mascota = Mascota::find($id);
        $mascota->estado =  3;
        $mascota->save();

        $response = [
            'message' => "El registro ha sido eliminado"
        ];

        return response()->json($response);
    }
    public function mascotasByCliente(int $id)
    {
        $mascotas = Mascota::whereIn('cliente_id',[$id])->get();
        return response()->json($mascotas);
    }
}
