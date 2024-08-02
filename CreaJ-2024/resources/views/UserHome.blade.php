<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Inicio</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>

<body class="">
    <!-- Desktop Navbar -->
    <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">

        <a href="{{ route('mercado-locals.index') }}">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black">
            Mini <span class="text-blue-600"><b>Shop</b></span>
        </h1>
        </a>

        <div class="flex gap-8">
            <a href="{{ route('mercado-locals.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Hogar</a>
            <a href="./UserCarritoGeneral"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Carrito</a>
            <a href="./UserEstadoPedidos"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Reservas</a>
            <a href="./UserProfileVista"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Perfil</a>
        </div>
    </div>
    <!-- Mobile Navbar -->
    <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
            <div class="flex items-center">
                <a href="{{ route('mercado-locals.index') }}" class="bg-white rounded-full p-1">
                    <img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="Home Icon" />
                </a>
            </div>

            <div class="flex items-center">
                <a href="./UserCarritoGeneral">
                    <img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="Cart Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="./UserEstadoPedidos">
                    <img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="Favorites Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="./UserProfileVista">
                    <img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="Profile Icon" />
                </a>
            </div>
        </div>
    </div>


    <!-- Agregar un margen superior al contenido principal igual a la altura de la barra de navegación -->
    <!-- <div class="mt-10">
            <div class="flex justify-between mt-5">
                <div class="ml-[10%]">
                    <h1>Hola! Bienvenido &#x1F44B;</h1>
                    <h3 class="text-blue-800 font-bold">Sra. Maria Mercedes Gonzales</h3>
                </div>
                <div class="mr-[10%] mt-4">
                    <img class=" rounded-full w-12" src="{{ asset('imgs/PerfilJuana.jpg') }}" alt="User Icon">
                </div>
            </div> -->

    <!-- <div class="text-center mt-5">
                <h1 class="text-[60px] font-bold">Mini <span class="text-blue-600 font-bold">Shop</span></h1>
            </div> -->
    <div class="h-[70vh] bg-no-repeat bg-cover bg-center lg:bg-[center_top_-25rem]"
        style="background-image: url({{ asset('imgs/PortadaMiniShop.png') }});">

    </div>

    <div class="flex my-8 justify-around w-[90%]  mx-auto">
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
    @foreach ($mercadoLocals as $mercadoLocal)
        @if ($mercadoLocal->id % 2 != 0)
            <!--INICIO DE MERCADO-->
            <div class="md:p-0 p-4">
                <div
                    class="flex flex-col-reverse p-4 border rounded md:border-none md:p-0 md:grid md:grid-cols-2 items-center">
                    <div class="p-4 space-y-4 max-w-lg mx-auto flex flex-col items-center">
                        <h2 class="text-center font-bold text-3xl">{{ $mercadoLocal->nombre }}</h2>
                        <p> {{ $mercadoLocal->descripcion }}. Los horarios disponibles son:
                            <b>{{ $mercadoLocal->horaentrada }}</b> hasta <b>{{ $mercadoLocal->horasalida }}</b>. Nos
                            podes encontrar en <b>{{ $mercadoLocal->ubicacion }}</b>, en el municipio de
                            {{ $mercadoLocal->municipio }}
                        </p>
                        <a class="block w-full mt-4 px-3 py-2" href="{{ route('mercado-locals.show',$mercadoLocal->id) }}">
                        <button class="block w-full mt-4 px-3 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-600">
                           Ver Mercado
                        </button>
                        </a>
                    </div>
                    <div>
                        <img class="w-full object-cover" src="{{ asset('imgs/'.$mercadoLocal->imagen_referencia) }}" alt="">
                    </div>
                </div>
            </div>
        @endif

        @if ($mercadoLocal->id % 2 != 1)
            <div class="md:p-0 p-4 bg-[#334765] text-white">
                <div
                    class="flex flex-col p-4 border border-gray-200 rounded md:border-none md:p-0 md:grid md:grid-cols-2 items-center">

                    <div>
                        <img class="h-full w-full object-cover" src="{{ asset('imgs/'.$mercadoLocal->imagen_referencia) }}" alt="">
                    </div>
                    <div class="p-4 space-y-4 max-w-lg mx-auto flex flex-col items-center">
                        <h2 class="text-center font-bold text-3xl">{{ $mercadoLocal->nombre }}</h2>
                        <p> {{ $mercadoLocal->descripcion }}. Los horarios disponibles son:
                            <b>{{ $mercadoLocal->horaentrada }}</b> hasta <b>{{ $mercadoLocal->horasalida }}</b>. Nos
                            podes encontrar en <b>{{ $mercadoLocal->ubicacion }}</b>, en el municipio de
                            {{ $mercadoLocal->municipio }}
                        </p>
                        <a class="block w-full mt-4 px-3 py-2" href="{{ route('mercado-locals.show',$mercadoLocal->id) }}">
                            <button class="block w-full mt-4 px-3 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-600">
                                Ver Mercado
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    <!--FIN DE MERCADO-->




    <div class="mt-6 p-4">
        <h2 class="text-center font-bold mb-4 text-3xl">Puestos Populares</h2>
        <div class="flex flex-col md:grid grid-cols-3 gap-6">
            <!--INICIO DE VENDEDOR-->
            @foreach ($vendedors->take(3) as $vendedor)
            <div>
                <img src="{{ asset('imgs/'.$vendedor->imagen_de_referencia) }}" alt="">
                <h3 class="font-bold text-lg">Puesto de {{ $vendedor->nombre }} en {{ $vendedor->mercadoLocal->nombre }}</h3>
            <a href="{{ route('vendedors.show',$vendedor->id) }}">
                <div class="flex gap-2 items-center">
                    <p>Ver Puesto </p>
                    <img width="18" src="{{ asset('imgs/arrow_left.png') }}" alt="">
                </div>
            </a>
            </div>
            <!--FIN DE VENDEDOR-->
            @endforeach

        </div>
    </div>

    <footer class="bg-[#292526] pb-16">
        <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white  p-12">
            <div>
                <b><b>
                        <h2>Contact Us</h2>
                    </b></b>

                <p>Whatsapp: wa.me/50369565421</p>
                <p>Correo Electronico: contacto@minishop.sv</p>
                <p>Dirección: Calle Ruben Dario &, 3 Avenida Sur, San Salvador</p>

            </div>
            <div>
                <b>
                    <h2>Sobre nosotros</h2>
                </b>
                <p>Somos un equipo de desarrollo web dedicado a apoyar a los vendedores locales y municipales en el área
                    metropolitana de San Salvador, brindando soluciones tecnológicas para fortalecer los mercados
                    locales.</p>
            </div>
            <div class="md:self-end md:justify-self-end pb-4">
                <p class="font-black text-5xl mb-4">Mini <span class="text-blue-600">Shop</span></p>
                <div class="flex gap-2">
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/facebook.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square  flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/google.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/linkedin.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/twitter.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" src="{{ asset('imgs/youtube.png') }}" alt="">
                    </div>

                </div>
            </div>
        </div>
        <div class="w-full h-[2px] bg-white"></div>
    </footer>
    <!-- <div class="flex justify-center mt-5 flex-col items-center">

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
            </div> -->
    </div>

</body>

</html>
