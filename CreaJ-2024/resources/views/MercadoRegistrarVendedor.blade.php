@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Vendedor
@endsection

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Registrar Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
   
    <section>
        <div class="w-72 h-96 mx-auto ">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-red-500">Registrar vendedor</h1>
            </div>


            <form method="POST" action="{{ route('vendedors.store') }}"  role="form" enctype="multipart/form-data">
            <div class="pb-[7rem] mt-10 space-y-4">

                    @csrf
                <!--<div class="flex justify-between">
                    <label for="file-input" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative">
                        <span class="text-gray-400">Foto del Vendedor</span>
                        <input id="file-input" type="file" class="hidden" required>
                        <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                    </label>
                </div-->
                <div class="flex justify-center">
                    <input required type="email" name="usuario" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('usuario') is-invalid @enderror" value="{{ old('usuario', $vendedor?->usuario) }}" id="usuario" placeholder="Escriba el correo electronico">
                    {!! $errors->first('usuario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

                <div class="flex justify-center">
                    <input type="text" name="contrasena" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('contrasena') is-invalid @enderror" value="{{ old('contrasena', $vendedor?->contrasena) }}" id="contrasena" placeholder="Escriba su Contrasena">
                    {!! $errors->first('contrasena', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

                </div>

                <div class="flex justify-center">
                    <input type="text" name="contrasena-comprobar" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('contrasena') is-invalid @enderror" value="{{ old('contrasena', $vendedor?->contrasena) }}" id="contrasena" placeholder="Escriba de nuevo su Contraseña">
                    {!! $errors->first('contrasena', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

                </div>
                <div class="pt-5 flex justify-center">
                    <input required type="text" name="nombre" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $vendedor?->nombre) }}" id="nombre" placeholder="Escriba el Nombre del Vendedor">
                    {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="flex justify-center">
                    <input type="text" name="apellidos" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos', $vendedor?->apellidos) }}" id="apellidos" placeholder="Escriba los Apellidos del Vendedor">
                    {!! $errors->first('apellidos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="flex justify-center">
                    <input type="text" name="telefono" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $vendedor?->telefono) }}" id="telefono" placeholder="Digite el Telefono del Vendedor">
                    {!! $errors->first('telefono', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="flex justify-center">
                    <input type="text" name="numero_puesto" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('numero_puesto') is-invalid @enderror" value="{{ old('numero_puesto', $vendedor?->numero_puesto) }}" id="numero_puesto" placeholder="Escriba el Numero Puesto">
                {!! $errors->first('numero_puesto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="flex justify-center">
                    <input type="text" name="fk_mercado" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('fk_mercado') is-invalid @enderror" value="{{ old('fk_mercado', $vendedor?->fk_mercado) }}" id="fk_mercado" placeholder="Fk Mercado">
            {!! $errors->first('fk_mercado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

                <div class="flex justify-center mt-16">
                    <button class="btn btn-primary bg-red-600 w-72 h-10 text-white font-bold rounded-md">Registrar Vendedor</button>
                </div>

            </div>
            </form>




                 <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
                    <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                    <div class="flex items-center  ">
                        <a href="{{ route('admin-mercado-locals.index') }}" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></a>
                    </div>

                    <div class="flex items-center">
                        <a href="{{ route('admin-vendedors.index') }}"><img class="w-6" src="{{ asset('imgs/VendedorIcon.png') }}" alt="User Icon"></a>
                    </div>

                    <div class="flex items-center">
                        <a href="{{ route('admin-clientes.index') }}" ><img class="w-6" src="{{ asset('imgs/ClienteIcon.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
                        <a href="./AdminEstadoPedidos" ><img class="w-6" src="{{ asset('imgs/ReservasIcon.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
    <?php $id = 1; ?>
                        <a href="{{ route('AdminProfileVista')}}"  ><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>

                    </div>
                    </div>
                </div>



            </div>
        </div>
    </section>

</body>
</html>
@endsection
