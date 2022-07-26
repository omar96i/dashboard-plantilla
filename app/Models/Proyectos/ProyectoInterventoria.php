<?php

namespace App\Models\Proyectos;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProyectoInterventoria extends Model
{
    use HasFactory;

    protected $table = 'proyecto_interventorias';

    protected $fillable = [
        'proyecto_id',
        'usuario_id',
        'fecha_inicio',
        'hora_inicio',
        'fecha_final',
        'hora_final',
        'checkout_1',
        'descripcion_1',
        'checkout_2',
        'descripcion_2',
        'firma_cliente',
        'firma_operario'
    ];

    public function proyecto(){
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
