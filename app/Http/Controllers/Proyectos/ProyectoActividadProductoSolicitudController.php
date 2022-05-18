<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Proyectos\ProyectoActividad;
use App\Models\Proyectos\ProyectoActividadProductoSolicitud;
use Illuminate\Http\Request;

class ProyectoActividadProductoSolicitudController extends Controller
{
    public function index(){
        return view('proyectos.actividades.solicitudes.index');
    }

    public function store(ProyectoActividad $actividad, Request $request){
        $solicitud = new ProyectoActividadProductoSolicitud($request->all());
        $solicitud->actividad_id = $actividad->id;
        $solicitud->save();
        return response()->json(['status' => true, 'msg' => 'Su solicitud a sido enviada, estara a la espera de una aprobacion']);
    }

    public function get(){
        return response()->json(['solicitudes' => ProyectoActividadProductoSolicitud::with('actividades', 'producto')->get()]);
    }

    public function updateEstado(ProyectoActividadProductoSolicitud $solicitud, $estado){
        $solicitud->estado = $estado;
        $solicitud->update();
        $solicitud->save();
        return response()->json(['status' => true, 'msg' => ($estado == 'aceptado')? 'La solicitud a sido aceptada': 'La solicitud a sido rechazada']);
    }
}
