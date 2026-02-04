<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesionesEntrenamiento;


class SesionesEntrenamientoController extends Controller
{
    public function listarsesiones()
    {
        $sesiones = SesionesEntrenamiento::all();

        return response()->json([
            'status' => 'ok',
            'listado de sesiones'
        ]);
    }

    public function crearsesion(Request $request)
    {
        $sesion = SesionesEntrenamiento::create($request->all());

        return response()->json([
            'accion' => 'sesion creada correctamente'
        ]);
    }

    public function listarsesionID($id)
    {
        $sesion = SesionesEntrenamiento::findOrFail($id);
        return response()->json([
            'accion' => 'ver sesion',
            'sesion: ' => $sesion
        ]);
    }

    public function eliminarsesion($id)
    {

        $sesion = SesionesEntrenamiento::findOrFail($id);
        $sesion->delete();

        return response()->json([
            'accion' => 'sesion eliminada correctamente'
        ]);
    }
}


