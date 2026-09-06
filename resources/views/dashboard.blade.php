@extends('layouts.app')
@section('content')
    <h1>Panel de usuario</h1>
    <p>Bienvenido, {{ Auth::user()->nombre }}.</p>
    <p>Has iniciado sesión correctamente.</p>
@endsection
