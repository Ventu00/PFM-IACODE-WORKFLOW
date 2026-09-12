@extends('layouts.app')
@section('title', 'Registro')
@section('content')
    <h1>Crear una cuenta</h1>
    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div>
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required maxlength="100" autocomplete="name">
        </div>
        <div>
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email">
        </div>
        <div>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required minlength="12" autocomplete="new-password">
        </div>
        <div>
            <label for="password_confirmation">Confirmar contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required minlength="12" autocomplete="new-password">
        </div>
        <button type="submit">Registrarme</button>
    </form>
    <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Iniciar sesión</a></p>
@endsection
