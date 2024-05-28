@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Mercado Local
@endsection

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Editar Mercado</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>

    <section>
        <div class="w-72 h-96 mx-auto mt-16">

            <div class="text-center">
                <h1 class="text-3xl font-bold text-red-700">Editor de Mercado</h1>
                <h3 class="text-sm mt-2">{{ old('nombre', $mercadoLocal?->nombre) }} <span class="font-bold">ID: #{{ old('ROL', $mercadoLocal?->id) }}</span></h3>
            </div>
            <form method="POST" action="{{ route('mercado-locals.update', $mercadoLocal->id) }}"  role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf

                <div class="mt-20 space-y-4">


<!--
                <div class="flex justify-between">
                    <label for="imagen_referencia" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative">
                        <span class="text-gray-400 text-xs">Imagen del mercado</span>
                        <input required type="file" name="imagen_referencia" class="hidden border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('imagen_referencia') is-invalid @enderror" value="{{ old('imagen_referencia', $mercadoLocal?->imagen_referencia) }}" id="imagen_referencia" placeholder="Imagen Referencia">
                        {!! $errors->first('imagen_referencia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                    </label>
                </div>
            -->


                <div class="flex justify-center">

                    <input required type="text" name="nombre" class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $mercadoLocal?->nombre) }}" id="nombre" placeholder="Nombre Registrado del Mercado">
                    {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>


                <div class="flex justify-center">

                    <input required type="text" name="municipio" class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('municipio') is-invalid @enderror" value="{{ old('municipio', $mercadoLocal?->municipio) }}" id="municipio" placeholder="Municipio Ubicado">
                    {!! $errors->first('municipio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="flex justify-center">

                    <input required type="text" name="ubicacion" class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('ubicacion') is-invalid @enderror" value="{{ old('ubicacion', $mercadoLocal?->ubicacion) }}" id="ubicacion" placeholder="Ubicacion Especifica del Mercado">
                    {!! $errors->first('ubicacion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="flex justify-center">
                    <span class="text-xs text-gray-400 px-6">Hora de Entrada</span>
                    <span class="px-6 text-xs text-gray-400">Hora de Salida</span>
                </div>
                <div class="flex justify-center">

                    <input required type="time" name="horaentrada" class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('horaentrada') is-invalid @enderror" value="{{ old('horaentrada', $mercadoLocal?->horaentrada) }}" id="horaentrada" placeholder="Horaentrada">
                    {!! $errors->first('horaentrada', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

                    <input required type="time" name="horasalida" class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-4000 form-control @error('horasalida') is-invalid @enderror" value="{{ old('horasalida', $mercadoLocal?->horasalida) }}" id="horasalida" placeholder="Horasalida">
                    {!! $errors->first('horasalida', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="flex justify-center">
                    <span class="text-xs text-gray-400 px-6">Descripcion del Mercado</span>

                </div>
                <div class="flex justify-center">
                    <textarea required name="descripcion" class="border-1 rounded-lg border w-80 h-24 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('descripcion') is-invalid @enderror"  id="descripcion" >{{ old('descripcion', $mercadoLocal?->descripcion) }}
                    </textarea>
                    {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>


            <div class="flex justify-center mt-2 mb-20">

                <div class="flex justify-center ">
                    <button class="bg-red-500 px-5 text-white py-1 rounded mt-4" type="submit" class="btn btn-primary">{{ __('Submit') }}</button>

                </div>

            </div>
        </form>

             <!-- <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
                <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                    <div class="flex items-center  ">
                        <a href="./UserHome"><img class="w-6" src="{{ asset('imgs/HomeIcon.png') }}" alt="User Icon"></a>
                    </div>

                    <div class="flex items-center">
                        <a href="./UserCarritoGeneral"  class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/CarritoSelectedIcon.png') }}" alt="User Icon"></a>
                    </div>

                    <div class="flex items-center">
                        <a href="./UserEstadoPedidos"><img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
                        <a href="./UserEditarPerfil"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                    </div>
                </div>

            </div> -->
        </div>
    </section>


</body>
</html>
@endsection
