<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadosModel extends Model
{
    protected $table = 'resultados';


    protected $fillable = [
        'id_ciclista',
        'id_sesion',
        'fecha',
        'duracion_real',
        'distancia_total',
        'potencia_media',
        'pulso_medio',
        'calorias',
        'esfuerzo_percibido',
        'comentarios_post_entreno'
    ];

    public $timestamps = true;

    //relaciones

    public function ciclista()
    {
        return $this->belongsTo(CiclistaModel::class, 'id_ciclista');
    }

    public function sesion()
    {
        return $this->belongsTo(SesionesEntrenamientoModel::class, 'id_sesion');
    }
}


?>