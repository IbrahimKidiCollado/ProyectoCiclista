<?php

namespace App\Models;

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

    //Relacion de una sesion con un Entrenamiento
    public function plan()
    {
        return $this->belongsTo(
            PlanEntrenamiento::class,
            'id_plan'
        );
    }
}
