<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginControllerAPI extends Controller
{
    public function comprobarCredenciales(Request $request)
    {
        

        /*
        $request->validate([
            'email' => 'required|email',
            'pwd'   => 'required|string'
        ]);

        $ciclista = CiclistaModel::where('email', $request->email)->first();

        if (!$ciclista || !Hash::check($request->pwd, $ciclista->password)) {
            return back()->withErrors(['login' => 'Credenciales incorrectas']);
        }

        session([
            'ciclista_id' => $ciclista->id,
            'ciclista_nombre' => $ciclista->nombre
        ]);
        */

        return view('index');
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
