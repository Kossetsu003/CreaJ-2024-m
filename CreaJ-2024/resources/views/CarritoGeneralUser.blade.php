<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>MisReservas</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>

     <div class="mx-auto max-w-lg mt-10 mb-32"> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
            <div class="bg-gray-800 rounded-2xl w-60 h-10 flex justify-around">
                <div class="flex items-center">
                    <button><img class="w-4" src="{{ asset('imgs/casa2.png') }}" alt="User Icon"></button>
                </div>

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

        <!-- Agregar un margen superior al contenido principal igual a la altura de la barra de navegación -->
        <div class="mt-14"> <!-- Puedes ajustar este valor según sea necesario -->
             <div class="flex justify-around ">
                <div>
                    <button><img class="w-5" src="{{ asset('imgs/Flecha3.png') }}" alt="User Icon"></button>
                </div>
                <div>
                    <h2><b>MisPedidos</b></h2>
                </div>
                <div>

                </div>
            </div>

            <div>
                <div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Puesto de JoseMaria</h3>
                        <h3 class="text-xs ">Reserva realizada el 03/04/2024</h3>
                        <h3 class="text-sm font-bold">$48.75</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Confirmar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Cancelar</button>

                </div>
                <hr class="w-[90%] mx-auto">
                 <div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs/PupusasFoto.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Pupuseria Niña Marta</h3>
                        <h3 class="text-xs">Reselva realizada el 05/05/2023</h3>
                        <h3 class="text-sm font-bold">$09.30</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Confirmar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Cancelar</button>

                </div>
                <hr class="w-[90%] mx-auto">
                 <div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs/PescadoFresco.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Pesqueria Don Pedro</h3>
                        <h3 class="text-xs">Reserva realizada el 21/02/2024</h3>
                        <h3 class="text-sm font-bold">$07.00</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Confirmar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Cancelar</button>

                </div>

                 <hr class="w-[90%] mx-auto">
                 <div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs/AlmuerzoFoto.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Comedor Niña Carmen</h3>
                        <h3 class="text-xs">Reserva realizada el 18/02/2023</h3>
                        <h3 class="text-sm font-bold">$02.50</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Confirmar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Cancelar</button>

                </div>
                <hr class="w-[90%] mx-auto">
                      <div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs/RopaFoto.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Tienda Mayoreo Pan de Jesus</h3>
                        <h3 class="text-xs">Reserva Realizada el 03/05/2023</h3>
                        <h3 class="text-sm font-bold">$12.00</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Confirmar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Cancelar</button>

                </div>
                <hr class="w-[90%] mx-auto">      <div class="mt-[10%] mx-auto ml-12 flex ">
                    <img class="w-14 rounded-lg h-auto" src="{{ asset('imgs/CarniceriaFoto.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Carniceria Don Juan</h3>
                        <h3 class="text-xs">Reserva Realizada el 06/05/2023</h3>
                        <h3 class="text-sm font-bold">$04.75</h3>
                    </div>

                </div>
                <div class="mt-1 mr-5 gap-2 mb-2 flex justify-end">
                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Confirmar</button>
                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded">Cancelar</button>

                </div>
                <hr class="w-[90%] mx-auto">


        </div>
    </div>

</body>
</html>
