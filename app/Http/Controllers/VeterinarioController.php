<?php

namespace App\Http\Controllers;

use App\Models\Veterinario;
use Illuminate\Http\Request;

class VeterinarioController extends Controller
{
    public function index()
    {
        $veterinario = Veterinario::all();
        return response()->json($veterinario);
    }
    public function store(Request $request)
    {
        $veterinario = new Veterinario();
        $veterinario->nombre=$request->nombre;
        $veterinario->apellido=$request->apellido;
        $veterinario->fec_nac = $request->fec_nac;
        $veterinario->tip_doc = $request->tip_doc;
        $veterinario->documento = $request->documento;
        $veterinario->num_telefono = $request->num_telefono;
        $veterinario->especialidad = $request->especialidad;
        $veterinario->estado = $request->estado;
        $veterinario->horario_id = $request->horario_id;
        $veterinario->usu_registro = $request->usu_registro;
        $veterinario->usu_ult_mod = $request->usu_ult_mod;

        $veterinario->save();
    }
    public function update(Request $request, $id)
    {
        $veterinario = Veterinario::find($id);
        $veterinario->nombre=$request->nombre;
        $veterinario->apellido=$request->apellido;
        $veterinario->fec_nac = $request->fec_nac;
        $veterinario->tip_doc = $request->tip_doc;
        $veterinario->documento = $request->documento;
        $veterinario->num_telefono = $request->num_telefono;
        $veterinario->especialidad = $request->especialidad;
        $veterinario->estado = $request->estado;
        $veterinario->horario_id = $request->horario_id;

        $veterinario->save();
    }
}
