<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BloquesEntrenamientoModel extends Model
{


    protected $table = 'bloque_entrenamiento';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
        'duracion_estimada',
        'potencia_pct_min',
        'potencia_pct_max',
        'pulso_pct_max',
        'pulso_reserva_pct',
        'comentario'
    ];

    //Un bloque puede pertenecer a muchas sesiones de entrenamiento
    public function sesiones()
    {
        return $this->belongsToMany(
            SesionesEntrenamiento::class,
            'sesion_bloque',   
            'id_bloque',       
            'id_sesion'       
        );
    }
}
