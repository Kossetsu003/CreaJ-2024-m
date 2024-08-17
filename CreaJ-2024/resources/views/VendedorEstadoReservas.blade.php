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
        <a href="{{ route('vendedores.index') }}">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold">
             Mini <span class="text-orange-600"><b>Vendedores</b></span>
        </h1>
        </a>
        <div class="flex gap-8">
             <a href="{{ route('vendedores.index') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mi Puesto</a>
            <a href="{{ route('vendedores.productos') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mis Productos</a>
            <a href="{{ route('vendedores.reservas') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mi Reservas</a>
            <a href="{{ route('vendedores.historial') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mis Historial</a>
            <a href="{{ route('VendedorProfileVista') }}"
                class="font-semibold uppercase text-sm lg:text-base hover:text-white hover:bg-black border border-black px-2 py-1 rounded-md">
                    Perfil
                </a>
        </div>
    </div>
    <!-- Mobile Navbar -->
   <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
            <div class="flex items-center">
                <a href="{{ route('vendedores.index') }}" class="bg-white rounded-full p-1">
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
            <div class="flex justify-between mt-5">
                <div class="ml-[2%]">
                    <h1 class="md:text-[1.5rem] text-[1rem]">{{ $vendedor->nombre_del_local }} en <span class="font-semibold"> {{ $vendedor->mercadoLocal->nombre}}</span>&#128178;</h1>
                    <h3 class="text-orange-800 font-bold text-[1rem]">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</h3>
                </div>
                <div class="md:hidden mr-[5%] mt-4 rounded-full w-[8rem] h-[8rem] ">
                    <img class="rounded-full object-cover " src="{{ asset('imgs/'.$vendedor->imagen_de_referencia) }}" alt="User Icon">
                </div>
            </div>
            <div class="text-center md:font-bold text-[2rem] md:text-[4rem] ">
                Mis Reservas
            </div>

            <div class="space-y-4">
                {{ $id; }}


                <!--INICIO DE RESERVA-->
                @if ($reservations->isEmpty())
    <span class="text-center justify-center flex text-[1.75rem] text-gray-600 my-[7rem]">No hay Reservas Pendientes</span>
@else
    @foreach ($reservations as $reservation)
        @if ($reservation->estado != 'entregado')
            <!-- Contenedor principal de la reserva -->
            <div class="p-4 border border-gray-200 rounded-lg justify-between md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                <h2 class="text-lg md:text-[2rem] font-bold text-gray-800 mb-[12px]">
                    Reserva:
                    <span class="px-2 uppercase w-fit py-0.5 md:py-[1rem] md:px-[2rem] text-s md:text-[1rem] font-semibold bg-yellow-200 text-yellow-800 rounded">
                        @if ($reservation->estado == 'enviado')
                            Recibido
                        @endif
                    </span>
                </h2>

                <h2 class="text-lg md:text-[2rem] font-semibold text-gray-800 mb-[12px]">
                    <span class="font-bold">Pedido Por:</span> {{ $reservation->user->nombre }} {{ $reservation->user->apellido }}
                </h2>

                <p class="text-sm md:text-[1.5rem] text-gray-600 font-bold mb-[8px]">Total: ${{ $reservation->total }}</p>

                <!-- Iteración sobre los items de la reserva -->
                @foreach ($reservation->items as $item)
                    <!-- Contenedor de cada item de la reserva -->
                    <div class="my-2 p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                        <div class="flex items-center flex-1">
                            <img src="{{ asset('imgs/'. $item->product->imagen_referencia) }}" alt="{{  $item->product->imagen_referencia }}" class="object-cover w-16 h-16 md:w-[10rem] md:h-[10rem] rounded-md mr-4">
                            <div>
                                <h2 class="text-lg md:text-[2rem] font-semibold text-gray-800 mb-[12px]">
                                    <span class="font-bold">
                                        {{ $item->nombre }}
                                    </span>
                                </h2>
                                <p class="text-sm md:text-[1.25rem] text-gray-600 mb-[8px]">
                                    <b>Cantidad:</b> {{ $item->quantity }}
                                </p>
                                <p class="text-sm md:text-[1.25rem] text-gray-600 mb-[8px]">
                                    <b>Precio (c/u):</b> ${{ $item->precio }}
                                </p>
                                <p class="text-sm md:text-[1.5rem] text-gray-600 mb-[8px]">
                                    <b>Subtotal:</b> ${{ $item->subtotal }}
                                </p>
                            </div>
                        </div>

                        <!-- Formulario siempre visible -->
                        <div class="mt-4">
                            <h2 class="text-xl font-bold mb-4 text-center">¿El pedido está listo?</h2>
                            <form action="{{ route('vendedores.publicar-estado-reserva', $item->id) }}" method="POST">
                                @csrf
                                <!-- Input oculto para enviar el estado -->
                                <input type="hidden" name="estado" id="estado" value="">

                                <div class="flex justify-between ">
                                    <!-- Botón para "Mi Pedido Está Listo" -->
                                    <button type="button" onclick="setEstado('en_entrega')" class="bg-green-500 hover:bg-green-700 mx-4 text-white font-bold py-2 px-4 rounded">
                                        Mi Pedido Está Listo
                                    </button>

                                    <!-- Botón para "Ya No Hay Existencias" -->
                                    <button type="button" onclick="setEstado('sin_existencias')" class="mx-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Ya No Hay Existencias
                                    </button>
                                </div>
                            </form>
                        </div>

                        <script>
                            function setEstado(value) {
                                // Establece el valor del input oculto con el estado seleccionado
                                document.getElementById('estado').value = value;
                                // Envía el formulario
                                document.querySelector('form').submit();
                            }
                        </script>


                    </div>
                @endforeach
                <!-- Fin de iteración de los items -->
            </div>
            <!-- Fin del contenedor principal de la reserva -->
        @endif
    @endforeach
@endif

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
