@extends('layouts.app')
@section('title', 'Iniciar sesión')
@section('content')
    <h1>Iniciar sesión</h1>
    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <div>
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email">
        </div>
        <div>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required autocomplete="current-password">
        </div>
        <div>
            <label><input type="checkbox" name="remember" value="1"> Recordarme</label>
        </div>
        <button type="submit">Iniciar sesión</button>
    </form>
    <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Crear una cuenta</a></p>
@endsection
