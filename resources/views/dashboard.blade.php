@extends('layouts.app')
@section('title', 'Panel')
@section('content')
    <h1>Panel de usuario</h1>
    <p>Bienvenido, {{ auth()->user()->name }}</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
@endsection
