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
        <div class="w-72 h-96 mx-auto mt-16">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-purple-600">Agregar Mercado</h1>
                <h3 class="mt- "><b>LOCAL</b></h3>
            </div>
            <div class="mt-20 space-y-4">
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Ubicación">
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Descripción">
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Nombre del Mercado">
                </div>
                <div class="flex justify-between">
                    <label for="file-input" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative">
                        <span>Imagen del mercado</span>
                        <input id="file-input" type="file" class="hidden">
                        <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                    </label>
                </div>

                <div>
                    <h1 class="text-center font-bold">Imagenes</h1>
                    <div class="flex mx-auto justify-center mt-5 ">
                        <button class="mx-2"><img class="w-4" src="{{ asset('imgs/Flecha3.png') }}" alt="User Icon"></button>
                        <h3 class="mx-2">1</h3>
                        <button class="mx-2"><img class="w-5" src="{{ asset('imgs/flechaderecha.png') }}" alt="User Icon"></button>
                    </div>
                </div>

            </div>

            <div class="flex justify-center mt-10">
                <button class="bg-purple-500 w-72 h-10 text-white font-bold rounded-md">Guardar</button>
            </div>

            <div class="bg-gray-800 rounded-2xl w-60 h-10 mx-auto mb-16 flex justify-around mt-[50%]">
                <div class="flex items-center">
                    <button><img class="w-4" src="{{ asset('imgs/casa2.png') }}" alt="User Icon"></button>
                </div>

                <div class="flex items-center">
                    <button><img class="w-4" src="{{ asset('imgs/casa2.png') }}" alt="User Icon"></button>
                </div>

                <div class="flex items-center">
                    <button><img class="w-4" src="{{ asset('imgs/casa2.png') }}" alt="User Icon"></button>
                </div>
            </div>


        </div>
    </section>
</body>
</html>
