<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Proyectos\ProyectoInterventoria;
use Illuminate\Http\Request;
class ProyectoInterventoriaController extends Controller
{
    public function index(){
        return view('proyectos.interventorias.index');
    }

    public function store(Request $request){
        $interventoria = new ProyectoInterventoria($request->all());
        $interventoria->save();
        return response()->json(['status' => true, 'msg' => 'Interventoria creada']);
    }

    public function getOne(ProyectoInterventoria $interventoria){
        return response()->json(['interventoria' => $interventoria]);
    }

    public function get(){
        return response()->json(['interventorias' => ProyectoInterventoria::with('proyecto', 'usuario.informacionPersonal')->get()]);
    }

    public function update(ProyectoInterventoria $interventoria, Request $request){
        $interventoria->update($request->all());
        $interventoria->save();
        return response()->json(['status' => true, 'msg' => 'Interventoria actualizada']);
    }

    public function show(ProyectoInterventoria $interventoria){
        return view('proyectos.interventorias.show', ['interventoria' => $interventoria->load('proyecto.cotizacion', 'usuario.informacionPersonal')]);
    }

    public function pdf(ProyectoInterventoria $interventoria){
        view()->share('proyectos.interventorias.show',['interventoria' => $interventoria->load('proyecto.cotizacion', 'usuario.informacionPersonal')]);
        $pdf = \PDF::loadView('proyectos.interventorias.show', ['interventoria' => $interventoria->load('proyecto.cotizacion', 'usuario.informacionPersonal')]);
        return $pdf->download('interventoria_'.$interventoria->id.'.pdf');
    }

    public function storeFirma(ProyectoInterventoria $interventoria, Request $request){
        if(!is_null($interventoria->firma_cliente) || !is_null($interventoria->firma_operario)){
            if($request->type == 'cliente'){
                cloudinary()->destroy($interventoria->firma_cliente);
            }else{
                cloudinary()->destroy($interventoria->firma_operario);
            }
        }
        $result = $request->img->storeOnCloudinary('firmas');
        $imageName = $result->getPublicId();
        $interventoria->update();
        if($request->type == 'cliente'){
            $interventoria->firma_cliente = $imageName;
        }else{
            $interventoria->firma_operario = $imageName;
        }
        $interventoria->save();
        return response()->json(['status' => true, 'msg' => 'la firma a sido creada.', 'img' => $imageName]);
    }
}
