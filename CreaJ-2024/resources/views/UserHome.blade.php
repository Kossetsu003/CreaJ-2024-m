<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Inicio</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>

    <div class="mx-auto max-w-lg mt-10 mb-32"> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
            <!--INICIO DE NAVBAR MOBIL-->
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                <div class="flex items-center  ">
                    <a href="./UserHome" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./UserCarritoGeneral"><img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="./UserEstadoPedidos" ><img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="#
                    "  ><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                </div>
            </div>

            <!--FIN DE NAVBAR MOBIL-->
        </div>

        <!-- Agregar un margen superior al contenido principal igual a la altura de la barra de navegación -->
        <div class="mt-10"> <!-- Puedes ajustar este valor según sea necesario -->
            <div class="flex justify-between mt-5">
                <div class="ml-[10%]">
                    <h1>Hola! Bienvenido &#x1F44B;</h1>
                    <h3 class="text-blue-800 font-bold">Sra. Maria Mercedes Gonzales</h3>
                </div>
                <div class="mr-[10%] mt-4">
                    <img class=" rounded-full w-12" src="{{ asset('imgs/PerfilJuana.jpg') }}" alt="User Icon">
                </div>
            </div>

            <div class="text-center mt-5">
                <h1 class="text-[60px] font-bold">Mini <span class="text-blue-600 font-bold">Shop</span></h1>
            </div>

            <div class="mt-5">
                <img class="w-[100%]" src="{{ asset('imgs/PortadaMiniShop.png') }}" alt="User Icon">
            </div>

            <div class="flex mt-5 justify-around w-[90%] mx-auto">
                <button class="flex items-center px-3 py-2  rounded-md">
                    <img class="w-7 mr-2" src="{{ asset('imgs/NosotrosIcon.png') }}" alt="User Icon">
                    Nosotros
                </button>

                <button class="flex items-center px-3 py-2  rounded-md">
                    <img class="w-7 mr-2" src="{{ asset('imgs/VisionIcon.png') }}" alt="User Icon">
                    Vision
                </button>

                <button class="flex items-center px-3 py-2  rounded-md">
                    <img class="w-7 mr-2" src="{{ asset('imgs/MisionIcon.png') }}" alt="User Icon">
                    Mision
                </button>
            </div>

            <div class="flex justify-center mt-5 flex-col items-center">

                <a href="./UserPuestosVendedores" class="w-[80%] bg-gray-50 rounded-md border border-gray-200 mb-4">
                <div>
                    <img class="w-[100%] rounded-t-lg" src="{{ asset('imgs/MercadoExCuartel.jpg') }}" alt="User Icon">
                    <div class="text-center mt-2">
                        <h1 class="text-sm font-bold">Mercado Ex-Cuartel</h1>
                        <h3 class="w-[85%] mx-auto text-xs text-justify pb-5">El mercado está ubicado en la 1a. C. Ote., San Salvador, y su horario de atención es de lunes a viernes de 07:30 a 17:00, los sábados de 07:30 a 16:00 y los domingos de 07:30 a 14:00.</h3>
                    </div>
                </div>
            </a>

                <div class="w-[80%] bg-gray-50 rounded-md border border-gray-200 mt-5">
                    <img class="w-[100%] rounded-t-lg" src="{{ asset('imgs/MercadoSanMiguelito.jpg') }}" alt="User Icon">
                    <div class="text-center mt-2">
                        <h1 class="text-sm font-bold">MercadoSan Miguelito</h1>
                        <h3 class="w-[85%] mx-auto text-xs text-justify pb-5">El Mercado San Miguelito es uno de los mercados más emblemáticos y concurridos de San Salvador, conocido por su gran variedad de productos y especialmente por sus arreglos florales y decoraciones para celebraciones</h3>
                    </div>
                </div>

                <div class="w-[80%] bg-gray-50 rounded-md border border-gray-200 mt-5">
                    <img class="w-[100%] rounded-t-lg" src="{{ asset('imgs/MercadoCentral.jpeg') }}" alt="User Icon">
                    <div class="text-center mt-2">
                        <h1 class="text-sm font-bold">Mercado Central</h1>
                        <h3 class="w-[85%] mx-auto text-xs text-justify pb-5">Es un sitio emblemático para los habitantes de San Salvador y un punto de interés turístico para quienes desean experimentar la cultura local y encontrar productos únicos de El Salvador</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
