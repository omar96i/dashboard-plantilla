<?php

namespace App\Models\Cotizaciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionFile extends Model
{
    use HasFactory;
    protected $table = 'cotizacion_files';

    protected $fillable = [
        'cotizacion_id',
        'file'
    ];

    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
    }
}
