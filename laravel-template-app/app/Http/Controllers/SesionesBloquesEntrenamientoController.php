<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesionesBloquesEntrenamientoController extends Controller
{
    public function listarSesionesBloques()
    {
        return response()->json([
            'accion' => 'listar sesiones-bloques'
        ]);
    }

    public function crearSesionBloque(Request $request)
    {
        return response()->json([
            'accion' => 'crear sesion-bloque'
        ]);
    }

    public function borrarSesionBloque($id)
    {
        return response()->json([
            'accion' => 'eliminar sesion-bloque',
            'id' => $id
        ]);
    }
}

