
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



  <div class="mx-auto max-w-lg"> <!-- Añadido un margen inferior -->
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
            <?php $id = 1; ?>
                    <a href="{{ route('AdminProfileVista')}}"  ><img class="w-6" src="{{ asset('imgs/UserIcon.png') }}" alt="User Icon"></a>
                </div>
            </div>
            <!--FIN DE NAVBAR MOBIL-->
        </div>
    </div>

    <main class="p-4">
        <div class="w-full bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Lista de Vendedores</h1>
            <a class="bg-orange-500 text-white text-xs px-8 py-2 rounded z-[2] btn btn-sm btn-success" href="{{ route('admin.crearvendedores') }}">Agregar Vendedores</a>

            <div class="space-y-4">
                @foreach ($vendedors as $vendedor)
              <div class="p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                <div class="flex items-center">
                  <img src="{{ asset('imgs/'. $vendedor->imagen_de_referencia) }}" alt="t" class="w-40 h-40 rounded-md mr-4 object-cover">
                  <div>
                    <h2 class="text-lg font-semibold text-gray-800">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</h2>
                    <p >Puesto N {{ $vendedor->numero_puesto }} en el <b>{{ $vendedor->mercadoLocal->nombre }}</b></p>
                    <h2 class="text-sm text-gray-600"><b>Numero de Telefono:</b> {{ $vendedor->telefono }}</h2>
                    <p class="text-sm text-gray-600"><b>Correo Electronico : </b>{{ $vendedor->usuario }}</p>
                  </div>
                </div>
                <div class="flex">
                    <form action="{{ route('admin.eliminarvendedores',$vendedor->id) }}" method="POST">

                  <a class="btn btn-sm btn-primary px-3 py-2 text-sm font-medium text-white bg-orange-500 rounded-md hover:bg-orange-600 " href="{{ route('admin.vervendedores',$vendedor->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>

                  <a class="btn btn-sm btn-success px-3 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600" href="{{ route('admin.editarvendedores',$vendedor->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>

                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm px-3 py-2 text-sm font-medium text-white bg-red-500 rounded-md ml-2 hover:bg-red-600"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                    </form>
                </div>
              </div>
              @endforeach


            </div>
          </div>

    </main>

</body>
</html>

