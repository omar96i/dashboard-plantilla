<?php

namespace App\Http\Controllers\Cotizaciones;

use App\Http\Controllers\Controller;
use App\Models\Cotizaciones\Cotizacion;
use App\Models\Cotizaciones\CotizacionAbono;
use App\Models\Cotizaciones\SubCotizacion;
use App\Models\Cotizaciones\SubCotizacionProducto;
use App\Models\EmpresaDato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CotizacionTemplateController extends Controller
{
    public function store(Cotizacion $cotizacion){
        $cotizacion->load('subCotizaciones.productos', 'abonos');
        $empresa_dato = EmpresaDato::where('estado', 'active')->get()->first();
        $template_cotizacion = new Cotizacion([
            'cliente_proyecto' => $cotizacion->cliente_proyecto,
            'direccion' => $cotizacion->direccion,
            'documento' => $cotizacion->documento,
            'email' => $cotizacion->email,
            'empresa_datos_id' => $empresa_dato->id,
            'estado' => 'activo',
            'fecha' => $cotizacion->fecha,
            'nombre_facturar' => $cotizacion->nombre_facturar,
            'telefono' => $cotizacion->telefono,
            'user_id' => Auth::id()
        ]);

        $template_cotizacion->save();

        if(count($cotizacion->abonos) > 0){
            foreach($cotizacion->abonos as $abono){
                $abono_template = new CotizacionAbono([
                    'cotizacion_id' => $template_cotizacion->id,
                    'nombre' => $abono->nombre,
                    'valor' => $abono->valor,
                    'observacion' => $abono->observacion,
                ]);
                $abono_template->save();
            }
        }

        if(count($cotizacion->subCotizaciones) > 0){

            foreach ($cotizacion->subCotizaciones as $key => $sub_cotizacion) {

                $sub_cotizacion_template = new SubCotizacion([
                    'cotizacion_id' => $template_cotizacion->id,
                    'area' => $sub_cotizacion->area,
                    'descripcion' => $sub_cotizacion->descripcion
                ]);
                $sub_cotizacion_template->save();
                if(count($sub_cotizacion->productos) > 0){
                    foreach ($sub_cotizacion->productos as $key => $producto) {
                        $sub_cotizacion_producto_template = new SubCotizacionProducto([
                            'producto_id' => $producto->producto_id,
                            'sub_cotizacion_id' => $sub_cotizacion_template->id,
                            'cantidad' => $producto->cantidad,
                            'ubicacion' => $producto->ubicacion,
                            'estado' => 'activo'
                        ]);
                        $sub_cotizacion_producto_template->save();
                    }
                }
            }
        }

        $template = Cotizacion::where('id', $template_cotizacion->id)->get()->first();


        return response()->json(['saved' => true, 'cotizacion' => $template]);
    }
}
