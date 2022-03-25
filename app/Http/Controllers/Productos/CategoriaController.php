<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use App\Models\Productos\Categoria;
use App\Models\Productos\Producto;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function store(Request $request){
        $categoria = new Categoria($request->all());
        $categoria->save();
        return response()->json(['saved' => true, 'categoria' => $categoria]);
    }

    public function get(){
        return response()->json(['categorias' => Categoria::get()]);
    }

    public function getCategoria(Categoria $categoria){
        return response()->json(['categoria' => $categoria]);
    }

    public function update(Categoria $categoria, Request $request){
        $categoria->update($request->all());
        $categoria->save();
        return response()->json(['saved' => true]);
    }

    public function delete(Categoria $categoria){
        $productos = Producto::where('categoria_id', $categoria->id)->update(['categoria_id' => null]);
        $categoria->delete();
        return response()->json(['deleted' => true]);
    }
}
