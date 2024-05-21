<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Index</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
    <div class="md:flex h-screen">
        <div class="pt-7 md:border-4 md:bg-[#BDD7FF] md:w-[50%] md:flex md:flex-col md:justify-center">
            <div class="login pl-5">
                <div class="flex items-center">
                <div class="md:hidden"> <!-- Oculta el título en dispositivos móviles -->
                    <h1 class="font-bold">Iniciar Sesión</h1>
                </div>
                    <div class="md:hidden">
                        <img class="w-4 ml-2 pt-1" src="{{ asset('imgs/usuario.png') }}" alt="User Icon">
                    </div>
                </div>
                <div class="md:hidden">
                    <h3 class="text-xs font-bold">¡Bienvenidos a MiniShop!</h3>
                </div>

            </div>

            <div class="w-72 h-96 mt-10 mx-auto">
                <div class="text-center">
                    <h1 class="text-6xl font-bold">Mini<span class="text-[#3679F5] ml-3 font-bold">Shop</span></h1>
                </div>

                <div class="flex flex-col mt-5">
                    <div class="flex justify-center pt-5">
                        <input class="border rounded w-80 h-9 pl-5 text-sm border-gray-400 bg-transparent" type="email" name="email" id="email" placeholder="Ingrese su correo electrónico">
                    </div>
                    <div class="flex justify-center mt-2">
                        <input class="border rounded w-80 h-9 pl-5 text-sm border-gray-400 bg-transparent" type="password" name="password" id="password" placeholder="Ingrese su contraseña">
                    </div>

                    <div class="flex justify-end mt-3 pr-2">
                        <h3 class="text-xs font-bold">Forgot Password?</h3>
                    </div>
                </div>

                <div class="flex justify-center mt-5">
                    <button class="w-72 h-12 font-bold btn overflow-hidden relative bg-[#96A6E8] text-black py-2 px-4 rounded-xl">Iniciar Sesión</button>
                </div>

                <div class="mt-11">
                    <h3 class="text-center text-sm">¿Aún no se ha registrado? <a href="./clientes/create" class="text-blue-950 font-bold">Crear Cuenta</a></h3>
                </div>
            </div>
        </div>

        <div class="hidden md:flex md:flex-col md:items-center md:justify-center md:w-[50%] ">
            <div class="text-center mb-4">
                <h3 class="font-bold text-3xl">Login Account</h3>
            </div>
            <div class="flex justify-center">
                <img class="md:w-[75%] mx-auto" src="{{ asset('imgs/imagenindex.png') }}" alt="User Icon">
            </div>
            <div>
                <h3 class="font-bold text-xl">Welcome Back </h3>
                <h3 class="font-bold text-center text-xl">Mini Shop!</h3>
                
            </div>
        </div>
    </div>
</body>
</html>
