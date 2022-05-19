<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Proyectos\ProyectoActividad;
use App\Models\Proyectos\ProyectoActividadReagendamiento;
use Illuminate\Http\Request;

class ProyectoActividadReagendamientoController extends Controller
{
    public function store(ProyectoActividad $actividad, Request $request){
        $reagendamiento = new ProyectoActividadReagendamiento($request->all());
        $reagendamiento->actividad_id = $actividad->id;
        $reagendamiento->save();
        return response()->json(['status' => true, 'msg' => 'Actividad Reagendada']);
    }

    public function get(){
        return response()->json(['reagendamientos' => ProyectoActividadReagendamiento::with('actividad')->get()]);
    }

    public function index(){
        return view('proyectos.actividades.reagendamientos.index');
    }
}
