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
        $bloque = BloqueEntrenamiento::create($request->all());

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
