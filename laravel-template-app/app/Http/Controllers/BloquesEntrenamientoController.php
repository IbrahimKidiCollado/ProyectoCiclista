<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BloquesEntrenamientoController extends Controller
{
    public function listarBloques()
    {
        $bloques = BloqueEntrenamiento::all();

        return response()->json([
            'status' => 'ok',
            'listado de bloques: ' => $bloques
        ]);
    }

    public function crearBloque(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'tipo' => 'required|string|in:rodaje,intervalos,recuperacion',
            'duracion_estimada' => 'required|date_format:H:i:s',
            'potencia_pct_min' => 'required|integer|min:0|max:100',
            'potencia_pct_max' => 'required|integer|min:0|max:100|gte:potencia_pct_min',
            'pulso_pct_max' => 'nullable|integer|min:0|max:100',
            'pulso_reserva_pct' => 'nullable|integer|min:0|max:100',
            'comentario' => 'nullable|string'
        ]);
        $bloque = BloqueEntrenamiento::create($datos);

        return response()->json([
            'status' => 'ok',
            'accion' => 'bloque creado'
        ]);
    }

    public function listarBloqueID($id)
    {
        $bloque = BloqueEntrenamiento::findOrFail($id);

        return response()->json([
            'status' => 'ok',
            'bloque: ' => $bloque
        ]);
    }

    public function eliminarBloque($id)
    {
        $bloque = BloqueEntrenamiento::findOrFail($id);
        $bloque->delete();

        return response()->json([
            'status' => 'ok',
            'accion' => 'eliminado correctamente'
        ]);
    }
}
