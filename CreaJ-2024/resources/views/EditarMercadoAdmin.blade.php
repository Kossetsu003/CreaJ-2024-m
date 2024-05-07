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
    <form action="" method="post">
    <section>
        <div class="w-72 h-96 mx-auto mt-16">
        
            <div class="text-center">
                <h1 class="text-3xl font-bold text-red-700">Editor de Mercado</h1>
                <h3 class="text-sm mt-2">Mercado Ex-Cuartel <span class="font-bold">ID: #EXC07098</span></h3>
            </div>
            <div class="mt-20 space-y-4">
                <div class="flex justify-center">
                    <input class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Nombre del Mercado" required>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Descripción del Mercado" required>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Distrito Ubicado" required>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" placeholder="Ubicación Específica" required>
                </div>
                <div class="flex justify-center">
                    <h4 class="text-gray-600 text-xs px-4">Hora de Entrada : </h4>
                    <h4 class="text-gray-600 text-xs px-4">Hora de Salida : </h4>
                </div>
                <div class="flex justify-center">
                    <input class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="time" name="Entrada" min="03:00" max="21:00" required>
                    <input class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="time" name="Salida" required>
                </div>
                <div class="flex justify-between">
                    <label for="file-input" class="border-1 rounded-lg border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative">
                        <span>Imagen del mercado</span>
                        <input id="file-input" type="file" class="hidden" required>
                        <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                    </label>
                </div>
            </div>

            <div class="flex justify-center mt-16">
                <button class="bg-red-600 w-72 h-10 text-white font-bold rounded-md">Guardar</button>
            </div>

             <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
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
        </div>
    </section>
</form>

</body>
</html>
