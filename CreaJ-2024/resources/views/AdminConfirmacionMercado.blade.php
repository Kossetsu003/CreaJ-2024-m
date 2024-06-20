@extends('layouts.app')

@section('content')
    <div>
        <h1>Datos del Mercado</h1>
        <p><strong>Usuario:</strong> {{ $usuario }}</p>
        <p><strong>Contraseña:</strong> {{ $contrasena }}</p>
    </div>

    <a href="{{ route('admin-mercado-locals.index') }}">CONTINUAR</a>
@endsection
