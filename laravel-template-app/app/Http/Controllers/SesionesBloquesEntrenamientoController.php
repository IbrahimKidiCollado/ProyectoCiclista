<?php

namespace App\Http\Controllers;
use App\Models\SesionesBloquesEntrenamientoModel;

use Illuminate\Http\Request;

class SesionesBloquesEntrenamientoController extends Controller
{
   public function listarSesionesBloques()
    {
        // Obtenemos los datos incluyendo la información de las tablas relacionadas
        $sesionesBloques = SesionesBloquesEntrenamientoModel::with(['sesion', 'bloque'])->get();

        // Reestructuramos la colección para el Frontend
        $datosFormateados = $sesionesBloques->map(function ($item) {
            return [
                'ID'         => $item->id,
                'Sesión'     => $item->sesion->nombre ?? 'Sin nombre', 
                'Bloque'     => $item->bloque->nombre ?? 'Sin nombre',
                'Orden'      => $item->orden,
                'Repeticiones' => $item->repeticiones ?? 0,
            ];
        });

        return response()->json([
            'status' => 'ok',
            'sesionesBloques' => $datosFormateados 
        ]);
    }

    public function crearSesionBloque(Request $request)
    {
        $datos = $request->all();

        $sesionBloque = SesionesBloquesEntrenamientoModel::create($datos);
        
        return response()->json([
            'status' => 'ok',
            'accion' => $sesionBloque

        ]);
    }

    public function borrarSesionBloque($id)
    {
        $sesionBloque = SesionesBloquesEntrenamientoModel::findOrFail($id);
        $sesionBloque->delete();

        return response()->json([
            'status' => 'ok',
            'accion' => 'sesion-bloque borrado'
        ]);
    }
}

