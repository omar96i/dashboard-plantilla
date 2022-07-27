<?php

namespace App\Models\Proyectos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoInterventoriaFile extends Model
{
    use HasFactory;
    protected $table = 'proyecto_interventoria_files';

    protected $fillable = [
        'interventoria_id',
        'files'
    ];

    public function interventoria(){
        return $this->belongsTo(ProyectoInterventoria::class, 'interventoria_id');
    }
}
