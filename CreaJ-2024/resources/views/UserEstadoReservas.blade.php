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


    <!-- Desktop Navbar -->
    <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
        <a href="{{ route('usuarios.index') }}">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black">
            Mini <span class="text-blue-600"><b>Shop</b></span>
        </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('usuarios.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Hogar</a>
            <a href="{{ route('cart.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Carrito</a>
            <a href="{{ route('reservations.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Reservas</a>
            <a href="{{ route('UserProfileVista') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Perfil</a>
        </div>
    </div>
    <!-- Mobile Navbar -->
   <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
            <div class="flex items-center">
                <a href="{{ route('usuarios.index') }}" class="bg-white rounded-full p-1">
                    <img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="Home Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('cart.index') }}">
                    <img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="Cart Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('reservations.index') }}">
                    <img class="w-6" src="{{ asset('imgs/FavIcon.png') }}" alt="Favorites Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('UserProfileVista') }}">
                    <img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="Profile Icon" />
                </a>
            </div>
        </div>
    </div>

    <main class="p-4">
        <div class="w-full bg-white p-8 rounded-lg shadow-lg">
            <div class="text-center md:font-bold text-[2rem] md:text-[4rem] ">
                Mis Reservas
            </div>

            <div class="space-y-4">

                <!--INICIO DE RESERVA-->
                @foreach ($reservations as $reservation)
                <div
                    class="p-4 border border-gray-200 rounded-lg  justify-between md:flex-row md:items-center transition duration-300 hover:bg-gray-50">

                    <h2 class=" text-lg md:text-[2rem] font-bold text-gray-800 mb-[12px]">Reserva #{{ $reservation->created_at }}</h2>
                    <p class="text-sm md:text-[1.5rem] text-gray-600 font-semibold mb-[8px]">Total: ${{ $reservation->total }}</p>

                    @foreach ($reservation->items as $item)
                <!--INICIO DE CARTA-->
                <div
                    class="my-2 p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                    <div class="flex items-center">
                        <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Imagen del producto"
                        class="object-cover w-16 h-16 md:w-[10rem] md:h-[10rem] rounded-md mr-4">
                        <div>
                            <h2 class=" text-lg md:text-[2rem] font-bold text-gray-800 mb-[12px]">Reserva #</h2>
                            <p class="text-sm md:text-[1.5rem] text-gray-600 font-semibold mb-[8px]">Subtotal: ${{ $item->subtotal }}</p>
                        </div>
                    </div>
                    <span class="px-3 w-fit py-1 md:py-[1rem] md:px-[2rem] text-sm md:text-[1rem] font-semibold bg-green-200 text-green-800 rounded">Listo
                        para entregar</span>
                </div>
                @endforeach
                <!--FIN DE CARTA-->
                </div>
                @endforeach
                <!--FIN DE SEGMENTO DE RESERVA-->


            </div>
        </div>

    </main>
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
