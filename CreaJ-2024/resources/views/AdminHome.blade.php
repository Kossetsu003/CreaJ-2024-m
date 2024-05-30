
@section('template_title')
    Mercado Local
@endsection


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

    <div class="mx-auto max-w-lg mt-10 mb-32 "> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center z-[100]">
            <!--INICIO DE NAVBAR MOBIL-->
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around z-[100]">
                <div class="flex items-center  ">
                    <a href="./UserHome" class=" bg-white rounded-full p-[0.25rem] "><img class="w-6" src="{{ asset('imgs/HomeSelectedIcon.png') }}" alt="User Icon"></a>
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

        <!-- Agregar un margen superior al contenido principal igual a la altura de la barra de navegación -->
        <div class="mt-10"> <!-- Puedes ajustar este valor según sea necesario -->
            <div class="flex justify-between mt-5">
                <div class="ml-[10%]">
                    <h1>Hola! Bienvenido &#x1F44B;</h1>
                    <h3 class="text-blue-800 font-bold">Sra. Maria Mercedes </h3>
                </div>
                <div class="mr-[10%] mt-4">
                    <img class=" rounded-full w-12" src="{{ asset('imgs/PerfilJuana.jpg') }}" alt="User Icon">
                </div>
            </div>

            <div class="text-center mt-5">
                <h1 class="text-[60px] font-bold">Mini <span class="text-blue-600 font-bold">Shop</span></h1>
            </div>

            <div class="mt-5">
                <img class="w-[100%]" src="{{ asset('imgs/PortadaMiniShop.png') }}" alt="User Icon">
            </div>

            <div class="flex mt-5 justify-around w-[90%] mx-auto">
                <a href="{{ route('admin-mercado-locals.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">

                    <span class="flex items-center px-3 py-2  rounded-md">
                        <img class="w-7 mr-2" src="{{ asset('imgs/AddIcon.png') }}" alt="User Icon">
                        Agregar Mercado
                    </span>
                </a>



            </div>

            <div class="flex justify-center mt-5 flex-col items-center">

                @foreach ($mercadoLocals as $mercadoLocal)
                <!--INICIO DE PLANTILLA-->

                <a href="{{ route('admin-mercado-locals.show',$mercadoLocal->id) }}" class="w-[80%] bg-gray-50 rounded-md border border-gray-200 mb-4">
                    <div>
                        <img class="w-[100%] rounded-t-lg" src="{{ asset('imgs/MercadoExCuartel.jpg') }}" alt="User Icon">
                        <div class="text-center mt-2">
                            <h1 class="text-sm font-bold">{{ $mercadoLocal->nombre }}</h1>
                            <h3 class="w-[85%] mx-auto text-xs text-justify pb-5">El {{ $mercadoLocal->nombre }} se encuentra en {{ $mercadoLocal->ubicacion }}, en el municipio de {{ $mercadoLocal->municipio }}. En el horario siguiente: {{ $mercadoLocal->horaentrada }} - {{ $mercadoLocal->horasalida }}. {{ $mercadoLocal->descripcion }}</h3>




                        </div>


                    </div>
                    <div class="flex justify-center item-center">
                        <!--EDITAR-->
                        <a class="bg-orange-500 text-white text-xs px-3 py-2 rounded z-[2] btn btn-sm btn-success" href="{{ route('mercado-locals.edit',$mercadoLocal->id) }}">Editar</a>

                    <!--ELIMINAR-->
                        <form action="{{ route('mercado-locals.destroy',$mercadoLocal->id) }}" method="POST" class="relative">
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
