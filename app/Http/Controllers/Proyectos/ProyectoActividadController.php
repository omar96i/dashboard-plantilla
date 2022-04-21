<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Proyectos\ProyectoActividad;
use App\Models\Proyectos\ProyectoActividadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoActividadController extends Controller
{
    public function index(){
        return view('proyectos.actividades.index');
    }

    public function form(ProyectoActividad $actividad = null){
        if(is_null($actividad)){
            return view('proyectos.actividades.form');
        }else{
            return view('proyectos.actividades.form', ['actividad' => $actividad]);
        }

    }

    public function store(Request $request){
        $actividad = new ProyectoActividad($request->all());
        $actividad->usuario_id = Auth::id();
        $actividad->save();
        return response()->json(['actividad' => $actividad, 'insert' => true]);
    }

    public function update(ProyectoActividad $actividad, Request $request){
        $actividad->update($request->all());
        $actividad->save();
        return response()->json(['actividad' => $actividad, 'updated' => true]);
    }

    public function storeFiles(Request $request){
        $result = $request->file->storeOnCloudinary('actividades');
        $imageName = $result->getPublicId();
        $file = new ProyectoActividadFile([
            'proyecto_actividad_id' => $request->proyecto_actividad_id,
            'file' => $imageName,
            'tipo' => $request->tipo
        ]);
        $file->save();
        return response()->json(['status' => true, 'file' => $file]);
    }

    public function getFiles(ProyectoActividad $actividad){
        return response()->json(['files' => $actividad->load('files')]);
    }

    public function deleteFiles(ProyectoActividadFile $file){
        $file->delete();
        return response()->json(['deleted' => true]);
    }

    public function get(){
        return response()->json(['actividades' => ProyectoActividad::with('proyecto', 'empleado.informacionPersonal')->get()]);
    }
}
