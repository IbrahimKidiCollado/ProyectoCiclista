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
            'listado de sesiones'
        ]);
    }

    public function crearsesion(Request $request)
    {
        $datos = $request->validate([
            'id_plan' => 'required|integer|exists:plan_entrenamiento,id',
            'fecha' => 'required|date',
            'nombre' => 'nullable|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'completada' => 'boolean'
        ]);

        $sesion = SesionesEntrenamientoModel::create($datos);

        return response()->json([
            'status' => 'ok',
            'accion' => 'sesion creada correctamente'
        ]);
    }

    public function listarsesionID($id)
    {
        $sesion = SesionesEntrenamientoModel::findOrFail($id);
        return response()->json([
            'status' => 'ok',
            'sesion: ' => $sesion
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


