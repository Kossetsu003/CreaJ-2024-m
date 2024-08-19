


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Inicio</title>
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


    <div class="mx-auto  mt-10 mb-32 "> <!-- Añadido un margen inferior -->


         <!--INICIO DE NAVBAR MOBIL-->
        <div class="bottom-bar fixed bottom-[1%] left-0 right-0 flex justify-center md:hidden">
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around ">
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

        <!-- Agregar un margen superior al contenido principal igual a la altura de la barra de navegación -->
        <div> <!-- Puedes ajustar este valor según sea necesario -->
            <div class="flex justify-between mt-5">
                <div class="ml-[2%]">
                    <h1>Hola! Bienvenido &#x1F44B;</h1>
                    <h3 class="text-blue-800 font-bold">Administrador General</h3>
                </div>
                <div class="mr-[5%] mt-4">
                    <img class=" rounded-full w-12" src="{{ asset('imgs/MiCarritoUser.png') }}" alt="User Icon">
                </div>
            </div>



        <!--<div class="mt-5">
                <img class="w-[100%]" src="{{ asset('imgs/PortadaMiniShop.png') }}" alt="User Icon">
            </div>-->
            <div class="w-screen hidden md:block">
                <img class="w-full h-[35rem] object-cover" src="{{ asset('imgs/mercadolatiendona.png') }}" alt="Banner Image">
            </div>

            <div class="flex mt-5 justify-around w-[90%] mx-auto">
                <a href="{{ route('admin.crearmercados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">

                    <span class="flex items-center px-3 py-2  rounded-md">
                        <img class="w-7 mr-2" src="{{ asset('imgs/AddIcon.png') }}" alt="User Icon">
                        Agregar Mercado
                    </span>
                </a>



            </div>

            

            <div class="flex justify-center mt-5 flex-col items-center">

                @foreach ($mercadoLocals as $mercadoLocal)
                <!--INICIO DE PLANTILLA-->
                <a href="{{ route('admin.vermercados',$mercadoLocal->id) }}" class="md:w-[30%] w-[80%] rounded-md  border-gray-200 mb-4 ">
                    <div>
                        <img class="w-[100%] rounded-t-lg" src="{{ asset('imgs/'.$mercadoLocal->imagen_referencia) }}" alt="{{ $mercadoLocal->imagen_referencia }}">
                        <div class="text-center mt-2">
                            <h1 class="text-sm font-bold">{{ $mercadoLocal->nombre }}</h1>
                            <h3 class="w-[85%] mx-auto text-xs text-justify pb-5">El {{ $mercadoLocal->nombre }} se encuentra en {{ $mercadoLocal->ubicacion }}, en el municipio de {{ $mercadoLocal->municipio }}. En el horario siguiente: {{ $mercadoLocal->horaentrada }} - {{ $mercadoLocal->horasalida }}. {{ $mercadoLocal->descripcion }}</h3>
                        </div>
                    </div>
                    <div class=" flex justify-between space-x-4 p-4 ">
                        <!--EDITAR-->
                        <a class=" text-white text-xs px-3 py-2 rounded z-[2] btn btn-sm btn-success bg-purple-400 " href="{{ route('admin.editarmercados',$mercadoLocal->id) }}">Editar</a>

                    <!--ELIMINAR-->
                        <form action="{{ route('admin.eliminarmercados',$mercadoLocal->id) }}" method="POST" class="relative">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=" bg-red-500 text-white text-xs px-3 py-2 rounded btn btn-danger btn-sm z-[3] "><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                        </form>
                    </div>
                </a>
                @endforeach
                
                <!--FIN DE PLANTILLA -->
            </div>
        </div>
    </div>
    {!! $mercadoLocals->links() !!}
</body>
</html>
