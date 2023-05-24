<?php

namespace App\Http\Controllers;

use App\Models\Dolar\DolarValor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DolarValorController extends Controller
{
    public function storeTRM(Request $request){
        $dolar_valor = DolarValor::where([['vigencia_desde', '=', $request->vigencia_desde], ['vigencia_hasta', '=', $request->vigencia_hasta]])->count();
        if($dolar_valor > 0){
            return response()->json(['status' => false]);
        }
        DolarValor::where('deleted_at', null)->delete();
        $dolar = new DolarValor($request->all());
        $dolar->save();

        $dolar->vigencia_desde = Carbon::parse($dolar->vigencia_desde)->format('Y-m-d');
        $dolar->vigencia_hasta = Carbon::parse($dolar->vigencia_hasta)->format('Y-m-d');
        return response()->json(['trm' => $dolar, 'status' => true]);
    }

    public function getTRM(){
        $dolar = DolarValor::first();
        $dolar->vigencia_desde = Carbon::parse($dolar->vigencia_desde)->format('Y-m-d');
        $dolar->vigencia_hasta = Carbon::parse($dolar->vigencia_hasta)->format('Y-m-d');
        return response()->json(['trm' => $dolar]);
    }
}
