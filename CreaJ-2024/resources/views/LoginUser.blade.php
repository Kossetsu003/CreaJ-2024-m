<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>LoginTest</title>
    
</head>

<body>
    <section class="pl-5 pt-7">
        <div class="login">
            <div class="flex items-center">
                <div class="title">
                    <h2 class="font-bold">Login Account</h2>
                </div>
                <div class="icon">
                    <img class="w-4 ml-2 pt-1" src="{{ asset('imgs/usuario.png') }}" alt="User Icon">
                </div>
            </div>
            <h3 class="text-xs font-bold">Welcome Back MiniShop!</h3>
        </div>

        <div class="w-72 h-96 mt-28 mx-auto">
            <div class="text-center">
                <h1 class="text-3xl font-bold">Mini<span class="text-purple-400 font-bold">Shop</span></h1>
            </div>

            <div class="flex flex-col mt-6">
                <div class="flex justify-center">
                    <input class="border rounded w-80 h-9 pl-5 text-sm border-gray-400" type="text" placeholder="Enter email">
                </div>
                <div class="flex justify-center mt-2">
                    <input class="border rounded w-80 h-9 pl-5 text-sm border-gray-400" type="password" placeholder="Enter Password">
                </div>

                <div class="mt-2 flex justify-end">
                    <h3 class="text-xs font-bold">&nbsp;</h3>
                </div>
            </div>

            <div class="flex justify-center mt-5">
                <button class="bg-purple-400 w-72 h-10 rounded-md text-white">Iniciar Sesion</button>
            </div>

            <div class="mt-11">
                <h3 class="text-center text-sm">¿Aún no se ha regitrado? <a href="./RegistroUser" class="text-blue-950 font-bold">Crear Cuenta</a></h3>
            </div>
        </div>
    </section>
</body>

</html>
