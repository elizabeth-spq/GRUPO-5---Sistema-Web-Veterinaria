<?php

namespace App\Http\Controllers;
use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        $horario = Horario::all();
        return response()->json($horario);
    }
    public function store(Request $request)
    {
        $horario = new Horario();
        $horario->jornada=$request->jornada;
        $horario->turno=$request->turno;
        $horario->horas = $request->horas;

        $horario->save();
    }

}
