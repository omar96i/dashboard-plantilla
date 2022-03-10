<?php

namespace App\Http\Controllers\Cotizaciones;

use App\Http\Controllers\Controller;
use App\Models\Cotizaciones\Cotizacion;
use App\Models\Cotizaciones\SubCotizacion;
use App\Models\Cotizaciones\SubCotizacionProducto;
use App\Models\Productos\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    public function index(){
        return view('cotizaciones.index');
    }

    public function form(){
        return view('cotizaciones.form');
    }

    public function show(Cotizacion $cotizacion){
        return view('cotizaciones.show', ['cotizacion' => $cotizacion->load('whoCreated.informacionPersonal', 'datosEmpresa', 'subCotizaciones.productos.productos')]);
    }

    public function store(Request $request){
        $cotizacion = new Cotizacion($request->all());
        $cotizacion->user_id = 4;
        $cotizacion->empresa_datos_id = 1;
        $cotizacion->fecha = Carbon::now();
        $cotizacion->estado = "activo";
        $cotizacion->save();
        return response()->json(['saved' => true, 'cotizacion' => $cotizacion]);

    }

    public function storeSubCotizacion(Cotizacion $cotizacion, Request $request){
        $sub_cotizacion = new SubCotizacion($request->all());
        $sub_cotizacion->cotizacion_id = $cotizacion->id;
        $sub_cotizacion->save();
        return response()->json(['sub_cotizacion' => $sub_cotizacion, 'saved' => true]);
    }

    public function storeProduct(SubCotizacion $sub_cotizacion, Request $request){
        if(SubCotizacionProducto::where(['producto_id' => $request->producto_id, 'sub_cotizacion_id' => $sub_cotizacion->id])->count() > 0){
            return response()->json(['saved' => false, 'msg' => 'El producto ya se encuenta registrado']);
        }
        $condicion = Producto::find($request->producto_id);
        if($request->cantidad > $condicion->cantidad){
            return response()->json(['saved' => false, 'msg' => 'La cantidad seleccionada excede la del stock']);
        }
        $producto_sc = new SubCotizacionProducto($request->all());
        $producto_sc->sub_cotizacion_id = $sub_cotizacion->id;
        $producto_sc->estado = "activo";
        $producto_sc->save();
        return response()->json(['saved' => true]);
    }

    public function update(Cotizacion $cotizacion, Request $request){
        $cotizacion->update($request->all());
        $cotizacion->save();
        return response()->json(['updated' => true, 'cotizacion' => $cotizacion]);
    }

    public function updateSubCotizacion(SubCotizacion $sub_cotizacion, Request $request){
        $sub_cotizacion->update($request->all());
        $sub_cotizacion->save();
        return response()->json(['updated' => true, 'sub_cotizacion' => $sub_cotizacion]);
    }

    public function delete(Cotizacion $cotizacion){
        $cotizacion->delete();
        return response()->json(['deleted' => true]);
    }

    public function deleteSubCotizacion(SubCotizacion $sub_cotizacion){
        $sub_cotizacion->delete();
        return response()->json(['deleted' => true]);
    }

    public function get(){
        return response()->json(['cotizacion' => Cotizacion::find(1)]);
    }

    public function getSubCotizaciones(Cotizacion $cotizacion){
        return response()->json(['sub_cotizacion' => SubCotizacion::where('cotizacion_id', '=', $cotizacion->id)->get()]);
    }

    public function getSubCotizacionOnly(SubCotizacion $sub_cotizacion){
        return response()->json(['sub_cotizacion' => $sub_cotizacion, 'productos_sub_cotizacion' => SubCotizacionProducto::where('sub_cotizacion_id', $sub_cotizacion->id)->where('estado', 'activo')->with('productos.valores')->get()]);
    }

    public function getAll(){
        return response()->json(['cotizaciones' => Cotizacion::get()]);
    }

    public function edit(Cotizacion $cotizacion){
        return view('cotizaciones.form', compact('cotizacion'));
    }

    public function deleteProducto(SubCotizacionProducto $producto){
        $producto->delete();
        return response()->json(['deleted' => true]);
    }

    public function updateProducto(SubCotizacionProducto $producto, Request $request){
        $producto->update();
        if(isset($request->ubicacion)){
            $producto->ubicacion = $request->ubicacion;
        }
        if(isset($request->cantidad)){
            $condicion = Producto::find($producto->producto_id);
            if($request->cantidad > $condicion->cantidad){
                return response()->json(['updated' => false, 'msg' => 'La cantidad seleccionada excede la del stock']);
            }
            $producto->cantidad = $request->cantidad;
        }
        $producto->save();
        return response()->json(['updated' => true, 'msg' => 'Actualizado']);
    }
}
