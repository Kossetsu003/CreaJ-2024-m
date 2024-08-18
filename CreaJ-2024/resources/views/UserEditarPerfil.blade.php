<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <title>Editar Perfil</title>
</head>

<body class="bg-gray-100 mb-24 md:mb-0">
    <!-- Desktop Navbar -->
    <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black">MiniShop</h1>
        <div class="flex gap-8">
            <a href="{{ route('usuarios.index') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Hogar</a>
            <a href="{{ route('usuarios.carrito') }}"
                class="font-bold uppercase text-sm lg:text-base hover:text-gray-300">Carrito</a>
            <a href="{{ route('usuarios.reservas') }}"
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

    <!-- Main Section -->
    <section class="flex justify-center md:mt-4 p-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl bg-white p-4 md:p-8 rounded-lg shadow-md">
            <div class="text-center mb-2">
                <h1 class="text-3xl font-bold text-gray-800">Editar <span class="text-purple-500">Perfil</span></h1>
            </div>

            <form method="POST" role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf

                <input type="hidden" name="ROL" value="4" id="r_o_l"
                    class="form-control @error('ROL') is-invalid @enderror">

                <!-- Información Personal -->
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Información Personal</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombres</label>
                            <input required type="text" name="nombre" id="nombre" placeholder="Nombres"
                                class="border rounded-lg border-gray-300 w-full h-10 pl-4 text-sm focus:ring focus:ring-purple-200 form-control @error('nombre') is-invalid @enderror">
                        </div>

                        <div>
                            <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                            <input required type="text" name="apellido" id="apellido" placeholder="Apellido"
                                class="border rounded-lg border-gray-300 w-full h-10 pl-4 text-sm focus:ring focus:ring-purple-200 form-control @error('apellido') is-invalid @enderror">
                        </div>

                        <div>
                            <label for="telefono" class="block text-sm font-medium text-gray-700">Número de
                                Teléfono</label>
                            <input required type="text" name="telefono" id="telefono"
                                placeholder="Número de Teléfono"
                                class="border rounded-lg border-gray-300 w-full h-10 pl-4 text-sm focus:ring focus:ring-purple-200 form-control @error('telefono') is-invalid @enderror">
                        </div>

                        <div>
                            <label for="sexo" class="block text-sm font-medium text-gray-700">Género</label>
                            <select name="sexo" id="sexo"
                                class="border rounded-lg border-gray-300 w-full h-10 pl-4 text-sm text-gray-500 focus:ring focus:ring-purple-200 form-control @error('sexo') is-invalid @enderror"
                                required>
                                <option value="" disabled selected>Escoga su Género</option>
                                <option value="Masc">Masculino</option>
                                <option value="Fem">Femenino</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Información de Acceso -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Información de Acceso</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="usuario" class="block text-sm font-medium text-gray-700">Correo
                                Electrónico</label>
                            <input required type="email" name="usuario" id="usuario"
                                placeholder="Correo Electrónico"
                                class="border rounded-lg border-gray-300 w-full h-10 pl-4 text-sm focus:ring focus:ring-purple-200 form-control @error('usuario') is-invalid @enderror">
                        </div>

                        <div>
                            <label for="contrasena" class="block text-sm font-medium text-gray-700">Contraseña</label>
                            <input required type="password" maxlength="8" name="contrasena" id="contrasena"
                                placeholder="Contraseña"
                                class="border rounded-lg border-gray-300 w-full h-10 pl-4 text-sm focus:ring focus:ring-purple-200 form-control @error('contrasena') is-invalid @enderror">
                        </div>

                        <div>
                            <label for="confirmar_contrasena"
                                class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                            <input required type="password" maxlength="8" name="confirmar_contrasena" id="confirmar_contrasena"
                                placeholder="Confirmar Contraseña"
                                class="border rounded-lg border-gray-300 w-full h-10 pl-4 text-sm focus:ring focus:ring-purple-200 form-control">
                        </div>
                    </div>
                </div>

                <div class="flex justify-center py-6">
                    <button type="submit"
                        class="bg-purple-500 w-full h-12 flex items-center justify-center rounded-lg text-sm font-semibold text-white shadow-md hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-opacity-50">
                        Actualizar Perfil
                    </button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>
