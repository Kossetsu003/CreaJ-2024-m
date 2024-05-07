<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
    <title>Registrar Usuario</title>
</head>
<body>
   <section>
    <form action="#" method="post">
        <div class="pl-5 pt-7 mt-9"> <!-- Contenedor de Login -->
            <div class="login flex items-center">
                <div class="title">
                    <h2 class="font-bold">Registrar Cuenta</h2>
                </div>
                <div class="icon">
                    <img class="w-4 ml-2 pt-1" src="../imgs/usuario.png" alt="User Icon">
                </div>
            </div>
            <h3 class="text-xs font-bold">¡Bienvenido a MiniShop!</h3>
        </div>

        <div class="w-72 h-96 mt-16 mx-auto"> <!-- Contenedor Principal -->
            <div class="text-center"> <!-- Contenedor Mini Shop -->
                <h1 class="text-5xl font-bold">Mini<span class="text-purple-400 font-bold">Shop</span></h1>
            </div>

            <div class="flex flex-col mt-6"> <!-- Contenedor De Inputs -->
                <input class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2" type="email" placeholder="Ingrese su Correo Electrónico" required>
                <input class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2" type="text" placeholder="Ingrese sus Nombres" required>
                <input class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2" type="text" placeholder="Ingrese su Apellido" required>
                <input class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2" type="text" placeholder="Ingrese su Número de Teléfono" required>
                <select class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 text-gray-400" required>
                    <option value="NULL" class="">Escoga su Género</option>
                    <option value="Masc">Género: Masculino</option>
                    <option value="Fem">Género: Femenino</option>
                </select>
                <input class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2" type="password" placeholder="Escriba su Contraseña" required>
                <input class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2" type="password" placeholder="Escriba de nuevo su Contraseña" required>

                <div class="flex justify-end mt-2"> <!-- Contenedor de forgot password -->
                    <h3 class="text-sm font-bold"><a href="./LoginUser">Ya tengo cuenta</a></h3>
                </div>
            </div>

            <div class="flex justify-center mt-5">
                <button type="submit" class="bg-purple-400 w-72 h-10 flex items-center justify-center gap-x-2 rounded-md px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-purple-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-opacity-50">Registrarse</button>
            </div>
        </div>
    </form>
</section>


</body>
</html>
