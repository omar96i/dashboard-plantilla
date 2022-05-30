<?php

namespace App\Http\Controllers\Cotizaciones;

use App\Http\Controllers\Controller;
use App\Models\Cotizaciones\Cotizacion;
use App\Models\Cotizaciones\CotizacionFile;
use Illuminate\Http\Request;

class CotizacionFileController extends Controller
{
    public function store(Cotizacion $cotizacion, Request $request){
        $result = $request->file->storeOnCloudinary('cotizacion_planos');
        $file = new CotizacionFile([
            'cotizacion_id' => $cotizacion->id,
            'file' => $result->getPublicId()
        ]);
        $file->save();
        return response()->json(['status' => true, 'file' => $file]);
    }

    public function get(Cotizacion $cotizacion){
        return response()->json(['files' => $cotizacion->load('files')]);
    }

    public function delete(CotizacionFile $file){
        $file->delete();
        return response()->json(['deleted' => true]);
    }
}
