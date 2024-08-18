<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Registrar Vendedor</title>
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
</head>
<body>
    <section>
        <div class="w-72 h-auto mx-auto">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-red-500">Registrar vendedor</h1>
            </div>
            <form method="POST" action="{{ route('mercados.guardarvendedor') }}" role="form" enctype="multipart/form-data">
                @csrf
                <div class="pb-[7rem] mt-10 space-y-4">
                    <!-- Mensajes de Error Generales -->
                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-2 rounded mt-1 text-sm sm:text-sm text-center">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- INICIO DE INPUT DE LA FOTO -->
                    <div class="flex justify-between">
                        <label for="imagen_de_referencia" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative cursor-pointer">
                            <span id="file-name" class="text-gray-400 text-xs">Imagen de <b>Usted</b> o de <b>Su Puesto</b></span>
                            <input required type="file" accept=".png, .jpg, .jpeg" name="imagen_de_referencia" class="hidden" id="imagen_de_referencia">
                            {!! $errors->first('imagen_de_referencia', '<div class="text-red-500 text-xs mt-1">:message</div>') !!}
                            <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                        </label>
                    </div>
                    <!-- FIN DEL INPUT DE LA IMG -->

                    <!-- INICIO DE LA PREVIEW -->
                    <section>
                        <div>
                            <p class="text-gray-400 text-xs text-center">Su foto se vería así:</p>
                        </div>
                        <div class="mt-4">
                            <img id="img-preview" class="max-w max-h-xs hidden rounded-md border object-center" src="#" alt="Vista Previa de Imagen">
                        </div>
                    </section>
                    <!-- FIN DE LA PREVIEW -->

                    <!-- Campo de Correo Electrónico -->
                    <div class="flex justify-center">
                        <input required type="email" name="usuario" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('usuario') border-red-500 @enderror" value="{{ old('usuario') }}" id="usuario" placeholder="Escriba el correo electrónico">
                        @error('usuario')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Contraseña -->
                    <div class="flex justify-center">
                        <input type="password" name="password" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('password') border-red-500 @enderror" id="password" placeholder="Escriba su Contraseña">
                        @error('password')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Confirmación de Contraseña -->
                    <div class="flex justify-center">
                        <input required type="password" name="password_confirmation" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('password_confirmation') border-red-500 @enderror" id="password_confirmation" placeholder="Confirme su Contraseña">
                        @error('password_confirmation')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mostrar Contraseñas -->
                    <div class="flex justify-center mt-2">
                        <label class="flex items-center">
                            <input type="checkbox" id="show-passwords" class="mr-2">
                            <span class="text-xs text-gray-600">Mostrar Contraseñas</span>
                        </label>
                    </div>

                    <!-- Campo de Nombre -->
                    <div class="flex justify-center">
                        <input required type="text" name="nombre" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('nombre') border-red-500 @enderror" value="{{ old('nombre') }}" id="nombre" placeholder="Escriba el Nombre del Vendedor">
                        @error('nombre')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Apellidos -->
                    <div class="flex justify-center">
                        <input required type="text" name="apellidos" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('apellidos') border-red-500 @enderror" value="{{ old('apellidos') }}" id="apellidos" placeholder="Escriba los Apellidos del Vendedor">
                        @error('apellidos')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Nombre del Local -->
                    <div class="flex justify-center">
                        <input type="text" name="nombre_del_local" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('nombre_del_local') border-red-500 @enderror" value="{{ old('nombre_del_local') }}" id="nombre_del_local" placeholder="Digite el Nombre de su Local (Será Público)">
                        @error('nombre_del_local')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Teléfono -->
                    <div class="flex justify-center">
                        <input type="text" name="telefono" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('telefono') border-red-500 @enderror" value="{{ old('telefono') }}" id="telefono" placeholder="Digite el Teléfono del Vendedor">
                        @error('telefono')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Número de Puesto -->
                    <div class="flex justify-center">
                        <input required type="text" name="numero_puesto" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('numero_puesto') border-red-500 @enderror" value="{{ old('numero_puesto') }}" id="numero_puesto" placeholder="Escriba el Número Puesto">
                        @error('numero_puesto')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Clasificación -->
                    <div class="flex justify-center">
                        <select name="clasificacion" id="clasificacion" class="border bg-gray-100 rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 text-gray-400 @error('clasificacion') border-red-500 @enderror" required>
                            <option value="" class="font-bold text-xs text-white">Escoga su Clasificación</option>
                            <option value="comedor" {{ old('clasificacion') == 'comedor' ? 'selected' : '' }}>Comedor</option>
                            <option value="ropa" {{ old('clasificacion') == 'ropa' ? 'selected' : '' }}>Ropa</option>
                            <option value="granosbasicos" {{ old('clasificacion') == 'granosbasicos' ? 'selected' : '' }}>Granos Básicos</option>
                            <option value="artesanias" {{ old('clasificacion') == 'artesanias' ? 'selected' : '' }}>Artesanías</option>
                            <option value="mariscos" {{ old('clasificacion') == 'mariscos' ? 'selected' : '' }}>Mariscos</option>
                            <option value="carnes" {{ old('clasificacion') == 'carnes' ? 'selected' : '' }}>Carnes</option>
                            <option value="lacteos" {{ old('clasificacion') == 'lacteos' ? 'selected' : '' }}>Lácteos</option>
                            <option value="aves" {{ old('clasificacion') == 'aves' ? 'selected' : '' }}>Aves</option>
                            <option value="plasticos" {{ old('clasificacion') == 'plasticos' ? 'selected' : '' }}>Plásticos</option>
                            <option value="frutasyverduras" {{ old('clasificacion') == 'frutasyverduras' ? 'selected' : '' }}>Frutas y Verduras</option>
                            <option value="emprendimiento" {{ old('clasificacion') == 'emprendimiento' ? 'selected' : '' }}>Emprendimiento</option>
                            <option value="otros" {{ old('clasificacion') == 'otros' ? 'selected' : '' }}>Otros</option>
                        </select>
                        @error('clasificacion')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Mercado -->
                    <div class="flex justify-center mt-2">
                        <select name="fk_mercado" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 @error('fk_mercado') border-red-500 @enderror" id="fk_mercado">
                            @foreach($mercados as $mercado)
                                <option value="{{ $mercado->id }}" {{ old('fk_mercado') == $mercado->id ? 'selected' : '' }}>{{ $mercado->nombre }}</option>
                            @endforeach
                        </select>
                        @error('fk_mercado')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botón de Enviar -->
                    <div class="flex justify-center mt-16">
                        <button class="bg-red-600 w-72 h-10 text-white font-bold rounded-md">Registrar Vendedor</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
        document.getElementById('imagen_de_referencia').addEventListener('change', function(event) {
            const input = event.target;
            const preview = document.getElementById('img-preview');
            const fileNameSpan = document.getElementById('file-name');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);

                // Mostrar el nombre del archivo seleccionado
                fileNameSpan.textContent = input.files[0].name;
            } else {
                preview.src = '#';
                preview.classList.add('hidden');
                fileNameSpan.textContent = 'Imagen del Vendedor';
            }
        });
    </script>
    <script>
        document.getElementById('show-passwords').addEventListener('change', function() {
            const passwordFields = document.querySelectorAll('input[name="password"], input[name="password_confirmation"]');
            const isPasswordVisible = this.checked;

            passwordFields.forEach(field => {
                field.type = isPasswordVisible ? 'text' : 'password';
            });
        });
    </script>
</body>
</html>
