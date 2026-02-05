<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    //Relacion entre sessionesBloqueEntrenamiento y sesionEntrenamiento
    public function sesion()
    {
        return $this->belongsTo(
            SesionEntrenamiento::class,
            'id_sesion_entrenamiento'
        );
    }

    //Relacion entre sessionesBloqueEntrenamiento y bloque
    public function bloque()
    {
        return $this->belongsTo(
            BloqueEntrenamiento::class,
            'id_bloque_entrenamiento'
        );
    }
}
