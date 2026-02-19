<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesionesEntrenamientoModel;


class SesionesEntrenamientoController extends Controller
{
    public function listarsesiones()
    {
        $sesiones = SesionesEntrenamientoModel::all();

        return response()->json([
            'status' => 'ok',
            'sesion' => $sesiones
        ]);
    }

    public function crearsesion(Request $request)
    {
        $datos = $request->all();

        $sesion = SesionesEntrenamientoModel::create($datos);

        return response()->json([
            'status' => 'ok',
            'accion' => $sesion
        ]);
    }

    public function listarsesionID($id)
    {
        $sesion = SesionesEntrenamientoModel::findOrFail($id);
        return response()->json([
            'status' => 'ok',
            'sesion' => $sesion
        ]);
    }

    public function eliminarsesion($id)
    {

        $sesion = SesionesEntrenamientoModel::findOrFail($id);
        $sesion->delete();

        return response()->json([
            'accion' => 'sesion eliminada correctamente'
        ]);
    }
}