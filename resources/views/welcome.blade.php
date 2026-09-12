@extends('layouts.app')
@section('content')
    <p>Bienvenido</p>
    <p>
        <a href="{{ route('login') }}">Iniciar sesión</a> |
        <a href="{{ route('register') }}">Registrarse</a>
    </p>
@endsection
