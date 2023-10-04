<?php

namespace App\Http\Controllers\Cotizaciones;

use App\Events\CotizacionEvent;
use App\Http\Controllers\Controller;
use App\Models\Cotizaciones\Cotizacion;
use App\Models\Cotizaciones\CotizacionAbono;
use App\Models\Cotizaciones\SubCotizacion;
use App\Models\Cotizaciones\SubCotizacionProducto;
use App\Models\Dolar\DolarValor;
use App\Models\EmpresaDato;
use App\Models\Productos\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CotizacionController extends Controller
{
    public function index(){
        return view('cotizaciones.index');
    }

    public function form(){
        return view('cotizaciones.form');
    }

    public function show(Cotizacion $cotizacion){
        return view('cotizaciones.show', ['cotizacion' => $cotizacion->load(['whoCreated.informacionPersonal', 'datosEmpresa', 'subCotizaciones.productos.productos.valores', 'abonos', 'files',
        'dolar'=> function ($query) {
            $query->withTrashed()->get();  // perhaps without the get.
        },])]);
    }

    public function store(Request $request){
        $empresa_datos = EmpresaDato::count();
        $dolar = DolarValor::get()->first();
        if($empresa_datos > 0){
            $empresa_datos = EmpresaDato::get()->first();
        }else{
            return response()->json(['saved' => false, 'msg' => 'Error crear, Verifica que los datos basicos de la empresa esten creados']);
        }
        $cotizacion = new Cotizacion($request->all());
        $cotizacion->user_id = Auth::id();
        $cotizacion->empresa_datos_id = $empresa_datos->id;
        $cotizacion->dolar_id = $dolar->id;
        $cotizacion->fecha = Carbon::now()->format('Y-m-d');
        $cotizacion->estado = "activo";
        $cotizacion->save();
        $tipo['accion'] = "insert";
        $tipo['tabla'] = "cotizaciones";
        event(new CotizacionEvent($cotizacion, $tipo));
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
        $producto = Producto::with('valores')->find($request->producto_id);
        $producto_sc = new SubCotizacionProducto($request->all());
        $producto_sc->producto_valor_id = $producto->valores[0]->id;
        $producto_sc->sub_cotizacion_id = $sub_cotizacion->id;
        $producto_sc->estado = "activo";
        $producto_sc->save();
        return response()->json(['saved' => true]);
    }

    public function update(Cotizacion $cotizacion, Request $request){
        $old_cotizacion = Cotizacion::find($cotizacion->id);
        $cotizacion->update($request->all());
        $cotizacion->save();
        $tipo['accion'] = "update";
        $tipo['tabla'] = "cotizaciones";
        event(new CotizacionEvent($cotizacion, $tipo, $old_cotizacion));
        return response()->json(['updated' => true, 'cotizacion' => $cotizacion]);
    }

    public function updateSubCotizacion(SubCotizacion $sub_cotizacion, Request $request){
        $sub_cotizacion->update($request->all());
        $sub_cotizacion->save();
        return response()->json(['updated' => true, 'sub_cotizacion' => $sub_cotizacion]);
    }

    public function delete(Cotizacion $cotizacion){
        $old_cotizacion = $cotizacion;
        $cotizacion->delete();
        $tipo['accion'] = "delete";
        $tipo['tabla'] = "cotizaciones";
        event(new CotizacionEvent($cotizacion, $tipo, $old_cotizacion));
        return response()->json(['deleted' => true]);
    }

    public function deleteSubCotizacion(SubCotizacion $sub_cotizacion){
        $sub_cotizacion->delete();
        return response()->json(['deleted' => true]);
    }


    // No esta
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
        return response()->json(['cotizaciones' => Cotizacion::with('whoCreated.informacionPersonal')->get()]);
    }

    public function getEnabled(){
        return response()->json(['cotizaciones' => Cotizacion::where('estado', 'activo')->get()]);
    }

    public function edit(Cotizacion $cotizacion){
        return view('cotizaciones.form', compact('cotizacion'));
    }

    public function getDolar($id){
        return response()->json(['dolar' => DolarValor::withTrashed()->where('id', $id)->get()->first(), 'dolars' => DolarValor::withTrashed()->orderBy('vigencia_desde', 'desc')->get()]);
    }

    public function updateDolar(Cotizacion $cotizacion, Request $request){
        $cotizacion->dolar_id = $request->id;
        $cotizacion->update();
        $cotizacion->save();
        return response()->json(['status' => true, 'dolar' => DolarValor::withTrashed()->find($request->id)]);
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
            $producto->cantidad = $request->cantidad;
        }
        $producto->save();
        return response()->json(['updated' => true, 'msg' => 'Actualizado']);
    }

    public function getAbonos(Cotizacion $cotizacion){
        return response()->json(['abonos' => CotizacionAbono::where('cotizacion_id', $cotizacion->id)->get()]);
    }

    public function storeAbonos(Cotizacion $cotizacion, Request $request){
        $cotizacion_abono = new CotizacionAbono($request->all());
        $cotizacion_abono->cotizacion_id = $cotizacion->id;
        $cotizacion_abono->save();

        return response()->json(['saved' => true]);
    }

    public function deleteAbono(CotizacionAbono $abono){
        $abono->delete();
        return response()->json(['deleted' => true]);
    }

    public function updateAbono(CotizacionAbono $abono){
        $abono->update();
        $abono->estado = 'completo';
        $abono->save();
        return response()->json(['updated' => true]);
    }

    public function getValorGeneral(Cotizacion $cotizacion){
        return response()->json(['cotizaciones' => $cotizacion->load('subCotizaciones.productos.productos.valores')]);
    }
}
