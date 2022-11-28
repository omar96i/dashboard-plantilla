<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use Illuminate\Http\Request;
use App\Models\Productos\Producto;
use App\Models\Productos\ProductoCategoria;
use App\Models\Productos\ProductoValor;
use Maatwebsite\Excel\Facades\Excel;

class ProductoController extends Controller
{
    public function index(){
        return view('productos.index');
    }

    public function store(Request $request){
        $product = new Producto($request->all());

        if($request->hasFile('files')){
            $files = $request->file('files');
            foreach ($files as $key => $file) {
                $names[$key] = $file->storeOnCloudinary('img_productos')->getPublicId();
            }
            $product->files = json_encode($names);
        }

        $product->save();

        foreach($request->categorias as $categoria){
            $save_categoria = new ProductoCategoria([
                'producto_id' => $product->id,
                'categoria_id' => $categoria
            ]);
            $save_categoria->save();
        }

        ProductoValor::where('producto_id', '=', $product->id)->delete();

        $valor = new ProductoValor([
            'producto_id' => $product->id,
            'valor' => $request->valor,
            'sub_valor' => $request->sub_valor,
            'porcentaje' => $request->porcentaje,
            'tipo' => $request->tipo
        ]);

        $valor->save();

        return response()->json(['saved' => true, 'data' => $product->load('categorias.categoria')]);
    }

    public function storeExcel(Request $request){
        if($request->hasFile('file')){
            Excel::import(new ProductImport, $request->file);

            return response()->json(['status' => true, 'msg' => 'Importacion exitosa']);
        }else{
            return response()->json(['status' => false, 'msg' => 'Archivo no seleccionado']);
        }
    }

    public function update(Producto $producto, Request $request){
        if($request->hasFile('files')){
            $files = $request->file('files');
            foreach ($files as $key => $file) {
                $names[$key] = $file->storeOnCloudinary('img_productos')->getPublicId();
            }
            if($producto->files == null){
                $producto->files = json_encode($names);
            }else{
                $aux = json_decode($producto->files);
                foreach ($names as $key => $file) {
                    array_push($aux, $file);
                }
                $producto->files = json_encode($aux);
            }
        }
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->referencia = $request->referencia;
        $producto->marca = $request->marca;
        $producto->color = $request->color;
        $producto->temperatura_calor = $request->temperatura_calor;
        $producto->voltaje = $request->voltaje;
        $producto->cantidad = $request->cantidad;

        $producto->update();
        $producto->save();

        ProductoCategoria::where('producto_id', $producto->id)->delete();

        foreach($request->categorias as $categoria){
            $save_categoria = new ProductoCategoria([
                'producto_id' => $producto->id,
                'categoria_id' => $categoria
            ]);
            $save_categoria->save();
        }

        $valor = ProductoValor::where('producto_id', '=', $producto->id)->get();

        if(count($valor) > 0){
            if($valor[0]->valor != $request->valor || $valor[0]->tipo != $request->tipo || $valor[0]->sub_valor != $request->sub_valor || $valor[0]->porcentaje != $request->porcentaje){
                ProductoValor::where('producto_id', '=', $producto->id)->delete();
                $valor = new ProductoValor([
                    'producto_id' => $producto->id,
                    'valor' => $request->valor,
                    'sub_valor' => $request->sub_valor,
                    'porcentaje' => $request->porcentaje,
                    'tipo' => $request->tipo
                ]);

                $valor->save();
            }
        }else{
            $valor = new ProductoValor([
                'producto_id' => $producto->id,
                'valor' => $request->valor,
                'sub_valor' => $request->sub_valor,
                'porcentaje' => $request->porcentaje,
                'tipo' => $request->tipo
            ]);

            $valor->save();
        }


        return response()->json(['saved' => true]);
    }

    public function deleteImg(Producto $producto, Request $request){
        $delete_file = $request->img;
        $files = json_decode($producto->files);
        $aux = 0;
        $names = [];
        foreach ($files as $key => $file) {
            if($delete_file != $file){
                $names[$aux] = $file;
                $aux = $aux + 1;
            }else{
                cloudinary()->destroy($file);
            }

        }
        if(count($names) > 0){
            $producto->files = json_encode($names);
        }else{
            $producto->files = null;
        }

        $producto->update();
        $producto->save();

        return response()->json(['status' => true, 'producto' => json_decode($producto->files)]);
    }

    public function getAll(){
        return response()->json(['productos' => Producto::with('valores', 'categoria', 'categorias.categoria')->get()]);
    }

    public function delete(Producto $producto){
        $producto->delete();
        return response()->json(['deleted' => true]);
    }

    public function get(Producto $producto){
        return response()->json(['producto' => $producto->load('valores', 'categorias.categoria')]);
    }
}
