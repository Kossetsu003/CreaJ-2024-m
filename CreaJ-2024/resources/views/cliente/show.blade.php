@extends('layouts.app')

@section('template_title')
    {{ $cliente->name ?? __('Show') . " " . __('Cliente') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Cliente</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('clientes.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Rol:</strong>
                            {{ $cliente->ROL }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Usuario:</strong>
                            {{ $cliente->usuario }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Contrasena:</strong>
                            {{ $cliente->contrasena }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $cliente->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Apellido:</strong>
                            {{ $cliente->apellido }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Telefono:</strong>
                            {{ $cliente->telefono }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Sexo:</strong>
                            {{ $cliente->sexo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
