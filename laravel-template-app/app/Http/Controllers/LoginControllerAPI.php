<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginControllerAPI extends Controller
{
    public function comprobarCredenciales(Request $request)
    {
        $user="ciclista@prueba.com";
        $user2="test1@prueba.com";
        $pwd = "ciclista";
        $pwd2 = "prueba";

        $emailUsuario = $request->email;
        $pwdUsuario   = $request->pwd;

        if($emailUsuario != $user || $pwdUsuario != $pwd){
            return view('login');
        };

        return view('index');

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
