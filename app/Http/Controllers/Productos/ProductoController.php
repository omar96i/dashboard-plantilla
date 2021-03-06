<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Productos\Producto;
use App\Models\Productos\ProductoValor;

class ProductoController extends Controller
{
    public function index(){
        return view('productos.index');
    }

    public function store(Request $request){
        $product = new Producto($request->all());

        if(isset($request->foto)){
            $result = $request->foto->storeOnCloudinary('img_productos');
            $imageName = $result->getPublicId();
        }

        $product->foto = $imageName;

        $product->save();

        ProductoValor::where('producto_id', '=', $product->id)->delete();

        $valor = new ProductoValor([
            'producto_id' => $product->id,
            'valor' => $request->valor,
            'sub_valor' => $request->sub_valor,
            'porcentaje' => $request->porcentaje,
            'tipo' => $request->tipo
        ]);

        $valor->save();

        return response()->json(['saved' => true]);
    }

    public function update(Producto $producto, Request $request){

        $producto->update($request->all());

        if(isset($request->foto)){
            $result = $request->foto->storeOnCloudinary('img_productos');
            $imageName = $result->getPublicId();
            $producto->foto = $imageName;
        }

        $producto->save();

        $valor = ProductoValor::where('producto_id', '=', $producto->id)->get();

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
        return response()->json(['saved' => true]);
    }

    public function getAll(){
        return response()->json(['productos' => Producto::with('valores', 'categoria')->get()]);
    }

    public function delete(Producto $producto){
        $producto->delete();
        return response()->json(['deleted' => true]);
    }

    public function get(Producto $producto){
        return response()->json(['producto' => $producto->load('valores')]);
    }
}
