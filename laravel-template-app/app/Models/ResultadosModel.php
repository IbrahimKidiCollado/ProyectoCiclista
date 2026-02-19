<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\CiclistaModel;
use App\Models\SesionesEntrenamientoModel;

class ResultadosModel extends Model
{
    protected $table = 'resultados';

    protected $primaryKey = 'id_resultado';

    public $timestamps = false;
    
    protected $fillable = [
        'id_sesion',
        'id_ciclista',
        'distancia',
        'duracion',
        'velocidad_media',
        'calorias_quemadas'
    ];

    // Relaciones
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