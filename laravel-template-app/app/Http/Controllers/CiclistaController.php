<?php

namespace App\Http\Controllers;

use App\Models\CiclistaModel;
use Illuminate\Http\Request;

class CiclistaController extends Controller
{
    public function listarCiclistas()
    {
        $ciclistas = CiclistaModel::all();

        return response()->json([
            'accion' => 'acceder a los ciclistas',
            'status' => 'ok',
            'ciclistas' =>$ciclistas
        ]);
    }

    public function listarCiclistaID(Request $request, $id)
    {
        $ciclista = CiclistaModel::find($id);

        return response()->json([
            'accion' => 'acceder a los ciclistas',
            'status' => 'ok',
            'ciclista' =>$ciclista
        ]);
    }
}

