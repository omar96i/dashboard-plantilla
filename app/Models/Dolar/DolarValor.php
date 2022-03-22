<?php

namespace App\Models\Dolar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DolarValor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dolar_valores';
    protected $softDelete = true;

    protected $fillable = [
        'unidad',
        'valor',
        'vigencia_desde',
        'vigencia_hasta'
    ];
}
