
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
        <!-- INFO DE ARRIBA COMO MOVIL -->
        <div class="pl-5"> <!-- Contenedor de Login -->
            <div class="login flex items-center">
                <div class="title">
                    <h2 class="font-bold">Registrar Cuenta</h2>
                </div>
                <div class="icon">
                    <img class="w-4 ml-2" src="../imgs/usuario.png" alt="User Icon">
                </div>
            </div>
            <h3 class="text-xs font-bold">¡Bienvenido a MiniShop!</h3>
        </div>

        <div id="registroExitoso" class="bg-green-500 text-white p-2 rounded text-center mt-4" style="display: none;">
            ¡Registro exitoso!
        </div>
        
        <!-- TITULO DE MINISHOP -->
        <div class="w-72 h-96 mt-16 mx-auto"> <!-- Contenedor Principal -->
            <div class="text-center"> <!-- Contenedor Mini Shop -->
                <h1 class="text-5xl font-bold">Mini<span class="text-purple-400 font-bold">Shop</span></h1>
            </div>

            <!-- FORMULARIO -->
            <form method="POST" action="{{route('register') }}" role="form" enctype="multipart/form-data">
                @csrf
                <!--ROL ES INVISIBLE-->
                <input type="hidden" name="ROL" value="4">

                <!-- Mostrar mensajes de error -->
             

                <div class="flex flex-col mt-6"> <!-- Contenedor De Inputs -->
                    <input required type="email" name="usuario" id="usuario" placeholder="Ingrese su Correo Electrónico" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2" value="{{ old('usuario') }}">
                    <input required type="text" name="nombre" id="nombre" placeholder="Ingrese sus Nombres" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2" value="{{ old('nombre') }}">
                    <input required type="text" name="apellido" id="apellido" placeholder="Ingrese su Apellido" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2" value="{{ old('apellido') }}">
                    <input required type="text" name="telefono" id="telefono" placeholder="Ingrese su Número de Teléfono" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2" value="{{ old('telefono') }}">
                    <select name="sexo" id="sexo" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 text-gray-400" required>
                        <option value="">Escoga su Género</option>
                        <option value="Masc" {{ old('sexo') == 'Masc' ? 'selected' : '' }}>Género: Masculino</option>
                        <option value="Fem" {{ old('sexo') == 'Fem' ? 'selected' : '' }}>Género: Femenino</option>
                    </select>
                    <input required type="password" name="contrasena" id="contrasena" placeholder="Escriba su Contraseña" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2">
                    <input required type="password" name="contrasena_confirmation" id="contrasena_confirmation" placeholder="Escriba de nuevo su Contraseña" class="border rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2">
                    
                    <div class="flex justify-end mt-2"> <!-- Contenedor de forgot password -->
                        <h3 class="text-sm font-bold"><a href="../LoginUser">Ya tengo cuenta</a></h3>
                    </div>
                </div>

                <div class="flex justify-center mt-5">
                    <button type="submit" class="bg-purple-400 w-72 h-10 flex items-center justify-center gap-x-2 rounded-md px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-opacity-50">Registrarse</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
<script src="../js/ComprobarContrasena.js"></script>

