
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
  <div class="mx-auto max-w-lg"> <!-- Añadido un margen inferior -->
        <div class="bottom-bar fixed bottom-[5%] left-0 right-0 flex justify-center">
            <!--INICIO DE NAVBAR MOBIL-->
            <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
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
    </div>

    <main class="p-4">
        <div class="w-full bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Lista de Vendedores</h1>

            <div class="space-y-4">
                @foreach ($vendedors as $vendedor)
              <div class="p-4 border border-gray-200 rounded-lg flex flex-col justify-between gap-2 md:flex-row md:items-center transition duration-300 hover:bg-gray-50">
                <div class="flex items-center">
                  <img src="{{ asset('imgs/AguacateQuintal.jpg') }}" alt="Imagen del producto" class="w-16 h-16 rounded-md mr-4">
                  <div>
                    <h2 class="text-lg font-semibold text-gray-800">{{ $vendedor->nombre }} {{ $vendedor->apellidos }}</h2>
                    <p >Puesto N {{ $vendedor->numero_puesto }}</p>
                    <h2 class="text-sm text-gray-600"><b>Numero de Telefono:</b> {{ $vendedor->telefono }}</h2>
                    <p class="text-sm text-gray-600"><b>Correo Electronico : </b>{{ $vendedor->usuario }}</p>
                  </div>
                </div>
                <div class="flex">
                    <form action="{{ route('vendedors.destroy',$vendedor->id) }}" method="POST">

                  <a class="btn btn-sm btn-primary px-3 py-2 text-sm font-medium text-white bg-orange-500 rounded-md hover:bg-orange-600 " href="{{ route('admin-vendedors.show',$vendedor->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>

                  <a class="btn btn-sm btn-success px-3 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600" href="{{ route('admin-vendedors.edit',$vendedor->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>

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

