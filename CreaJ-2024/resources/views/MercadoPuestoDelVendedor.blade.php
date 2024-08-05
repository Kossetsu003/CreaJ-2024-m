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
    <!-- Desktop Navbar -->
    <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black font-bold">
            MiniShop
        </h1>
        <div class="flex gap-8">
            <a href="{{ route('mercado-locals.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Hogar</a>
            <a href="{{ route('cart.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Carrito</a>
            <a href="{{ route('UserEstadoPedidos') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Reservas</a>
            <a href="{{ route('UserProfileVista') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Perfil</a>
        </div>
    </div>



    <!-- Inicio de nav movil-->
    <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center md:hidden">

        <!--INICIO DE NAVBAR MOBIL-->
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around ">
            <div class="flex items-center  ">
                <a href="./VendedorHome" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6"
                        src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></a>
            </div>

            <div class="flex items-center">
                <a href="./VendedorMiBuzon"><img class="w-6" src="{{ asset('imgs/BuzonIcon.png') }}"
                        alt="User Icon"></a>
            </div>

            <div class="flex items-center">
                <a href="./VendedorMisReservas"><img class="w-6" src="{{ asset('imgs/ReservasIcon.png') }}"
                        alt="User Icon"></a>
            </div>
            <div class="flex items-center">
                <a href="./VendedorProfileVista"><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}"
                        alt="User Icon"></a>
            </div>
        </div>

        <!--FIN DE NAVBAR MOBIL-->
    </div>

    <div class="mt-14  w-[90%] mx-auto md:text-[30px]">

        <div class="flex justify-between  w-[90%] mx-auto"> <!--Contenedor Principal-->
            <div>
                <div>
                    Puesto de comida
                </div>
                <div class="font-bold">
                    Nombre de Vendedor
                </div>
            </div>

            <div class="mt-3 md:hidden">
                <img class="w-4 rounded-full " src="{{ asset('imgs/flecha-izquierda.png') }}" alt="User Icon">
            </div>
        </div>
        <!--Fin Principal-->


        <div class="flex flex-wrap justify-center mt-10 text-sm md:gap-[50px]">
            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover"
                    src="{{ asset('imgs/MercadoMujer.jpg') }}" alt="User Icon">
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
            <a href="./VendedorProductoEnEspecifico" class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover"
                    src="{{ asset('imgs/NaranjasQuintal.jpg') }}" alt="User Icon">
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
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover"
                    src="{{ asset('imgs/MercadoJeans.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Venta de Jeans</h3>
                <h3 class="mb-2">Venta Michelina</h3>
                <div class="flex justify-between">
                    <h3>Ropa</h3>
                    <div class="flex items-center">
                        <h3 class="mr-2">3.2</h3>
                        <img class="w-5" src="{{ asset('imgs/estrella.png') }}" alt="User Icon">
                    </div>
                </div>
            </div>
            <div class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover"
                    src="{{ asset('imgs/MercadoVariado.jpg') }}" alt="User Icon">
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
