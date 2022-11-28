<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categorias';
    protected $softDelete = true;

    protected $fillable = [
        'nombre'
    ];

    public function productos(){
        return $this->hasMany(Producto::class);
    }

    public function productos_aux(){
        return $this->hasMany(ProductoCategoria::class, 'categoria_id');
    }
}
