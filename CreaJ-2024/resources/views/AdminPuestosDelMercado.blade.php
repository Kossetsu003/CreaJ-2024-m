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
    <div class="bottom-bar fixed bottom-[1%] left-0 right-0 z-[100] flex justify-center md:hidden">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around ">
            <div class="flex items-center  ">
                <a href="{{ route('admin.index') }}" ><img class="w-6" src="{{ asset('imgs/admin.home.nav.png') }}" alt="User Icon"></a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('imgs/admin.sellers.nav.png') }}" alt="User Icon"></a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('admin.clientes') }}" ><img class="w-6" src="{{ asset('imgs/admin.users.nav.png') }}" alt="User Icon"></a>
            </div>
            <div class="flex items-center">

                <a href="{{ route('AdminProfileVista')}}"  ><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
            </div>
        </div>
        <!--FIN DE NAVBAR MOBIL-->
    </div>




    <div class="mt-14  w-[90%] mx-auto ">

        <div class="flex justify-between  w-[90%] mx-auto "> <!--Contenedor Principal-->
            <div>
                <div class=" lg:text-[60px]">
                    Puesto #{{ $vendedor->numero_puesto}}  {{ $vendedor->nombre_del_local }}
                </div>
                <div class="font-bold lg:text-[40px]">
                    Ubicado en {{ $mercadoLocal->nombre }}
                </div>
            </div>

            <div>
                <img class="w-[200px] h-[200px] object-cover rounded-full" src="{{ asset('imgs/'.$vendedor->imagen_de_referencia) }}" alt="User Icon">
            </div>

        </div>
        <!--El titulo-->

        <div class="flex mt-5 lg:mt-[40px]">
            <div class="flex mx-auto">
                <button
                    class="flex items-center lg:h-11  h-8 border  px-1 py-0.5 rounded-md mr-2 text-xs lg:text-[20px] bg-blue-300 border-blue-300 text-white font-bold">
                    <img class="w-7" src="{{ asset('imgs/SelectBox.png') }}" alt="User Icon">
                    <span class="ml-1">Todos Los puestos</span>
                </button>

                <button class="flex items-center border text-black px-1 py-0.5 rounded-md mr-2 text-xs lg:text-[20px] ">
                    <img class="w-5" src="{{ asset('imgs/ClotheSelected.png') }}" alt="User Icon">
                    <span class="ml-1">Ropa</span>
                </button>

                <button
                    class="flex items-center border text-black px-1 py-0.5 rounded-md text-xs lg:text-[20px] hover:bg-blue-200">
                    <img class="w-5" src="{{ asset('imgs/FoodSelected.png') }}" alt="User Icon">
                    <span class="ml-1">Comida</span>
                </button>
            </div>
        </div>

        <!--Comienzo de las cartas -->

        <div class="flex flex-wrap justify-center mt-5 text-sm gap-[10px]  lg:gap-[40px]">
            <!-- INICIO DE CARTA-->
        @if ($products->isEmpty())
                <span class="text-center justify-center flex text-[1.75rem] text-gray-600 my-[7rem]">No hay Vendedores Inscritos</span>
            @else
            @foreach ($products as $product)
            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover"
                    src="{{ asset('imgs/'.$product->imagen_referencia) }}" alt="{{ $product->imagen_referencia }}">
                <h3 class="font-bold mt-5">{{ $product->name }}</h3>
                <h3 class="mb-2">{{ $product->vendedor->nombre_del_local }}</h3>
                <div class="flex justify-between">
                    <h3>{{ $product->clasificacion }}</h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">4.2</h3>
                        <img class="w-5 " src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>

            </div>
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
                <p>Somos un equipo de desarrollo web dedicado a apoyar a los vendedores locales y municipales en el
                    área
                    metropolitana de San Salvador, brindando soluciones tecnológicas para fortalecer los mercados
                    locales.</p>
            </div>
            <div class="md:self-end md:justify-self-end pb-4">
                <p class="font-black text-5xl mb-4">Mini <span class="text-blue-600">Shop</span></p>
                <div class="flex gap-2">
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/facebook.png') }}"
                            alt="">
                    </div>
                    <div class="w-8 aspect-square  flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/google.png') }}" alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/linkedin.png') }}"
                            alt="">
                    </div>
                    <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full">
                        <img width="18" class="invert" src="{{ asset('imgs/twitter.png') }}"
                            alt="">
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
