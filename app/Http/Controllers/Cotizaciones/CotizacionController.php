<?php

namespace App\Http\Controllers\Cotizaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    public function index(){
        return view('cotizaciones.index');
    }

    public function form(){
        return view('cotizaciones.form');
    }

    public function pruebas(){

    }
}
