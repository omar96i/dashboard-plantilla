<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Proyectos\ProyectoActividad;
use App\Models\Proyectos\ProyectoActividadAsistencia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoActividadAsistenciaController extends Controller
{
    public function index(){
        return view('proyectos.actividades.asistencias.index');
    }

    public function store(ProyectoActividad $actividad, Request $request){
        if(ProyectoActividadAsistencia::verificar($actividad->id, Carbon::now()->format('Y-m-d')) == 0){
            $asistencia = new ProyectoActividadAsistencia($request->all());
            $asistencia->fecha = Carbon::now()->format('Y-m-d');
            $asistencia->time = Carbon::now()->format('H:i:s');
            $asistencia->actividad_id = $actividad->id;
            $asistencia->user_id = Auth::id();
            $asistencia->save();
            return response()->json(['status' => true, 'msg' => 'Asistencia registrada', 'asistencia' => $asistencia]);
        }else{
            return response()->json(['status' => false, 'msg' => 'El dia de hoy ya registrastes la asistencia']);
        }
    }

    public function get(){
        return response()->json(['asistencias' => ProyectoActividadAsistencia::with('tecnico.informacionPersonal', 'actividad.proyecto')->get()]);
    }

}
