<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesionesEntrenamientoController extends Controller
{
    public function listarsesiones()
    {
        return response()->json([
            'accion' => 'listar sesiones'
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


