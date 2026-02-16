<?php

namespace App\Http\Controllers;

use App\Models\CiclistaModel;
use Illuminate\Http\Request;
use App\Models\HistoricoCiclistaModel;

class CiclistaController extends Controller
{
    public function listarCiclistas()
    {
        $ciclistas = CiclistaModel::all();

        return response()->json([
            'status' => 'ok',
            'ciclistas' =>$ciclistas
        ]);
    }

    public function listarCiclistaID(Request $request, $id)
    {
        $ciclista = CiclistaModel::find($id);
        $historial = $ciclista->historicos;


        return response()->json([
            'status' => 'ok',
            'historial' =>$historial
        ]);
    }
}

