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

    public function listarPlanID($id)
    {
        $plan = PlanesEntrenamientoModel::findOrFail($id);
        return response()->json([
            'status' => 'ok',
            'plan' => $plan
        ]);
    }

    public function crearPlan(Request $request)
    {
        $data = $request->all();   
        $plan = PlanesEntrenamientoModel::create($data);

        return response()->json([
            'status' => 'ok',
            'accion' => $plan
        ]);
    }

    public function modificarPlan($id, Request $request)
    {
        $plan = PlanesEntrenamientoModel::findOrFail($id);

        $data = $request->all();

        $plan->update($data);

        return response()->json([
            'status' => 'ok',
            'accion' => $plan
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

