@extends('layouts.app')
@section('content')
    <h1>Crear una cuenta</h1>
    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
        @error('nombre') <div class="error">{{ $message }}</div> @enderror

        <label for="email">Correo electrónico</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password">
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <label for="password_confirmation">Confirmar contraseña</label>
        <input type="password" id="password_confirmation" name="password_confirmation">

        <button type="submit">Registrarse</button>
    </form>
    <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
@endsection
