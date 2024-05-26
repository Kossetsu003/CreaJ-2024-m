<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Estado de Pedidos</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
    <div class="mx-auto max-w-lg mt-16 mb-[15%] "> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
            <!--INICIO DE NAVBAR MOBIL-->
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                <div class="flex items-center  ">
                    <a href="./VendedorHome" ><img class="w-6" src="{{ asset('imgs/HomeIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./VendedorMiBuzon"><img class="w-6" src="{{ asset('imgs/BuzonIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./VendedorMisReservas"class=" bg-white rounded-full p-[0.25rem] " ><img class="w-6" src="{{ asset('imgs/ReservasSelectedIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="./VendedorProfileVista"  ><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                </div>
            </div>

            <!--FIN DE NAVBAR MOBIL-->
        </div>
        </div>

        <div class="mt-14 mb-[5em]  w-[90%] mx-auto">

         <div>
            <div >
                <div class="flex">
                    <div class="text-[30px] font-bold">
                        Mini
                    </div>
                    <div class="mt-3 ml-3">
                        <img class="w-8" src="{{ asset('imgs/caja.png') }}" alt="User Icon">
                    </div>
                </div>
            </div>
            <div class="ml-16 w-[20%]">
                <h3 class="text-blue-600 text-[25px] font-bold">Shop</h3>
            </div>

         </div>

         <h2 class="pt-7 text-center font-bold"> Mis Pedidos Reservados</h2>



         <div class="flex flex-wrap justify-center mt-5 text-sm">
            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] object-cover rounded-md" src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Reserva del Puesto de Maria Jose</h3>
                <h3 class="mb-2">05/06/2024</h3>
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- Círculo amarillo -->
                        <div class="w-3 h-3 bg-green-400 rounded-full mr-2"></div>
                        <h3>Listo para Entregar</h3>
                    </div>

                </div>
            </div>
            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md object-cover" src="{{ asset('imgs/NaranjasQuintal.jpg') }}" alt="User Icon">

                <h3 class="font-bold mt-5">Reserva de la Tienda Michellina</h3>
                <h3 class="mb-2">08/08/2024</h3>
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- Círculo amarillo -->
                        <div class="w-3 h-3 bg-yellow-400 rounded-full mr-2"></div>
                        <h3>Pendiente a Entregar</h3>
                    </div>

                </div>
            </div>

            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] object-cover rounded-md" src="{{ asset('imgs/MercadoJeans.jpg') }}" alt="User Icon">

                <h3 class="font-bold mt-5">Reserva de Tienda Genesis</h3>
                <h3 class="mb-2">17/01/2023</h3>
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- Círculo amarillo -->
                        <div class="w-3 h-3 bg-gray-400 rounded-full mr-2"></div>
                        <h3>Entregado</h3>
                    </div>

                </div>
            </div>

            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md object-cover" src="{{ asset('imgs/PupusasFoto.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Reserva de Pupuseria Mary</h3>
                <h3 class="mb-2">08/05/2022</h3>
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- Círculo amarillo -->
                        <div class="w-3 h-3 bg-gray-400 rounded-full mr-2"></div>
                        <h3>Entregado</h3>
                    </div>

                </div>
            </div>
        </div>





    </div>

</body>
</html>
