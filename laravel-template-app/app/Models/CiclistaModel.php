<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ± IMPORTANTE
use Illuminate\Database\Eloquent\Model;

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
            HistoricoCiclista::class,
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
