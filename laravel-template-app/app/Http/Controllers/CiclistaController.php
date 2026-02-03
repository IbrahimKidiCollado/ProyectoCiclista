<?php

namespace App\Http\Controllers;

use App\Models\CiclistaModel;
use Illuminate\Http\Request;

class CiclistaController extends Controller
{
    public function listarCiclistas()
    {
        $ciclistas = CiclistaModel::all();

        return response()->json($ciclistas);
    }

    public function listarCiclistaID($id)
    {
        $ciclista = CiclistaModel::find($id);

        return response()->json($ciclista);
    }
}

