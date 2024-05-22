<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Perfil de vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
    <div class="mx-auto max-w-lg mt-10 mb-32"> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
            <!--INICIO DE NAVBAR MOBIL-->
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                <div class="flex items-center  ">
                    <a href="./HomeUser" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./CarritoGeneralUser"><img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./EstadoPedidosUser" ><img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="./Profile"  ><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                </div>
            </div>

            <!--FIN DE NAVBAR MOBIL-->
        </div>

        <div class="mt-14  w-[90%] mx-auto">

            <div class="flex justify-between  w-[90%] mx-auto"> <!--Contenedor Principal-->
                <div>
                    <div>
                        Puesto de comida
                    </div>
                    <div class="font-bold">
                        Nombre de Vendedor
                    </div>
                </div>

                <div class="mt-3">
                    <img class="w-4 rounded-full " src="{{ asset('imgs/flecha-izquierda.png') }}" alt="User Icon">
                </div>
            </div><!--Fin Principal-->


        <div class="flex flex-wrap justify-center mt-10 text-sm">
            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover" src="{{ asset('imgs/MercadoMujer.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Venta de Mayoreo de Blusas</h3>
                <h3 class="mb-2">Tienda Michelina</h3>
                <div class="flex justify-between">
                    <h3>Ropa</h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">4.2</h3>
                        <img class="w-5 " src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>
            </div>
            <a href="./ProductosUser" class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover" src="{{ asset('imgs/NaranjasQuintal.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Venta de Naranjas Valencia</h3>
                <h3 class="mb-2">Puesto de Don Juan</h3>
                <div class="flex justify-between">
                    <h3>Comida</h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">3.8</h3>
                        <img class="w-5" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>
            </a>

            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover" src="{{ asset('imgs/MercadoJeans.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Venta de Jeans</h3>
                <h3 class="mb-2">Venta Michelina</h3>
                <div class="flex justify-between">
                    <h3>Ropa</h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">3.2</h3>
                        <img class="w-5" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>
            </div> <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover" src="{{ asset('imgs/MercadoVariado.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Venta de Ropa Variada</h3>
                <h3 class="mb-2">Puesto de Don Juan</h3>
                <div class="flex justify-between">
                    <h3>Ropa</h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">4.6</h3>
                        <img class="w-5" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>

        </div>




    </div>

</body>
</html>
