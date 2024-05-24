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
   <form action="" method="get">
    <section>
        <div class="w-72 h-96 mx-auto mt-16">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-red-500">Registrar vendedor</h1>
            </div>

            <div class="mt-20 space-y-4">
                <div class="flex justify-between">
                    <label for="file-input" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative">
                        <span class="text-gray-400">Foto del Vendedor</span>
                        <input id="file-input" type="file" class="hidden" required>
                        <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                    </label>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Ingrese los Nombres" required>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Ingrese el Apellido" required>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="email" placeholder="Ingrese el Correo Electrónico" required>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="tel" placeholder="Ingrese el Número de Teléfono" required>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Escriba el Número de Puesto" required>
                </div>
                <div class="flex justify-center">
                    <select class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 text-gray-400" required>
                        <option value="NULL">Escoga el Mercado Asignado</option>
                        <option value="SagCor">Sagrado Corazón</option>
                        <option value="ExCua">Ex-Cuartel</option>
                        <option value="Cen">Central</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-center mt-16">
                <button class="bg-red-600 w-72 h-10 text-white font-bold rounded-md">Registrar</button>
            </div>

                 <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
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

            </div>
            </div>
        </div>
    </section>
</form>
</body>
</html>
