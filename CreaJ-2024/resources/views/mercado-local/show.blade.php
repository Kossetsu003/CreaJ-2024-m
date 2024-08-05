@extends('layouts.app')

@section('template_title')
    {{ $mercadoLocal->name ?? __('Show') . " " . __('Mercado Local') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Mercado Local</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('usuarios.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $mercadoLocal->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Rol:</strong>
                            {{ $mercadoLocal->ROL }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Imagen Referencia:</strong>
                            {{ $mercadoLocal->imagen_referencia }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Municipio:</strong>
                            {{ $mercadoLocal->municipio }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Ubicacion:</strong>
                            {{ $mercadoLocal->ubicacion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Horaentrada:</strong>
                            {{ $mercadoLocal->horaentrada }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Horasalida:</strong>
                            {{ $mercadoLocal->horasalida }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Descripcion:</strong>
                            {{ $mercadoLocal->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
