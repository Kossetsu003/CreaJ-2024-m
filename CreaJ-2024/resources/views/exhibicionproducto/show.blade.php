@extends('layouts.app')

@section('template_title')
    {{ $exhibicionproducto->name ?? __('Show') . " " . __('Exhibicionproducto') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Exhibicionproducto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('exhibicionproductos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Imagen:</strong>
                            {{ $exhibicionproducto->Imagen }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $exhibicionproducto->Nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Descripcion:</strong>
                            {{ $exhibicionproducto->Descripcion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Precio:</strong>
                            {{ $exhibicionproducto->Precio }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fk Vendedors:</strong>
                            {{ $exhibicionproducto->fk_vendedors }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Estado:</strong>
                            {{ $exhibicionproducto->Estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
