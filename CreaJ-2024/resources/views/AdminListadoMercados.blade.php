

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Home Mercado User</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
     <!-- Desktop Navbar -->
     <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">

        <a href="{{ route('admin.index') }}">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black">
            Admin <span class="text-blue-600"><b>Shop</b></span>
        </h1>
        </a>

        <div class="flex gap-8">
            <a href="{{ route('admin.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Mercados</a>
            <a href="{{ route('admin.vendedores') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Vendedores</a>
            <a href="{{ route('admin.clientes') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Clientes</a>
            <a href="{{ route('AdminProfileVista')}}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Perfil</a>
        </div>
    </div>

    <div class="mx-auto max-w-lg mt-10 mb-32"> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
            <!--INICIO DE NAVBAR MOBIL-->
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
                <div class="flex items-center  ">
                    <a href="{{ route('admin.index') }}" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="{{ route('admin.vendedores') }}"><img class="w-6" src="{{ asset('imgs/VendedorIcon.png') }}" alt="User Icon"></a>
                </div>

                <div class="flex items-center">
                    <a href="{{ route('admin.clientes') }}" ><img class="w-6" src="{{ asset('imgs/ClienteIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="./AdminEstadoPedidos" ><img class="w-6" src="{{ asset('imgs/ReservasIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
<?php $id = 1; ?>
                    <a href="{{ route('AdminProfileVista')}}"  ><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>

                </div>
            </div>

            <!--FIN DE NAVBAR MOBIL-->
        </div>

        <div class="mt-14  w-[90%] mx-auto">

            <div class="flex justify-between  w-[90%] mx-auto"> <!--Contenedor Principal-->
                <div>
                    <h1>
                        {{ $mercadoLocal->nombre }}
                    </h1>
                    <div >
                        <b>{{ $mercadoLocal->municipio }}</b>, <br> {{ $mercadoLocal->ubicacion }}
                    </div>
                </div>

                <div>
                    <img class="w-12 rounded-full " src="{{ asset('imgs/PerfilJuana.jpg') }}" alt="User Icon">
                </div>
            </div><!--Fin Principal-->



        <div class="flex items-center mt-5 ">
                    <!-- Campo de búsqueda con icono de lupa -->
                <div class="relative w-[70%] ml-5">
                    <img class="absolute left-2 top-1/2 transform -translate-y-1/2 w-5 h-5" src="{{ asset('imgs/lupa.png') }}" alt="Search Icon">
                    <input class="pl-8 px-2  w-[100%] border rounded-md border-gray-500 py-1 focus:outline-none" type="text" placeholder="Buscar">
                </div>


                <!-- Botón azul -->
                <div class="mr-5 pl-2">
                    <button class="bg-blue-600 rounded-md px-2 py-1 h-[100%] ml-1"> <!-- Reduje el margen izquierdo a 1 -->
                        <img class="w-6 "   src="{{ asset('imgs/SettingIcon.png') }}" alt="User Icon">
                    </button>
                 </div>
        </div>
        <h1 class="justify-center text-bold text-center pt-6 text-[1.5rem]">Vendedores en {{ $mercadoLocal->nombre }} : </h1>


        <!--CATEGORIAS-->

        <div class="flex ">
            <div class="flex ">
                <p class="flex items-center h-[3rem] border  rounded-md  text-[1rem] bg-blue-300 border-blue-300 text-white font-bold">
                    <img class="w-[3rem]" src="{{ asset('imgs/SelectBox.png') }}" alt="User Icon">
                    <span class="ml-1">Todos Los puestos</span>
                </p>

                <button class="flex items-center border text-black px-1 py-0.5 rounded-md mr-2 text-xs ">
                    <img class="w-5" src="{{ asset('imgs/ClotheSelected.png') }}" alt="User Icon">
                    <span class="ml-1">Ropa</span>
                </button>

                <button class="flex items-center border text-black px-1 py-0.5 rounded-md text-xs hover:bg-blue-200 hover:text-white">
                    <img class="w-5" src="{{ asset('imgs/FoodSelected.png') }}" alt="User Icon">
                    <span class="ml-1">Comida</span>
                </button>
            </div>
        </div>

        <!--FIN DE CATEGORIAS-->

        <div class="flex flex-wrap justify-center mt-5 text-sm">

          @foreach ($vendedors as $vendedor)
            <a href="./ProductosUser" class="w-[48%] mb-8 p-2">
                <img class="w-full h-[250px] rounded-md overflow-hidden object-cover" src="{{ asset('imgs/NaranjasQuintal.jpg') }}" alt="User Icon">
                <h3 class="font-bold mt-5">Puesto de {{ $vendedor->nombre }} {{ $vendedor->apellidos }}</h3>
                <h3 class="mb-2">Puesto #N {{ $vendedor->numero_puesto }}</h3>
                <div class="flex justify-between">
                    <h3>Correo : {{ $vendedor->usuario }}</h3>

                </div>
            </a>
            @endforeach





        </div>




    </div>
<!-- Paginación -->


</body>
</html>

