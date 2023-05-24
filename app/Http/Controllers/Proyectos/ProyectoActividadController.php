<?php

namespace App\Http\Controllers\Proyectos;

use App\Events\ActividadEvent;
use App\Http\Controllers\Controller;
use App\Models\Cotizaciones\SubCotizacionProducto;
use App\Models\Productos\Producto;
use App\Models\Proyectos\ProyectoActividad;
use App\Models\Proyectos\ProyectoActividadFile;
use App\Models\Proyectos\ProyectoActividadProducto;
use App\Models\Proyectos\ProyectoActividadProductoSolicitud;
use App\Models\Proyectos\ProyectoActividadPrueba;
use App\Models\Proyectos\ProyectoActividadReporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoActividadController extends Controller
{
    public function index(){
        return view('proyectos.actividades.index');
    }

    public function indexTecnico(){
        return view('proyectos.actividades.tecnico.index');
    }

    public function show(ProyectoActividad $actividad){
        $reportes = ProyectoActividadReporte::with('producto.productos.productos', 'usuario.informacionPersonal')->where('actividad_id', $actividad->id)->get();
        return view('proyectos.actividades.show', ['actividad' => $actividad->load('whoCreated.informacionPersonal', 'pruebas', 'proyecto', 'empleado.informacionPersonal', 'files', 'inventario.productos.productos'), 'reportes' => $reportes]);
    }

    public function form(ProyectoActividad $actividad = null){
        if(is_null($actividad)){
            return view('proyectos.actividades.form');
        }else{
            return view('proyectos.actividades.form', ['actividad' => $actividad]);
        }
    }

    public function delete(ProyectoActividad $actividad){
        $actividad->delete();
        $tipo['accion'] = "update";
        $tipo['tabla'] = "proyecto_actividades";
        $tipo['user_id'] = $actividad->empleado_id;
        event(new ActividadEvent($actividad, $tipo));
        return response()->json(['deleted' => true]);
    }

    public function store(Request $request){
        $actividad = new ProyectoActividad($request->all());
        $actividad->usuario_id = Auth::id();
        $actividad->save();
        $tipo['accion'] = "insert";
        $tipo['tabla'] = "proyecto_actividades";
        $tipo['user_id'] = $actividad->empleado_id;
        event(new ActividadEvent($actividad, $tipo));
        return response()->json(['actividad' => $actividad, 'insert' => true]);
    }

    public function update(ProyectoActividad $actividad, Request $request){
        $old_actividad = ProyectoActividad::find($actividad->id);
        $actividad->update($request->all());
        $actividad->save();
        $tipo['accion'] = "update";
        $tipo['tabla'] = "proyecto_actividades";
        $tipo['user_id'] = $actividad->empleado_id;
        event(new ActividadEvent($actividad, $tipo, $old_actividad));
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

    public function storeInventario(ProyectoActividad $actividad, Request $request){
        if(is_null($actividad->proyecto_id)){
            $producto = new ProyectoActividadProducto();
            $producto->producto_id = $request->sub_cotizacion_producto_id;
            $producto->cantidad = $request->cantidad;
            $producto->proyecto_actividad_id = $actividad->id;
            $producto->estado = "asignado";
            if(ProyectoActividadProducto::validarProductoSecundario($producto->producto_id, $producto->proyecto_actividad_id) > 0){
                return response()->json(['status' => false, 'msg' => 'El producto ya se encuentra agregado']);
            }
            if(Producto::validar($producto->producto_id, $producto->cantidad) > 0){
                return response()->json(['status' => false, 'msg' => 'La cantidad asignada no se encuentra disponible']);
            }
            $producto->save();
        }else{
            $producto = new ProyectoActividadProducto($request->all());
            $producto->proyecto_actividad_id = $actividad->id;
            $producto->estado = "asignado";
            if(ProyectoActividadProducto::validarProducto($producto->sub_cotizacion_producto_id, $producto->proyecto_actividad_id) > 0){
                return response()->json(['status' => false, 'msg' => 'El producto ya se encuentra agregado']);
            }
            if(SubCotizacionProducto::validar($producto->sub_cotizacion_producto_id, $producto->cantidad) > 0){
                return response()->json(['status' => false, 'msg' => 'La cantidad asignada no se encuentra disponible']);
            }
            if(SubCotizacionProducto::validarCantidad($producto->sub_cotizacion_producto_id, $producto->cantidad) > 0){
                return response()->json(['status' => false, 'msg' => 'Actualmente no hay cantidad suficiente para satisfacer la cantidad requerida']);
            }
            $sub_cotizacion_producto = SubCotizacionProducto::find($producto->sub_cotizacion_producto_id);
            if(($sub_cotizacion_producto->cantidad - $sub_cotizacion_producto->cantidad_usada) < $producto->cantidad){
                return response()->json(['status' => false, 'msg' => 'La cantidad asignada no se encuentra disponible']);
            }
            $producto->save();
            $sub_cotizacion_producto->cantidad_usada = $sub_cotizacion_producto->cantidad_usada + $producto->cantidad;
            $sub_cotizacion_producto->update();
            $sub_cotizacion_producto->save();
        }
        return response()->json(['status' => true, 'msg' => 'Producto agregado.']);
    }

    public function getInventario(ProyectoActividad $actividad){
        if(is_null($actividad->proyecto_id)){
            return response()->json(['inventario'=> ProyectoActividadProducto::getInventarioSecundario($actividad->id)]);
        }
        return response()->json(['inventario' => ProyectoActividadProducto::getInventario($actividad->id)]);
    }

    public function getFiles(ProyectoActividad $actividad){
        return response()->json(['files' => $actividad->load('files')]);
    }

    public function deleteFiles(ProyectoActividadFile $file){
        $file->delete();
        return response()->json(['deleted' => true]);
    }

    public function get(){
        return response()->json(['actividades' => ProyectoActividad::with('proyecto', 'empleado.informacionPersonal', 'reagendamientos')->get()]);
    }

    public function getActividadesUsuario(){
        return response()->json(['actividades' => ProyectoActividad::with('proyecto', 'empleado.informacionPersonal', 'reagendamientos')->where('empleado_id', Auth::id())->get()]);
    }

    public function calendario(){
        return view('proyectos.actividades.tecnico.calendario');
    }

    public function getActividad(ProyectoActividad $actividad){
        return response()->json(['actividad' => $actividad->load('proyecto', 'files', 'inventario.productos.productos', 'inventario.productos_secundarios', 'pruebas', 'reportes.producto.productos.productos', 'solicitudes.producto', 'asistencias', 'reagendamientos')]);
    }

    public function uploadPruebas(ProyectoActividad $actividad, Request $request){
        if($request->hasFile('files')){
            $files = $request->file('files');
            foreach ($files as $key => $file) {
                $names[$key] = $file->storeOnCloudinary('actividades_pruebas')->getPublicId();
            }
            $proyecto_pruebas = new ProyectoActividadPrueba([
                'actividad_id' => $actividad->id,
                'descripcion' => $request->descripcion,
                'fecha' => $request->fecha,
                'files' => json_encode($names)
            ]);
            $proyecto_pruebas->save();
            //$actividad->update(['estado' => 'completado']);
            //$actividad->save();
            // $tipo['accion'] = "finalizada";
            // $tipo['tabla'] = "proyecto_actividades";
            // $tipo['user_id'] = $actividad->empleado_id;
            // event(new ActividadEvent($actividad, $tipo));
        }else{
            return response()->json(['status' => false, 'msg' => 'No es han seleccionado imagenes']);
        }
        return response()->json(['status' => true, 'msg' => 'Pruebas subidas']);

        /////////////////////////////////////// FALTA DESCONTAR PRODUCTOS ///////////////////////////////
    }

    public function finalizarActividad(ProyectoActividad $actividad){
        $actividad->update(['estado' => 'completado']);
        $actividad->save();
        $tipo['accion'] = "finalizada";
        $tipo['tabla'] = "proyecto_actividades";
        $tipo['user_id'] = $actividad->empleado_id;
        event(new ActividadEvent($actividad, $tipo));
        return response()->json(['status' => true, 'msg' => 'Actividad finalizada']);
    }

    public function cambiarEstado(ProyectoActividad $actividad, Request $request){
        $actividad->update(['estado' => $request->value]);
        $actividad->save();
        $tipo['accion'] = $request->value;
        $tipo['tabla'] = "proyecto_actividades";
        $tipo['user_id'] = $actividad->empleado_id;
        event(new ActividadEvent($actividad, $tipo));
        return response()->json(['status' => true, 'msg' => 'Actividad actualizada']);
    }


}
