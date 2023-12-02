<?php

namespace App\Http\Controllers;

use App\Models\Hora;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class HoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horas = Hora::all();
        return response()->json($horas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getdate(Request $request)
    {
        $now = Carbon::now()->setTimezone('America/Lima');
        $date = Carbon::now()->setTimezone('America/Lima');

        if($request->start_date && $request->end_date){
            $weekStartDate = Carbon::parse($request->start_date)->copy();
            $weekEndDate = Carbon::parse($request->end_date)->copy();
        }else{
            $weekStartDate = $date->copy()->startOfWeek();
            $weekEndDate = $date->copy()->endOfWeek()->subDays(2);
        }

        $nextStartDate = $weekStartDate->copy()->addDays(7);
        $nextEndDate = $weekEndDate->copy()->addDays(7);

        $lastStartDate = $weekStartDate->copy()->subDays(7);
        $lastEndDate = $weekEndDate->copy()->subDays(7);

        $dateRange = CarbonPeriod::create($weekStartDate, $weekEndDate);
        foreach ($dateRange as $date){
            $fechitas[] = $date->format('Y-m-d');
        }

        $dias = ["Lunes","Martes","Miercoles","Jueves","Viernes"];
        $data = [
            "dias"=>$dias,
            "fechas"=>$fechitas,
            "hoy"=>$now->format('Y-m-d'),
            "weekStartDate"=>$weekStartDate->format('Y-m-d'),
            "weekEndDate"=>$weekEndDate->format('Y-m-d'),
            "nextStartDate"=>  $nextStartDate->format('Y-m-d'),
            "nextEndDate"=>  $nextEndDate->format('Y-m-d'),
            "lastStartDate"=>  $lastStartDate->format('Y-m-d'),
            "lastEndDate"=>  $lastEndDate->format('Y-m-d'),
            ];
        return response()->json($data);
    }
}
