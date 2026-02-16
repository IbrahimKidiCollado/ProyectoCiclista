<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoCiclistaModel extends Model
{
    protected $table = 'historico_ciclista';
    public $timestamps = false;

    protected $fillable = [
        'id_ciclista',
        'fecha',
        'peso',
        'altura',
        'ftp',
        'umbral_lactico',
        'fc_maxima',
        'fc_reposo'
    ];

    // Un histórico pertenece a un ciclista
    public function ciclista()
    {
        return $this->belongsTo(
            CiclistaModel::class,
            'id_ciclista'
        );
    }
    
    public function historicos()
    {
        return $this->hasMany(
            HistoricoCiclistaModel::class,
            'id_ciclista'
        );
    }

}

?>