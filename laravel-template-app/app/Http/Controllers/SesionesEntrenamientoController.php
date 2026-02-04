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
        return response()->json([
            'accion' => 'crear sesion'
        ]);
    }

    public function listarsesionID($id)
    {
        return response()->json([
            'accion' => 'ver sesion',
            'id' => $id
        ]);
    }

    public function eliminarsesion($id)
    {
        return response()->json([
            'accion' => 'eliminar sesion',
            'id' => $id
        ]);
    }
}


