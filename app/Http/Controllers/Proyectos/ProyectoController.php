<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index(){
        return view('proyectos.index');
    }
}
