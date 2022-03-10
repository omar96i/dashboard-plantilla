<?php

namespace App\Models\Cotizaciones;

use App\Models\Cotizaciones\SubCotizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCotizacionObservacion extends Model
{
    use HasFactory;

    protected $table = 'sub_cotizacion_observaciones';

    protected $fillable = [
        'sub_cotizacion_id',
        'descripcion'
    ];

    // Relaciones start

    public function subCotizacion(){
        return $this->belongsTo(SubCotizacion::class, 'sub_cotizacion_id');
    }

    // Relaciones end

}
