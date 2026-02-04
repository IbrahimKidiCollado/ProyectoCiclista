<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloquesEntrenamientoModel extends Model
{
    protected $table = 'bloque_entrenamiento';

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

    public $timestamps = false;
}
