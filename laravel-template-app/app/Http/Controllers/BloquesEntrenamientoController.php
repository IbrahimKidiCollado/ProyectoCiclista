<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BloquesEntrenamientoController extends Controller
{
    public function listarBloques()
    {
        return response()->json([
            'accion' => 'listar bloques',
            'status' => 'ok'
        ]);
    }

    public function crearBloque(Request $request)
    {
        return response()->json([
            'accion' => 'crear bloque',
            'status' => 'ok'
        ]);
    }

    public function listarBloqueID($id)
    {
        return response()->json([
            'accion' => 'ver bloque',
            'id' => $id
        ]);
    }

    public function eliminarBloque($id)
    {
        return response()->json([
            'accion' => 'eliminar bloque',
            'id' => $id
        ]);
    }
}
