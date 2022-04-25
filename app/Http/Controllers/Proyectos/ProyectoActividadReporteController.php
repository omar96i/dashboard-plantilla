<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Proyectos\ProyectoActividad;
use App\Models\Proyectos\ProyectoActividadReporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoActividadReporteController extends Controller
{
    public function index(){
        return view('proyectos.reportes.index');
    }

    public function store(ProyectoActividad $actividad, Request $request){

        $reporte = new ProyectoActividadReporte($request->all());
        $reporte->usuario_id = Auth::id();
        $reporte->actividad_id = $actividad->id;
        $reporte->save();
        return response()->json(['status' => true, 'msg' => 'Reporte añadido']);
    }

    public function get(){
        return response()->json(['reportes' => ProyectoActividadReporte::getDatos()]);
    }

    public function confirm(ProyectoActividadReporte $reporte){
        $reporte->estado = "arreglado";
        $reporte->update();
        return response()->json(['updated' => true]);
    }

    public function cancel(ProyectoActividadReporte $reporte){
        $reporte->estado = "baja";
        $reporte->update();
        return response()->json(['updated' => true]);
    }


}
