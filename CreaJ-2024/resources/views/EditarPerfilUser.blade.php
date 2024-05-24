@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Cliente
@endsection

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Producto Editar</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>

    <section>
        <div class="w-72 h-auto mx-auto mt-[15%] mb-[7em]">


            <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
                <!--INICIO DE NAVBAR MOBIL-->
                <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                    <div class="flex items-center">
                        <a href="./HomeUser"><img class="w-6" src="{{ asset('imgs/HomeIcon.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
                        <a href="./CarritoGeneralUser"><img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
                        <a href="./EstadoPedidosUser"><img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="User Icon"></a>
                    </div>
                    <div class="flex items-center">
                        <a href="./EditarPerfilUser"  class="bg-white rounded-full p-[0.25rem]"><img class="w-6" src="{{ asset('imgs/UserSelectedIcon.png') }}" alt="User Icon"></a>
                    </div>
                </div>
                <!--FIN DE NAVBAR MOBIL-->
            </div>


            <!--Contenedor Principal-->
            <div class="text-center">
                <!--Contenedor Mini Shop-->
                <h1 class="text-[50px] font-bold">Editar<span class="text-purple-400 font-bold m-2">Perfil</span></h1>
            </div>

              <form method="POST" action="{{ route('clientes.update', $cliente->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                @csrf

                <div class="flex flex-col mt-6">
                            <!--Contenedor De Inputs-->

                    <!--ROL ES INVISIBLE-->
                        <input type="hidden" name="ROL" placeholder="Rol" value="4" id="r_o_l" class="form-control @error('ROL') is-invalid @enderror">
                        {!! $errors->first('ROL', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    <!--FIN DEL ROL-->


                    <div class="flex justify-center">
                       <input required type="email" name="usuario" id="usuario" placeholder="Ingrese su Correo Electrónico" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control @error('usuario') is-invalid @enderror" value="{{ old('usuario', $cliente?->usuario) }}">
                        {!! $errors->first('usuario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                    <div class="flex justify-center mt-2">
                        <input required type="text" name="nombre" id="nombre" placeholder="Ingrese sus Nombres" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $cliente?->nombre) }}">
                         {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                    <div class="flex justify-center mt-2">
                        <input required type="text" name="apellido" id="apellido" placeholder="Ingrese su Apellido" class=" border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control @error('apellido') is-invalid @enderror" value="{{ old('apellido', $cliente?->apellido) }}" >
                        {!! $errors->first('apellido', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                    <div class="flex justify-center mt-2">
                          <input required type="text" name="telefono" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $cliente?->telefono) }}" id="telefono" placeholder="Ingrese su Número de Teléfono">
                        {!! $errors->first('telefono', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                    <div class="flex justify-center mt-2">
                        <select name="sexo" id="sexo" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 text-gray-400 form-control @error('sexo') is-invalid @enderror" required>
                            <option value="{{ old('sexo', $cliente?->sexo) }}" class="">Escoga su Género</option>
                            <option value="Masc">Género: Masculino</option>
                            <option value="Fem">Género: Femenino</option>
                        </select>
                        {!! $errors->first('sexo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                    <div class="flex justify-center mt-2">
                         <input required type="password"  name="contrasena" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control @error('contrasena') is-invalid @enderror" value="{{ old('contrasena', $cliente?->contrasena) }}" id="contrasena" placeholder="Escriba su Contraseña">
                        {!! $errors->first('contrasena', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                    </div>
                    <div class="flex justify-center mt-2">
                       <input required type="password" name="confirmar_contrasena" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 form-control" id="confirmar_contrasena" placeholder="Escriba de nuevo su Contraseña">
                    </div>
                </div>

                <div class="flex justify-center py-5">
                    <button type="submit" class="btn btn-primary bg-purple-400 w-72 h-10 flex items-center justify-center gap-x-2 rounded-md px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-purple-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-opacity-50">Actualizarse</button>
                </div>

            </form>
            


        </div>
    </section>
</body>
</html>
@endsection
