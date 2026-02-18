<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ± IMPORTANTE
use Illuminate\Database\Eloquent\Model;
use App\Models\HistoricoCiclistaModel;
use App\Models\PlanesEntrenamientoModel;


class CiclistaModel extends Model
{
    protected $table = 'ciclista';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'peso_base',
        'altura_base',
        'email',
        'password'
    ];
    //Para que no mande las contraseñas ni el id al hacer GET
    protected $hidden = [
        'id',
        'password'
    ];

    // Un ciclista tiene muchos entrenamientos
    public function entrenamientos()
    {
        return $this->hasMany(
            Entrenamiento::class,
            'id_ciclista'
        );
    }

    // Un ciclista tiene muchos históricos
    public function historicos()
    {
        return $this->hasMany(
            HistoricoCiclistaModel::class,
            'id_ciclista'
        );
    }

    // Un ciclista tiene muchos planes de entrenamiento
    public function planes()
    {
        return $this->hasMany(
            PlanEntrenamiento::class,
            'id_ciclista'
        );
    }


}
