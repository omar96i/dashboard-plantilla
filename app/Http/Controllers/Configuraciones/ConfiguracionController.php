<?php

namespace App\Http\Controllers\Configuraciones;

use App\Http\Controllers\Controller;
use App\Models\EmpresaDato;
use App\Models\Iva\Iva;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function index(){
        return view('configuraciones.index');
    }

    public function storeIva(Request $request){
        Iva::where('deleted_at', null)->delete();
        $iva = new Iva($request->all());
        $iva->save();
        return response()->json(['saved' => true, 'iva' => $iva]);
    }

    public function storeDatosBasicos(Request $request){
        EmpresaDato::where('estado', 'active')->delete();
        $datos_basicos = new EmpresaDato($request->all());
        $datos_basicos->save();
        return response()->json(['saved' => true, 'empresa_datos' => $datos_basicos]);
    }

    public function getIva(){
        return response()->json(['iva' => Iva::get()->first()]);
    }

    public function getDatosBasicos(){
        return response()->json(['datos_basicos' => EmpresaDato::get()->first()]);
    }
}
