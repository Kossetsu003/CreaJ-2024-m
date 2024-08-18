<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Home Admin General</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>

<body>
    <!-- Desktop Navbar -->
    <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
        <a href="{{ route('admin.index') }}">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold">
             Mini <span class="text-purple-600"><b>Admin</b></span>
        </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('admin.index') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mercados</a>
              <a href="{{ route('admin.vendedores') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Vendedores</a>
            <a href="{{ route('admin.clientes') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Clientes</a>
                <a href="{{ route('AdminProfileVista')}}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-white hover:bg-black border border-black px-2 py-1 rounded-md">
                    Perfil
                </a>
        </div>
    </div>



    <!-- Inicio de nav movil-->
    <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center md:hidden">

        <!--INICIO DE NAVBAR MOBIL-->
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around ">
            <<div class="flex items-center  ">
                <a href="{{ route('admin.index') }}" class=" bg-white rounded-full p-[0.25rem] "><img
                        class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></a>
        </div>

        <div class="flex items-center">
            <a href="{{ route('admin.vendedores') }}"><img class="w-6"
                    src="{{ asset('imgs/VendedorIcon.png') }}" alt="User Icon"></a>
        </div>

        <div class="flex items-center">
            <a href="{{ route('admin.clientes') }}"><img class="w-6" src="{{ asset('imgs/ClienteIcon.png') }}"
                    alt="User Icon"></a>
        </div>
        <div class="flex items-center">
            <a href="./AdminEstadoPedidos"><img class="w-6" src="{{ asset('imgs/ReservasIcon.png') }}"
                    alt="User Icon"></a>
        </div>
        <div class="flex items-center">
            <?php $id = 1; ?>
            <a href="{{ route('AdminProfileVista') }}"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}"
                    alt="User Icon"></a>

        </div>
    </div>

    <!--FIN DE NAVBAR MOBIL-->
    </div>


    <div class="w-screen hidden md:block">
        <img class="w-full h-[25rem] object-cover" src="{{ asset('imgs/'.$mercadoLocal->imagen_referencia) }}" alt="Banner Image">
    </div>

    <div class="mt-14  w-[90%] mx-auto ">

        <div class="flex justify-between text-center  w-[90%] mx-auto "> <!--Contenedor Principal-->
            <div>
                <div class=" lg:text-[60px] font-semibold">
                   {{ $mercadoLocal->nombre }}
                </div>
                <div class=" lg:text-[40px]">
                    Ubicado en {{ $mercadoLocal->ubicacion }}
                </div>
            </div>
        </div>
        <!--El titulo-->

        <!--BOTONES-->
        <div class="flex mt-5 lg:mt-[40px]">
            <div class="flex mt-5 lg:mt-[40px]">
                <div class="flex mx-auto">
                    <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                        <input type="hidden" name="clasificacion" value="todos">
                        <button type="submit" class="flex items-center lg:h-11 h-8 border px-1 py-0.5 rounded-md mr-2 text-xs lg:text-[20px] bg-blue-300 border-blue-300 text-white font-bold">
                            <img class="w-7" src="{{ asset('imgs/SelectBox.png') }}" alt="User Icon">
                            <span class="ml-1">Todos Los puestos</span>
                        </button>
                    </form>

                    <form action="{{ route('admin.vermercados', $mercadoLocal->id) }}" method="GET">
                        <input type="hidden" name="clasificacion" value="comedor">
                        <button type="submit" class="flex items-center border text-black px-1 py-0.5 rounded-md mr-2 text-xs lg:text-[20px]">
                            <img class="w-5" src="{{ asset('imgs/FoodSelected.png') }}" alt="User Icon">
                            <span class="ml-1">Comedores</span>
                        </button>
                    </form>

                    <!-- Puedes agregar más botones de filtro aquí -->
                </div>
            </div>


        </div>
        <!--FIN BOTONES-->

        <!--Comienzo de las cartas -->

        <div class="flex flex-wrap justify-center mt-5 text-sm gap-[10px]  lg:gap-[40px]">
            <!-- INICIO DE CARTA-->
        @if ($vendedors->isEmpty())
                <span class="text-center justify-center flex text-[1.75rem] text-gray-600 my-[7rem]">No hay Vendedores Inscritos</span>
            @else
            @foreach ($vendedors as $vendedor)
            <a href="{{ route('admin.vervendedores',$vendedor->id) }}" class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover"
                    src="{{ asset('imgs/'.$vendedor->imagen_de_referencia) }}" alt="User Icon">
                <h3 class="font-bold mt-5">{{ $vendedor->nombre_del_local}}</h3>
                <h3 class="mb-2">Propietario: {{ $vendedor->nombre}} {{$vendedor->apellidos }}</h3>
                <div class="flex justify-between">
                    <h3>
                        @if ($vendedor->clasificacion == 'frutasyverduras')
                            Frutas y Verduras
                        @elseif ( $vendedor->clasificacion == 'comedor')
                            Comedor
                        @else
                        {{ $vendedor->clasificacion }}
                        @endif
                    </h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">4.2</h3>
                        <img class="w-5 " src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>

            </a>
            @endforeach
        @endif
            <!--FIN DE CARTA-->





            </div>
        </div>
    </div>
    </div>
    <footer class="bg-[#292526] pb-16">
        <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white  p-12">
            <div>
                <b>
                    <h2>Contact Us</h2>
                </b>
                <p>Whatsapp: wa.me/50369565421</p>
                <p>Correo Electronico: contacto@minishop.sv</p>
                <p>Dirección: Calle Ruben Dario &, 3 Avenida Sur, San Salvador</p>
            </div>
            <div>
                <b>
                    <b>
                        <h2>Sobre nosotros</h2>
                    </b>
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


</body>

</html>
