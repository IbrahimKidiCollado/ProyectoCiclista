<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginControllerAPI extends Controller
{
    public function comprobarCredenciales(Request $request)
    {
        $email= 'ciclista@gmail.com';
        $pwd = 'ciclista';

        $emailAcomprobar = $request->input('email');
        $pwdAcomprobar = $request->input('pwd');

         if ($emailAcomprobar === $email && $pwdAcomprobar === $pwd) {
            return view('index');
        } else {
            return back()->with('error', 'Credenciales incorrectas');
        }

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
