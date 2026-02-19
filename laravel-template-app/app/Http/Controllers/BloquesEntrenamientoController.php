<?php

namespace App\Http\Controllers;
use App\Models\BloquesEntrenamientoModel;

use Illuminate\Http\Request;

class BloquesEntrenamientoController extends Controller
{
    public function listarBloques()
    {
        $bloques = BloquesEntrenamientoModel::all();

        return response()->json([
            'status' => 'ok',
            'bloques' => $bloques
        ]);
    }

    public function crearBloque(Request $request)
    {
        //recogemos datos del request sin validar;
        
        $datos = $request->all();
        
        $bloque = BloquesEntrenamientoModel::create($datos);

        //Bucar el que ha creado
        $bloqueCreado = BloquesEntrenamientoModel::find($bloque->id);

        return response()->json([
            'status' => 'ok',
            'accion' => 'bloque creado',
            'bloque' => $bloqueCreado
        ]);
    }

    public function listarBloqueID($id)
    {
        $bloque = BloquesEntrenamientoModel::findOrFail($id);

        return response()->json([
            'status' => 'ok',
            'bloque' => $bloque
        ]);
    }

    public function eliminarBloque($id)
    {
        $bloque = BloquesEntrenamientoModel::findOrFail($id);
        $bloque->delete();

        return response()->json([
            'status' => 'ok',
            'accion' => 'eliminado correctamente'
        ]);
    }
}
