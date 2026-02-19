<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResultadosModel;


class ResultadosEntrenamientoController extends Controller
{
    public function listarResultados()
    {
        // Cargamos los resultados con sus relaciones 
        $resultados = ResultadosModel::with(['ciclista', 'sesion'])->get();

        // Transformamos la colección para el Frontend
        $datosFormateados = $resultados->map(function ($item) {
            return [
                'ID'                => $item->id,
                'Ciclista'          => ($item->ciclista->nombre ?? '') . ' ' . ($item->ciclista->apellidos ?? ''),
                'Sesion_Planificada'=> $item->sesion->nombre ?? 'Salida Libre', 
                'Fecha'             => $item->fecha,
                'Duracion'          => $item->duracion_real,
                'Distancia_KM'      => $item->distancia_total,
                'Vatios_Medios'     => $item->potencia_media,
                'Pulso_Medio'       => $item->pulso_medio,
                'Esfuerzo_RPE'      => $item->esfuerzo_percibido,
                'Comentario'        => $item->comentarios_post_entreno,
            ];
        });

        return response()->json([
            'status' => 'ok',
            'resultados' => $datosFormateados 
        ]);
    }
    public function crearResultado(Request $request)
    {
        //validamos y creamos el resultado
        $resultado = $request->validate([
            'id_sesion' => 'required|integer|exists:sesion_entrenamiento,id',
            'id_ciclista' => 'required|integer|exists:ciclistas,id',
            'distancia' => 'required|numeric|min:0',
            'duracion' => 'required|numeric|min:0',
            'velocidad_media' => 'required|numeric|min:0',
            'calorias_quemadas' => 'required|numeric|min:0'
        ]);

        $resultado = ResultadosModel::create($resultado);

        return response()->json($resultado, 201);
    }

    public function listarResultadoID($id)
    {
        $resultado = ResultadosModel::findorFail($id);

        return response()->json($resultado);
    }
}

