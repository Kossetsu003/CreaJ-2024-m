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
        <div class="w-72 h-96 mx-auto mt-16">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-red-500">Registrar vendedor</h1>

            </div>

            <div class="mt-20 space-y-4">
                <div class="flex justify-between">
                    <label for="file-input" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative">
                        <span class="text-gray-400">Foto del Vendedor</span>
                        <input id="file-input" type="file" class="hidden">
                        <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                    </label>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Ingrese los Nombres">
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Ingrese el Apellido">
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Ingrese el Correo Electrónico">
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Ingrese el Número de Teléfono">
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Escriba el Número de Puesto">
                </div>
                <div class="flex justify-center">
                    <select class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 text-gray-400"
                    >
                    <option value="NULL">Escoga el Mercado Asignado</option>
                    <option value="SagCor">Sagrado Corazón</option>
                    <option value="ExCua">Ex-Cuartel</option>
                    <option value="Cen">Central</option></select>
                </div>

            </div>

            <div class="flex justify-center mt-16">
                <button class="bg-red-600 w-72 h-10 text-white font-bold rounded-md">Registrar</button>
            </div>

            <div class="bg-gray-800 rounded-2xl w-60 h-10 mx-auto mb-16 flex justify-around mt-[20%]">
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
