<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesionesBloquesEntrenamientoController extends Controller
{
    public function listarSesionesBloques()
    {
        $sesionesBloques = SesionesBloquesEntrenamiento::all();

        return response()->json([
            'status' => 'ok',
            'sesiones-Bloques' => $sesionesBloques
        ]);
    }

    public function crearSesionBloque(Request $request)
    {
        $datos = $request->validate([
            'id_sesion_entrenamiento' => 'required|integer|exists:sesion_entrenamiento,id',
            'id_bloque_entrenamiento' => 'required|integer|exists:bloque_entrenamiento,id',
            'orden' => 'required|integer|min:1',
            'repeticiones' => 'nullable|integer|min:1',
        ]);

        $sesionBloque = SesionesBloquesEntrenamiento::create($datos);
        
        return response()->json([
            'status' => 'ok',
            'accion' => 'sesion-bloque creado'

        ]);
    }

    public function borrarSesionBloque($id)
    {
        $sesionBloque = SesionesBloquesEntrenamiento::findOrFail($id);
        $sesionBloque->delete();

        return response()->json([
            'status' => 'ok',
            'accion' => 'sesion-bloque borrado'
        ]);
    }
}

