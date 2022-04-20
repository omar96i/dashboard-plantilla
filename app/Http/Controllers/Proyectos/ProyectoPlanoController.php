<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Proyectos\ProyectoPlano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoPlanoController extends Controller
{
    public function index(){
        return view('proyectos.planos.index');
    }

    public function store(Request $request){
        $result = $request->file->storeOnCloudinary('img_planos');
        $file_name = $result->getPublicId();
        $plano = new ProyectoPlano([
            'proyecto_id' => $request->proyecto_id,
            'usuario_id' => Auth::id(),
            'descripcion' => $request->descripcion,
            'file' => $file_name,
        ]);

        $plano->save();

        return response()->json(['saved' => true, 'plano' => $plano]);

    }

    public function get(){
        return response()->json(['planos' => ProyectoPlano::with('proyecto')->where('usuario_id', Auth::id())->get()]);
    }

    public function delete(ProyectoPlano $proyecto_plano){
        $proyecto_plano->delete();
        return response()->json(['deleted' => true]);
    }

    public function aprobar(ProyectoPlano $proyecto_plano){
        $proyecto_plano->estado = "aprobado";
        $proyecto_plano->save();

        return response()->json(['status' => true]);
    }

    public function rechazar(ProyectoPlano $proyecto_plano){
        $proyecto_plano->estado = "rechazado";
        $proyecto_plano->save();
        return response()->json(['status' => true]);
    }

    public function indexAdmin(){
        return view('proyectos.planos.admin.index');
    }

    public function getAdmin(){
        return response()->json(['planos' => ProyectoPlano::with('proyecto')->get()]);
    }
}
