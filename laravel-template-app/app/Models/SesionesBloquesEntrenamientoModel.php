<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SesionesEntrenamientoModel;
use App\Models\BloquesEntrenamientoModel;

class SesionesBloquesEntrenamientoModel extends Model
{
    protected $table = 'sesion_bloque';

    protected $fillable = [
        'id_sesion_entrenamiento',
        'id_bloque_entrenamiento',
        'orden',
        'repeticiones'
    ];

    public $timestamps = false;

    // Relación con la Sesión
    public function sesion()
    {
        return $this->belongsTo(SesionesEntrenamientoModel::class, 'id_sesion_entrenamiento');
    }

    // Relación con el Bloque
    public function bloque()
    {
        return $this->belongsTo(BloquesEntrenamientoModel::class, 'id_bloque_entrenamiento');
    }
}