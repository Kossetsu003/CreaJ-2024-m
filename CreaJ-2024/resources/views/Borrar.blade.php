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
    <form action="#" method="POST">
        @csrf
        <section>
            <div class="w-72 h-auto mx-auto mt-16 ">

                <!--INICIO DE NAVBAR MOBIL-->
                <div class="bottom-bar fixed bottom-[1%] left-0 right-0 flex justify-center">
                    <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                        <div class="flex items-center  ">
                            <a href="{{ route('usuarios.index') }}"><img class="w-6"
                                    src="{{ asset('imgs/HomeIcon.png') }}" alt="User Icon"></a>
                        </div>

                        <div class="flex items-center">
                            <a href="{{ route('cart.index') }}" class=" bg-white rounded-full p-[0.25rem] "><img
                                    class="w-6" src="{{ asset('imgs/CarritoSelectedIcon.png') }}"
                                    alt="User Icon"></a>
                        </div>

                        <div class="flex items-center">
                            <a href="{{ route('reservations.index') }}"><img class="w-6" src="{{ asset('imgs/FavIcon.png') }}"
                                    alt="User Icon"></a>
                        </div>
                        <div class="flex items-center">
                            <a href="./UserEditarPerfil"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}"
                                    alt="User Icon"></a>
                        </div>
                    </div>

                </div>
                <!--FIN DE NAVBAR MOBIL-->


                <div class="text-center">
                    <h1 class="text-3xl font-bold text-purple-600">Agregar Mercado</h1>
                    <h3 class="mt- "><b>LOCAL</b></h3>
                </div>
                <div class="mt-20 space-y-4">
                    <div class="flex justify-center">
                        <input name="ubicacion"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400"
                            type="text" placeholder="Ubicación" required>
                    </div>

                    <div class="flex justify-center">
                        <input name="nombremercado"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400"
                            type="text" placeholder="Nombre del Mercado" value="{{ old('name') }}" required>
                    </div>
                    <div class="flex justify-center">
                        <input name="municipio"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400"
                            type="text" placeholder="Municipio" value="{{ old('Municipio') }}" required>
                    </div>
                    <div class="flex justify-center">
                        <h4 class="text-gray-600 text-xs px-4">Hora de Entrada : </h4>
                        <h4 class="text-gray-600 text-xs px-4">Hora de Salida : </h4>
                    </div>
                    <div class="flex justify-center">
                        <input
                            class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400"
                            type="time" name="Entrada" value="{{ old('horaentrada') }}" required>
                        <input
                            class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400"
                            type="time" name="Salida" value="{{ old('horasalida') }}" required>
                    </div>
                    <div class="flex justify-between">
                        <label for="file-input"
                            class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative">
                            <span>Imagen del mercado</span>
                            <input name="imagen" id="file-input" type="file" class="hidden"
                                value="{{ old('imagen_referencia') }}">
                            <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover"
                                style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                        </label>
                    </div>
                    <div class="flex justify-center">
                        <textarea name="Descripcion" rows="3"
                            class="border-1 rounded-lg border w-80 h-24 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 resize-none"
                            placeholder="Descripción">{{ old('descripcion') }}</textarea>
                    </div>
                </div>

                <div class="flex justify-center mt-10">
                    <button
                        class="bg-purple-500 w-72 h-10 flex items-center  justify-center gap-x-2 rounded-md px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-purple-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-opacity-50">Guardar</button>
                </div>




            </div>
        </section>
    </form>

</body>

</html>
