
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>EditarPuesto Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>

    <!-- Desktop Navbar -->
    <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">

        <a href="{{ route('admin-mercado-locals.index') }}">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black">
            Admin <span class="text-blue-600"><b>Shop</b></span>
        </h1>
        </a>

        <div class="flex gap-8">
            <a href="{{ route('admin-mercado-locals.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Mercados</a>
            <a href="{{ route('admin-vendedors.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Vendedores</a>
            <a href="{{ route('admin-clientes.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Clientes</a>
            <a href="{{ route('AdminProfileVista')}}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Perfil</a>
        </div>
    </div>




     <div class="mx-auto max-w-lg mt-10"> <!-- Añadido un margen inferior -->
        <!--INICIO DE NAVBAR MOBIL-->
        <div class="bottom-bar fixed bottom-[1%] left-0 right-0 flex justify-center md:hidden">
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around ">
                <div class="flex items-center  ">
                    <a href="{{ route('admin-mercado-locals.index') }}" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('admin-vendedors.index') }}"><img class="w-6" src="{{ asset('imgs/VendedorIcon.png') }}" alt="User Icon"></a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('admin-clientes.index') }}" ><img class="w-6" src="{{ asset('imgs/ClienteIcon.png') }}" alt="User Icon"></a>
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

            <!--FIN DE NAVBAR MOBIL-->
        </div>
                    <h2 class="text-center text-[3.5rem]"><b>Listado de Clientes</b></h2>


            <div>
                @foreach ($clientes as $cliente)
                <div class="mt-[5%] mx-auto md:ml-[15rem] ml-[1rem] md:mr-[15rem] mr-[1rem] flex shadow-lg ">
                    <img class="w-28 rounded-lg h-28" src="{{ asset('imgs\AguacateQuintal.jpg') }}" alt="User Icon">
                    <div class="ml-2 ">
                        <h3 class="text-sm font-bold">Vendedor :{{ $cliente->nombre }} {{ $cliente->apellido }}</h3>
                        <h3 class="text-xs ">Con Correo Electronico : {{ $cliente->usuario }}</h3>
                        <h3 class="text-xs ">Numero de Telefono : {{ $cliente->telefono }}</h3>
                        <div class="mt-1 mr-5 gap-2 mb-2 ">
                            <form action="{{ route('admin-clientes.destroy',$cliente->id) }}" method="POST">

                                @csrf
                                 @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm bg-red-500 text-white text-xs px-3 py-2 rounded">Eliminar Usuario</button>
                            </form>

                        </div>
                    </div>

                </div>


                @endforeach






        </div>
    </div>

</body>
</html>

