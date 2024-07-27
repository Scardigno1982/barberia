<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Cliente;
use App\Models\Barber;
use App\Models\Corte;
use App\Models\Gasto;
use App\Models\Tipo;
use App\Models\User;

use Carbon\Carbon;



class SummariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Obteniendo el año, mes y día desde el request, usando el día actual como predeterminado
        $anioSeleccionado = $request->input('anio', Carbon::now()->year);
        $mesSeleccionado = $request->input('mes', Carbon::now()->month);
        $diaSeleccionado = $request->input('dia', Carbon::now()->day);
    
        // Creando un objeto Carbon con el año, mes y día seleccionados
        $fechaSeleccionada = Carbon::createFromDate($anioSeleccionado, $mesSeleccionado, $diaSeleccionado);
    
        // Ingresos del día seleccionado
        $ingresosDelDia = Corte::whereDate('fecha', $fechaSeleccionada)
            ->whereIn('barbers_id', [1])
            ->join('barbers', 'barbers_id', '=', 'barbers.id')
            ->get();
        $totalIngresosDelDia = $ingresosDelDia->sum('monto');
    
        // Ingresos del mes seleccionado
        $total_corte_month = Corte::whereYear('fecha', '=', $fechaSeleccionada->year)
            ->whereMonth('fecha', '=', $fechaSeleccionada->month)
            ->whereIn('barbers_id', [1])
            ->join('barbers', 'barbers_id', '=', 'barbers.id')
            ->get();
        $totalIngresosMes = $total_corte_month->sum('monto');
    
        // Gastos del mes seleccionado
        $gastosMes = Gasto::whereYear('created_at', '=', $fechaSeleccionada->year)
            ->whereMonth('created_at', '=', $fechaSeleccionada->month)
            ->get();
        $totalGastos = $gastosMes->sum('monto');
    
        // Devuelve la vista con los datos filtrados por el año, mes y día seleccionados
        return view('summaries.index', compact('total_corte_month', 'gastosMes', 'ingresosDelDia', 'totalIngresosDelDia', 'totalIngresosMes', 'totalGastos'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}