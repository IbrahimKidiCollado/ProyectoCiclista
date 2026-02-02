<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanesEntrenamientoController extends Controller
{
    public function listarPlanes()
    {
        return response()->json([
            'accion' => 'listar planes'
        ]);
    }

    public function crearPlan(Request $request)
    {
        return response()->json([
            'accion' => 'crear plan'
        ]);
    }

    public function modificarPlan($id, Request $request)
    {
        return response()->json([
            'accion' => 'modificar plan',
            'id' => $id
        ]);
    }

    public function eliminarPlan($id)
    {
        return response()->json([
            'accion' => 'eliminar plan',
            'id' => $id
        ]);
    }
}

