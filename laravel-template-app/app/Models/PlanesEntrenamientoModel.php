<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanesEntrenamientoModel extends Model
{
    protected $table = 'plan_entrenamiento';

    public $timestamps = false;

    protected $fillable = [
        'id_ciclista',
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'objetivo',
        'activo'
    ];

    //Un plan pertenece a un ciclista
     
    public function ciclista()
    {
        return $this->belongsTo(
            CiclistaModel::class,
            'id_ciclista'
        );
    }

    //Un plan tiene muchas sesiones de entrenamiento
    public function sesiones()
    {
        return $this->hasMany(
            SesionesEntrenamiento::class,
            'id_plan'
        );
    }
}
