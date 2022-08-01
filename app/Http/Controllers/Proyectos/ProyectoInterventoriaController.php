<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Proyectos\ProyectoInterventoria;
use App\Models\Proyectos\ProyectoInterventoriaFile;
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
        return response()->json(['interventoria' => $interventoria->load('proyecto', 'usuario.informacionPersonal', 'files')]);
    }

    public function get(){
        return response()->json(['interventorias' => ProyectoInterventoria::with('proyecto', 'usuario.informacionPersonal', 'files')->get()]);
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
        // if(!is_null($interventoria->firma_cliente) || !is_null($interventoria->firma_operario)){
        //     if($request->type == 'cliente'){
        //         cloudinary()->destroy($interventoria->firma_cliente);
        //     }else{
        //         cloudinary()->destroy($interventoria->firma_operario);
        //     }
        // }
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

    public function storeFiles(ProyectoInterventoria $interventoria, Request $request){
        if($request->hasFile('files')){
            $files = $request->file('files');
            foreach ($files as $key => $file) {
                $names[$key] = $file->storeOnCloudinary('interventoria_files')->getPublicId();
            }
            if($request->tipo == 'update'){
                $interventoria_pruebas = ProyectoInterventoriaFile::where('interventoria_id', $interventoria->id)->first();
                $delete = json_decode($interventoria_pruebas->files);
                // foreach ($delete as $key => $file) {
                //     cloudinary()->destroy($file);
                // }
                $interventoria_pruebas->update();
                $interventoria_pruebas->files = json_encode($names);
                $interventoria_pruebas->save();
            }else{
                $interventoria_pruebas = new ProyectoInterventoriaFile([
                    'interventoria_id' => $interventoria->id,
                    'files' => json_encode($names)
                ]);
                $interventoria_pruebas->save();
            }
        }else{
            return response()->json(['status' => false, 'msg' => 'No es han seleccionado imagenes']);
        }
        return response()->json(['status' => true, 'msg' => 'Pruebas subidas']);
    }
}
