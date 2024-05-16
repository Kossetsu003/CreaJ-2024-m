<!--COSA QUE NO ENTIENDO PERO QUE ES NECESARIO-->
@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Mercado Local
@endsection

<!--FIN DEL ACOSA-->


<!--INICIO DEL CONTENIDO-->
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
    <title>Agregar Mercado Local</title>
</head>
<body>

    <section>
        <div class="w-72 h-auto mx-auto mt-16 pb-[4rem]">

             <!--INICIO DE NAVBAR MOBIL-->
            <div class="bottom-bar fixed bottom-[1%] left-0 right-0 flex justify-center">
                <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                    <div class="flex items-center  ">
                        <a href="./HomeUser"><img class="w-6" src="{{ asset('imgs/HomeIcon.png') }}" alt="User Icon"></a>
                    </div>

                    <div class="flex items-center">
                        <a href="./CarritoGeneralUser"  class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/CarritoSelectedIcon.png') }}" alt="User Icon"></a>
                    </div>

                    <div class="flex items-center">
                        <a href="./EstadoPedidosUser"><img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
                        <a href="./EditarPerfilUser"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                    </div>
                </div>

            </div>
             <!--FIN DE NAVBAR MOBIL-->


             <!--TITULO-->
            <div class="text-center">
                <h1 class="text-3xl font-bold text-purple-600">Agregar Mercado</h1>
                <h3 class="mt- "><b>LOCAL</b></h3>
            </div>
            <!--FIN DEL TITULO-->



            <!--INCIIO DEL FORM-->
            <form method="POST" action="{{ route('mercado-locals.store') }}"  role="form" enctype="multipart/form-data">
                @csrf
            <div class="mt-20 space-y-4">

                <!--INPUT DE NOMBRE-->
                <div class="flex justify-center">
                     <input
                        type="text"
                        name="nombre"
                        id="nombre"
                        placeholder="Nombre del Mercado"
                        required

                        class="
                        <?php //CLASE PARA LARAVEl?>
                        form-control @error('nombre') is-invalid @enderror
                        <?php //CLASE PARA TAILWIND?>
                        border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400"

                        value="{{ old('nombre', $mercadoLocal?->nombre) }}">
                        <!--POR SI NO AGARRA CREO*-->
                        {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <!--INPUT DE IMAGEN-->
                <div class="flex justify-between">
                    <!--EL LABEL ES NECESARIO PARA ACCEDER AL INPUT-->
                    <label for="imagen_referencia" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative">
                        <span>Imagen del mercado</span>
                        <input
                            type="file"
                            name="imagen_referencia"
                            accept=".png"
                            id="imagen_referencia"
                            placeholder="Imagen Referencia"
                            value="{{ old('imagen_referencia', $mercadoLocal?->imagen_referencia) }}"

                            class="
                            <?php //CLASE PARA LARAVEL?>
                            form-control @error('imagen_referencia') is-invalid @enderror
                            <?php //CLASE PARA TAILWIND?>
                            hidden"                           >

                            <!--POR SI NO AGARRA CREO*-->
                            {!! $errors->first('imagen_referencia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}


                        <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>

                    </label>
                </div>

                <!--INPUT DE MUNICIPIO-->
                <div class="flex justify-center">
                    <input
                        type="text"
                        name="municipio"
                        value="{{ old('municipio', $mercadoLocal?->municipio) }}"
                        id="municipio"
                        placeholder="Municipio"
                        required

                        class="
                        <?php //CLASE PARA LARAVEL?>
                        form-control @error('municipio') is-invalid @enderror
                        <?php //CLASE PARA TAILWIND?>
                        border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400">

                        <!--POR SI DA ERROR-->
                    {!! $errors->first('municipio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <!--INPUT DEUBICACION-->
                <div class="flex justify-center">
                    <input
                        type="text"
                        name="ubicacion"
                        id="ubicacion"
                        placeholder="Ubicacion"
                        value="{{ old('ubicacion', $mercadoLocal?->ubicacion) }}"
                        required

                        class="
                        form-control @error('ubicacion') is-invalid @enderror

                        border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400">
                    {!! $errors->first('ubicacion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="flex justify-center">
                    <h4 class="text-gray-600 text-xs px-4">Hora de Entrada :  </h4>
                    <h4 class="text-gray-600 text-xs px-4">Hora de Salida : </h4>
                </div>
                <div class="flex justify-center">

                    <!--INNPUT DE ENTRADA -->
                    <input
                        type="time"
                        name="horaentrada"
                        id="horaentrada"
                        placeholder="Horaentrada"
                        required
                        class="
                        border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400
                        form-control @error('horaentrada') is-invalid @enderror" value="{{ old('horaentrada', $mercadoLocal?->horaentrada) }}">
                    {!! $errors->first('horaentrada', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

                    <!--INPUT DE SALIDA-->
                    <input
                        type="time"
                        name="horasalida"
                        id="horasalida"
                        placeholder="Horasalida"
                        value="{{ old('horasalida', $mercadoLocal?->horasalida) }}"
                        required

                        class="
                        border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400

                        form-control @error('horasalida') is-invalid @enderror">
                    {!! $errors->first('horasalida', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="flex justify-center">
                    <span class="text-gray-600 text-xs px-4" >Descripcion</span>
                </div>
                <div class="flex justify-center">

                    <textarea
                        name="descripcion"
                        rows="3"
                        id="descripcion"

                        class="
                            border-1 rounded-lg border w-80 h-24 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 resize-none

                            form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $mercadoLocal?->descripcion) }}</textarea>
                {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>

            <div class="flex justify-center mt-10">
                <button
                    type="submit"
                    class="
                        btn btn-primary

                        bg-purple-500 w-72 h-10 flex items-center  justify-center gap-x-2 rounded-md px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-purple-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-opacity-50">
                    {{ __('Publicar Mercado') }}
                </button>
            </div>
        </form>
            <!--FIN DEL FORM-->




        </div>
    </section>


</body>
</html>
<!--FIN DEL CONTENIDO-->
@endsection
