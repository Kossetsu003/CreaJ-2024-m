@extends('layouts.app')

@section('template_title')
    {{ $vendedor->name ?? __('Show') . " " . __('Vendedor') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Vendedor</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('vendedors.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Usuario:</strong>
                            {{ $vendedor->usuario }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Rol:</strong>
                            {{ $vendedor->ROL }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Contrasena:</strong>
                            {{ $vendedor->contrasena }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $vendedor->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Apellidos:</strong>
                            {{ $vendedor->apellidos }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Telefono:</strong>
                            {{ $vendedor->telefono }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Numero Puesto:</strong>
                            {{ $vendedor->numero_puesto }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fk Mercado:</strong>
                            {{ $vendedor->fk_mercado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
