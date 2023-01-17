<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use App\Models\Productos\ProductoReabastecimiento;
use App\Models\Productos\Producto;
use Illuminate\Http\Request;

class ProductoReabastecimientoController extends Controller
{
    public function index(){
        return view('productos.reabastecimientos.index');
    }

    public function store(Request $request){
        $producto = new ProductoReabastecimiento($request->all());
        $producto->save();
        $product = Producto::find($producto->producto_id);
        $cantidad = $product->cantidad+$producto->cantidad;
        $product->cantidad = $cantidad;
        $product->update();
        return response()->json(['status' => true]);
    }

    public function delete(ProductoReabastecimiento $producto){
        $producto->delete();
        // Falta Descontar del inventario
        return response()->json(['deleted' => true]);
    }

    public function get(){
        return response()->json(['reabastecimientos' => ProductoReabastecimiento::with('producto')->get()]);
    }
}
