<?php

namespace App\Http\Controllers;
use App\Models\CiclistaModel;
use Illuminate\Http\Request;

class CiclistaController extends Controller
{
    public function listarCiclistas()
    {
        return response()->json([
            'accion' => 'listar ciclistas'
        ]);
    }
    public function listarCiclistaID()
    {
        return response()->json([
            'accion' => 'listar historial ciclista'
        ]);
    }
}
