<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SesionesEntrenamientoModel extends Model
{
    protected $table = 'sesion_entrenamiento';

    protected $fillable = [
        'id_plan',
        'fecha',
        'nombre',
        'descripcion',
        'completada'
    ];

    public $timestamps = false;
}
