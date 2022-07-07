<?php

namespace App\Http\Controllers\Proyectos;

use App\Events\ProyectoEvent;
use App\Http\Controllers\Controller;
use App\Models\Cotizaciones\Cotizacion;
use App\Models\Cotizaciones\SubCotizacionProducto;
use App\Models\Proyectos\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    public function index(){
        return view('proyectos.index');
    }

    public function get(){
        return response()->json(['proyectos' => Proyecto::get()]);
    }

    public function form(Proyecto $proyecto = null){
        if(is_null($proyecto)){
            return view('proyectos.form');
        }
        return view('proyectos.form', ['proyecto' => $proyecto->load('cotizacion')]);
    }

    public function store(Request $request){
        $proyecto = new Proyecto($request->all());
        $proyecto->usuario_id = Auth::id();
        $proyecto->estado = 'activo';
        $proyecto->save();
        $cotizacion = Cotizacion::where('id', $request->cotizacion_id)->get()->first();
        $cotizacion->update();
        $cotizacion->estado = "progreso";
        $cotizacion->save();
        $tipo['accion'] = "insert";
        $tipo['tabla'] = "proyectos";
        event(new ProyectoEvent($proyecto, $tipo));
        return response()->json(['saved' => true, 'proyecto' => $proyecto, 'cotizacion' => $cotizacion]);
    }

    public function edit(Proyecto $proyecto, Request $request){
        $old_proyecto = Proyecto::find($proyecto->id);
        $cotizacion = Cotizacion::where('id', $proyecto->cotizacion_id)->get()->first();
        $cotizacion->update();
        $cotizacion->estado = "activo";
        $cotizacion->save();
        $proyecto->update($request->all());
        $proyecto->save();
        $cotizacion = Cotizacion::where('id', $request->cotizacion_id)->get()->first();
        $cotizacion->update();
        $cotizacion->estado = "progreso";
        $cotizacion->save();
        $tipo['accion'] = "update";
        $tipo['tabla'] = "proyectos";
        event(new ProyectoEvent($proyecto, $tipo, $old_proyecto));
        return response()->json(['edited' => true, 'proyecto' => $proyecto, 'cotizacion' => $cotizacion]);
    }

    public function show(Proyecto $proyecto){
        return view('proyectos.show', ['proyecto' => $proyecto->load('whoCreated.informacionPersonal', 'planos.whoCreated.informacionPersonal', 'cotizacion', 'actividades.empleado.informacionPersonal'), 'inventario' => Proyecto::inventario($proyecto->id)]);
    }

    public function getInventario(Proyecto $proyecto){
        return response()->json(['inventario' => SubCotizacionProducto::getInventario($proyecto->id)]);
    }
}
