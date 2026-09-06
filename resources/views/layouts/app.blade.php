<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Aplicación</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; }
        nav { background: #333; padding: 15px; }
        nav a { color: white; text-decoration: none; margin-right: 15px; }
        .container { width: 100%; max-width: 500px; margin: 50px auto; background: white; padding: 30px; border-radius: 8px; }
        input { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 20px; background: #333; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: #c0392b; margin-bottom: 10px; }
        .success { color: #27ae60; margin-bottom: 15px; }
    </style>
</head>
<body>
<nav>
    @guest
        <a href="{{ route('login') }}">Iniciar sesión</a>
        <a href="{{ route('register') }}">Registrarse</a>
    @endguest
    @auth
        <span style="color: white;">Hola, {{ Auth::user()->nombre }}</span>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    @endauth
</nav>
<div class="container">
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @yield('content')
</div>
</body>
</html>
