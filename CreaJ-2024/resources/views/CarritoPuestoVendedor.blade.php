<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>MiniCarrito</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
        <div class="mx-auto max-w-lg mt-10 ">
            <!--INICIO DE NAVBAR MOBIL-->
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
             <!--FIN DE NAVBAR MOBIL-->
            <div class="flex justify-around ">
                <div>
                    <button><img class="w-5" src="{{ asset('imgs/Flecha3.png') }}" alt="User Icon"></button>
                </div>
                <div>
                    <h2 class="font-bold">MiCarrito</h2>
                </div>
                <div>
                    <img src="{{ asset('imgs/menu.png') }}" alt="User Icon">
                </div>
            </div>

                <div class="mt-[10%] mx-auto ml-12 flex w-[80%] ">
                    <img class="w-16 h-16 rounded-lg " src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 w-[70%]">
                        <h3 class="text-sm">Ciento de Aguacates</h3>
                        <h3 class="text-xs">Tienda de JoseMaria</h3>
                        <h3 class="text-sm font-bold">$09.00</h3>
                    </div>
                    <div class="mx-auto mt-[15px] h-8 bg-red-500 rounded-md w-20 flex justify-around ">
                        <button class="text-white">Negar</button>
                    </div>
                </div>

                <hr class="mt-5 w-[90%]">
                <div class="mt-[10%] mx-auto ml-12 flex w-[80%] ">
                    <img class="w-16 h-16 rounded-lg " src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 w-[70%]">
                        <h3 class="text-sm">Ciento de Aguacates</h3>
                        <h3 class="text-xs">Tienda de JoseMaria</h3>
                        <h3 class="text-sm font-bold">$09.00</h3>
                    </div>
                    <div class="mx-auto mt-[15px] h-8 bg-red-500 rounded-md w-20 flex justify-around ">
                        <button class="text-white">Negar</button>
                    </div>
                </div>
                <hr class="mt-5 w-[90%]"><div class="mt-[10%] mx-auto ml-12 flex w-[80%] ">
                    <img class="w-16 h-16 rounded-lg " src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 w-[70%]">
                        <h3 class="text-sm">Ciento de Aguacates</h3>
                        <h3 class="text-xs">Tienda de JoseMaria</h3>
                        <h3 class="text-sm font-bold">$09.00</h3>
                    </div>
                    <div class="mx-auto mt-[15px] h-8 bg-red-500 rounded-md w-20 flex justify-around ">
                        <button class="text-white">Negar</button>
                    </div>
                </div>
                <hr class="mt-5 w-[90%]">
    

            <div class="flex w-[90%]  mt-10 ml-5 justify-between">
                <div >
                    <h3  class="my-2">Cantidad(6 Productos)</h3>
                    <h3>Costo de Reserva</h3>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold my-2">$48.00</span>
                    <span class="font-bold">$00.75</span>
                </div>

            </div>
            <hr>
            <div class="flex w-[90%] mt-3   ml-5 justify-between">
                <div >
                    <h3 class="my-2">Total</h3>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold my-2">$48.75</span>
                </div>

            </div>

            <button class="mx-auto mt-[20px] mb-[7rem] bg-black border-white flex justify-center items-center w-72 h-14 gap-x-2 rounded-2xl px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-neutral-700 hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">
                <span>Guardar</span>
            </button>

</body>
</html>
