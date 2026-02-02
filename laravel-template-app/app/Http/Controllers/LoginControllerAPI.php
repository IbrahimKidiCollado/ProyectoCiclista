<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginControllerAPI extends Controller
{
    public function comprobarCredenciales(Request $request)
    {
        return response()->json([
            'accion' => 'login',
            'status' => 'ok'
        ]);
    }

    public function cerrarSesion()
    {
        return response()->json([
            'accion' => 'logout',
            'status' => 'ok'
        ]);
    }

    public function darseAlta(Request $request)
    {
        return response()->json([
            'accion' => 'register',
            'status' => 'ok'
        ]);
    }
}
