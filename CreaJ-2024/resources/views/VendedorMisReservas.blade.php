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
        <div
        class="hidden md:flex p-4 bg-white items-center justify-between shadow-md"
    >
        <a href="{{ route('usuarios.index') }}">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black">
             Mini <span class="text-blue-600"><b>Shop</b></span>
        </h1>
        </a>
        <div class="flex gap-8">
            <a
                href="./VendedorHome"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300"
                >Home</a
            >
            <a
                href="./VendedorMiBuzon"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300"
                >Buzon</a
            >
            <a
                href="./VendedorMisReservas"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300"
                >Reservas</a
            >
            <a
                href="./VendedorProfileVista"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300"
                >Perfil</a
            >
        </div>
    </div>
    <!-- Mobile Navbar -->
   <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
            <div class="flex items-center">
                <a href="./VendedorHome" class="bg-white rounded-full p-1">
                    <img
                        class="w-6"
                        src="{{ asset('imgs/HomeSelectedIcon.png') }}"
                        alt="Home Icon"
                    />
                </a>
            </div>
            <div class="flex items-center">
                <a href="./VendedorMiBuzon">
                    <img
                        class="w-6"
                        src="{{ asset('imgs/BuzonIcon.png') }}"
                        alt="Cart Icon"
                    />
                </a>
            </div>
            <div class="flex items-center">
                <a href="./VendedorMisReservas">
                    <img
                        class="w-6"
                        src="{{ asset('imgs/ReservasIcon.png') }}"
                        alt="Favorites Icon"
                    />
                </a>
            </div>
            <div class="flex items-center">
                <a href="./VendedorProfileVista">
                    <img
                        class="w-6"
                        src="{{ asset('imgs/UserIcon.png') }}"
                        alt="Profile Icon"
                    />
                </a>
            </div>
        </div>
    </div>
    <main class="p-4">
        
        <div class="w-full bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Lista de Reservas</h1>

            <div class="space-y-4">
              <div class="p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                <div class="flex items-center">
                  <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Imagen del producto" class="w-16 h-16 rounded-md mr-4">
                  <div>
                    <h2 class="text-lg font-semibold text-gray-800">Reserva #1</h2>
                    <p class="text-sm text-gray-600">Fecha: 25 de Mayo, 2024</p>
                  </div>
                </div>
                <span class="px-3 w-fit py-1 text-sm font-semibold bg-green-200 text-green-800 rounded-full">Listo para entregar</span>
              </div>

              <div class="p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                <div class="flex items-center">
                  <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Imagen del producto" class="w-16 h-16 rounded-md mr-4">
                  <div>
                    <h2 class="text-lg font-semibold text-gray-800">Reserva #2</h2>
                    <p class="text-sm text-gray-600">Fecha: 25 de Mayo, 2024</p>
                  </div>
                </div>
                <span class="px-3 w-fit py-1 text-sm font-semibold bg-gray-200 text-gray-800 rounded-full">Entregado</span>
              </div>

              <div class="p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                <div class="flex items-center">
                  <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Imagen del producto" class="w-16 h-16 rounded-md mr-4">
                  <div>
                    <h2 class="text-lg font-semibold text-gray-800">Reserva #</h2>
                    <p class="text-sm text-gray-600">Fecha: 23 de Mayo, 2024</p>
                  </div>
                </div>
                <span class="px-3 w-fit py-1 text-sm font-semibold bg-yellow-200 text-yellow-800 rounded-full">En Proceso</span>
              </div>
            </div>
          </div>

    </main>
</body>
</html>
