<?php

namespace App\Http\Controllers;

use App\Models\PlanesEntrenamientoModel;
use Illuminate\Http\Request;

class PlanesEntrenamientoController extends Controller
{
    public function listarPlanes()
    {
        $planes =  PlanesEntrenamientoModel::all();
        return response()->json([
            'status' => 'ok',
            'planes' => $planes
        ]);
    }

    public function crearPlan(Request $request)
    {
        $data = $request->validate([
            'id_ciclista'  => 'required|exists:ciclista,id',
            'nombre'       => 'required|string|max:100',
            'descripcion'  => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'required|date|after_or_equal:fecha_inicio',
            'objetivo'     => 'nullable|string|max:150',
            'activo'       => 'boolean'
        ]);

        $plan = PlanesEntrenamientoModel::create($data);

        return response()->json([
            'status' => 'ok',
            'accion' => 'plan creado'
        ]);
    }

    public function modificarPlan($id, Request $request)
    {
        $plan = PlanesEntrenamientoModel::findOrFail($id);

        $data = $request->validate([
            'nombre'       => 'sometimes|required|string|max:100',
            'descripcion'  => 'nullable|string',
            'fecha_inicio' => 'sometimes|required|date',
            'fecha_fin'    => 'sometimes|required|date|after_or_equal:fecha_inicio',
            'objetivo'     => 'nullable|string|max:150',
            'activo'       => 'boolean'
        ]);

        $plan->update($data);

        return response()->json([
            'status' => 'ok',
            'accion' => 'plan modificado',
        ]);
    }

    public function eliminarPlan($id)
    {
        $plan = PlanesEntrenamientoModel::findOrFail($id);

        $plan->delete();

        return response()->json([
            'status' => 'ok',
            'accion' => 'plan eliminado',
        ]);
    }
}

