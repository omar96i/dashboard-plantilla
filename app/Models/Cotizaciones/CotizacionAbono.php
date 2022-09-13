<?php

namespace App\Models\Cotizaciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cotizaciones\Cotizacion;

class CotizacionAbono extends Model
{
    use HasFactory;

    protected $table = 'cotizacion_abonos';

    protected $fillable = [
        'cotizacion_id',
        'nombre',
        'fecha',
        'valor',
        'observacion',
        'credito',
        'dias'
    ];

    // Relaciones start

    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
    }

    // Relaciones end

}
