<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultadosEntrenamientoController extends Controller
{
    public function crearResultado(Request $request)
    {
        return response()->json([
            'accion' => 'crear resultado'
        ]);
    }

    public function listarResultadoID($id)
    {
        return response()->json([
            'accion' => 'ver resultado',
            'id' => $id
        ]);
    }
}

