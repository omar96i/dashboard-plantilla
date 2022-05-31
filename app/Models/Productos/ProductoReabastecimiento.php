<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoReabastecimiento extends Model
{
    use HasFactory;
    protected $table = 'productos_reabastecimientos';

    protected $fillable = [
        'producto_id',
        'cantidad'
    ];

    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }

}
