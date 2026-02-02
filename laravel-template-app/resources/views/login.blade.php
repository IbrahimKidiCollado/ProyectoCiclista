<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | Entrenamientos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="login-container">
    <h1>Iniciar sesión</h1>

    <form id="loginForm" action="{{ route('login.comprobar') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="correo@ejemplo.com"
                required
            >
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                required
            >
        </div>

        <button type="submit" class="btn-login">
            Entrar
        </button>
    </form>

    <div class="extra-links">
        <p>
            ¿No tienes cuenta?
            <a href="/register">Regístrate</a>
        </p>
    </div>
</div>


</body>
</html>
