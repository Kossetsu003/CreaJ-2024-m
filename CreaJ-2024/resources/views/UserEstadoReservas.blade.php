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
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold">
             Mini <span class="text-blue-600"><b>Shop</b></span>
        </h1>
        </a>
        <div class="flex gap-8">
            <a href="{{ route('usuarios.index') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Hogar</a>
            <a href="{{ route('usuarios.carrito') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Carrito</a>
            <a href="{{ route('usuarios.reservas') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Reservas</a>
            <a href="{{ route('UserProfileVista') }}"class="font-semibold uppercase text-sm lg:text-base hover:text-white hover:bg-black border border-black px-2 py-1 rounded-md">
                    Perfil
                </a>
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
                <a href="{{ route('usuarios.carrito') }}">
                    <img class="w-6" src="{{ asset('imgs/CarritoIcon.png') }}" alt="Cart Icon" />
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('usuarios.reservas') }}">
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
                @if ($reservations->isEmpty())
                <span class="text-center justify-center flex text-[1.75rem] text-gray-600 my-[7rem]">No hay Reservas Todavía</span>
            @else
                <!-- INICIO DE RESERVA -->
                @foreach ($reservations as $reservation)
                    <div class="p-4 border border-gray-200 rounded-lg justify-between md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                        <h2 class="text-lg md:text-[2rem] font-bold text-gray-800 mb-[12px]">Reserva:
                            @if ($reservation->estado == 'enviado')
                                <span class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-green-200 text-green-800 rounded">
                                    {{ $reservation->estado }}
                                </span>
                            @elseif ($reservation->estado == 'sin_existencias')
                                <span class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-red-200 text-red-800 rounded">
                                    Sin Existencias
                                </span>
                            @elseif ($reservation->estado == 'en_entrega')
                                <span class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-orange-200 text-orange--800 rounded">
                                    En Entrega
                                </span>
                            @endif
                        </h2>
                        <p class="text-sm md:text-[1.5rem] text-gray-600 font-bold mb-[8px]">Total: ${{ $reservation->total }}</p>

                        @foreach ($reservation->items as $item)
                            <!-- INICIO DE CARTA -->
                            <div class="my-2 p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                                <div class="flex items-center">
                                    <img src="{{ asset('imgs/'. $item->product->imagen_referencia) }}" alt="{{  $item->product->imagen_referencia }}" class="object-cover w-16 h-16 md:w-[10rem] md:h-[10rem] rounded-md mr-4">
                                    <div>
                                        <h2 class="text-lg md:text-[2rem] font-semibold text-gray-800 mb-[12px]"><span class="font-bold">{{ $item->product->name }}</span> en {{ $item->product->vendedor->nombre_del_local }}</h2>
                                        <p class="text-sm md:text-[1.25rem] text-gray-600 mb-[8px]"><b>Cantidad:</b> {{ $item->quantity }}</p>
                                        <p class="text-sm md:text-[1.25rem] text-gray-600 mb-[8px]"><b>Precio (c/u):</b> ${{ $item->precio }}</p>
                                        <p class="text-sm md:text-[1.5rem] text-gray-600 mb-[8px]"><b>Subtotal:</b> ${{ $item->subtotal }}</p>
                                    </div>

                                    @if ($item->estado == 'sin_existencias')
                                        <h2 class="text-xl font-bold mb-4 text-center">Ahorita no hay existencias. ¿Esperará?</h2>
                                        <form id="form-{{ $item->id }}" action="{{ route('vendedores.publicarestadoreserva', $item->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="estado" id="estado-{{ $item->id }}" value="">

                                            <div class="flex justify-between">
                                                <button type="button" onclick="setEstado('{{ $item->id }}', 'en_espera')" class="bg-green-500 hover:bg-green-700 mx-4 text-white font-bold py-2 px-4 rounded">
                                                    Esperaré
                                                </button>

                                                <button type="button" onclick="setEstado('{{ $item->id }}', 'sin_espera')" class="mx-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    No Esperaré
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <!-- FIN DE CARTA -->
                        @endforeach
                    </div>
                @endforeach
                <!-- FIN DE RESERVA -->
            @endif

            <script>
                function setEstado(itemId, estado) {
                    // Establece el valor del input oculto con el estado seleccionado
                    document.getElementById('estado-' + itemId).value = estado;
                    // Envía el formulario correspondiente
                    document.getElementById('form-' + itemId).submit();
                }
            </script>

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
