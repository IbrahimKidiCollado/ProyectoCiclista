<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [

    // AUTH
    '/login',
    '/logout',
    '/register',
    '/usuario-sesion',

    // BLOQUES
    '/bloque/crear',
    '/bloque/*/eliminar',

    // PLANES
    '/plan/crear',
    '/plan/*',

    // SESIONES
    '/sesion/crear',
    '/sesion/*',

    // RESULTADOS
    '/resultado/crear',

    // SESION-BLOQUE
    '/sesionbloque/crear',
    '/sesionbloque/*',

    '/sesiones',
    '/sesion/*',
];

}
