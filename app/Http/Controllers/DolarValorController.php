<?php

namespace App\Http\Controllers;

use App\Models\Dolar\DolarValor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DolarValorController extends Controller
{
    public function storeTRM(Request $request){
        if(DolarValor::where('vigencia_desde', $request->vigencia_desde)->count() > 0){
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
        $dolar = DolarValor::get()->first();
        $dolar->vigencia_desde = Carbon::parse($dolar->vigencia_desde)->format('Y-m-d');
        $dolar->vigencia_hasta = Carbon::parse($dolar->vigencia_hasta)->format('Y-m-d');
        return response()->json(['trm' => $dolar]);
    }
}
