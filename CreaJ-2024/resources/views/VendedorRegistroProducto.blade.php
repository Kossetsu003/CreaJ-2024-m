<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('imgs/MiCarritoUser.png') }}" type="image/x-icon">
    <title>Registrar Producto Vendedor</title>
</head>
<body>
         <!-- Desktop Navbar -->
         <div class="hidden md:flex p-4 bg-white items-center justify-between shadow-md">
            <a href="{{ route('vendedores.index') }}">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold">
                 Mini <span class="text-orange-600"><b>Vendedores</b></span>
            </h1>
            </a>
            <div class="flex gap-8">
                 <a href="{{ route('vendedores.index') }}"
                    class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mi Puesto</a>
                <a href="{{ route('vendedores.productos') }}"
                    class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mis Productos</a>
                <a href="{{ route('vendedores.reservas') }}"
                    class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mi Reservas</a>
                <a href="{{ route('vendedores.historial') }}"
                    class="font-semibold uppercase text-sm lg:text-base hover:text-gray-300 px-2 py-1">Mis Historial</a>
                <a href="{{ route('vendedor.perfil') }}"
                    class="font-semibold uppercase text-sm lg:text-base hover:text-white hover:bg-black border border-black px-2 py-1 rounded-md">
                        Perfil
                    </a>
            </div>
        </div>
    <!-- Mobile Navbar -->
   <div class="bottom-bar fixed bottom-[2%] left-0 right-0 md:hidden flex justify-center">
        <div class="bg-gray-900 rounded-2xl w-64 h-14 flex justify-around">
            <div class="flex items-center">
                <a href="{{ route('vendedores.index') }}" class="bg-white rounded-full p-1">
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

    <form method="POST" action="{{ route('vendedores.guardarproducto')}}" enctype="multipart/form-data" onsubmit="calculatePrice()">
        @csrf
        <!-- Campo oculto para fk_vendedors -->
        <input type="hidden" name="fk_vendedors" value="{{ $vendedor->id }}">

        <section>
            <div class="w-72 h-auto mx-auto mt-16">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-black">Registrar Producto</h1>
                    <h3 class="mt-5">Puesto de: <b>{{ $vendedor->nombre_del_local }}</b></h3>
                </div>

                <div class="mt-5 space-y-4">
                    <!-- Imagen del Producto -->
                    <div class="flex justify-between">
                        <label for="file-input" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 flex items-center relative">
                            <span class="text-gray-600">Imagen del Producto</span>
                            <input id="file-input" type="file" name="imagen_referencia" class="hidden" onchange="previewImage(event)">
                            <span class="rounded-lg w-5 h-5 absolute right-2 top-2 bg-cover" style="background-image: url('{{ asset('imgs/files2.svg') }}');"></span>
                        </label>
                    </div>

                    <!-- Contenedor de la vista previa -->
                    <div id="preview-container" class="mt-4">
                        <img id="image-preview" src="#" alt="Vista previa de la imagen" class="hidden w-[200px] h-[200px] object-cover rounded-[15px] mx-auto">
                    </div>

                    <!-- Nombre del Producto -->
                    <div class="flex justify-center mt-4">
                        <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" name="name" placeholder="Nombre del Producto" required>
                    </div>

                    <!-- Descripción del Producto -->
                    <div class="flex justify-center">
                        <textarea maxlength="200" class="border-1 rounded border w-80 h-16 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="text" name="description" placeholder="Descripción del Producto"></textarea>
                    </div>

                    <!-- Tipo de Precio -->
                    <div class="flex justify-center">
                        <select id="price-type" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" onchange="togglePriceFields()">
                            <option value="fixed">Precio Definido</option>
                            <option value="per_dollar">Cantidad por Dólar</option>
                        </select>
                    </div>

                    <!-- Precio del Producto (Definido) -->
                    <div id="fixed-price-field" class="flex justify-center mt-4">
                        <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="number" name="price" step="0.01" placeholder="Precio del Producto" required>
                    </div>

                    <!-- Cantidad por Dólar -->
                    <div id="per-dollar-field" class="flex justify-center mt-4 hidden">
                        <input class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400" type="number" id="quantity" step="1" placeholder="Cantidad por Dólar">
                    </div>

                    <!-- Categoría del Producto -->
                    <div class="flex justify-center">
                        <select name="categoria" id="categoria" class="border bg-gray-100 rounded border-gray-400 w-full h-9 pl-5 text-xs mt-2 text-gray-400" required>
                            <option class="font-bold text-xs text-white" value="null">Escoga su Clasificacion</option>
                        <option class="font-bold text-xl text-gray-800" value="comedor" {{ old('clasificacion') == 'comedor' ? 'selected' : '' }}>Comedor</option>
                        <option class="font-bold text-xl text-gray-800" value="ropa" {{ old('clasificacion') == 'ropa' ? 'selected' : '' }}>Ropa</option>
                        <option class="font-bold text-xl text-gray-800" value="granosbasicos" {{ old('clasificacion') == 'granosbasicos' ? 'selected' : '' }}>Granos Basicos</option>
                        <option class="font-bold text-xl text-gray-800" value="artesanias" {{ old('clasificacion') == 'artesanias' ? 'selected' : '' }}>Artesanias</option>
                        <option class="font-bold text-xl text-gray-800" value="mariscos" {{ old('clasificacion') == 'mariscos' ? 'selected' : '' }}>Mariscos</option>
                        <option class="font-bold text-xl text-gray-800" value="carnes" {{ old('clasificacion') == 'carnes' ? 'selected' : '' }}>Carnes</option>
                        <option class="font-bold text-xl text-gray-800" value="lacteos" {{ old('clasificacion') == 'lacteos' ? 'selected' : '' }}>Lacteos</option>
                        <option class="font-bold text-xl text-gray-800" value="aves" {{ old('clasificacion') == 'aves' ? 'selected' : '' }}>Aves</option>
                        <option class="font-bold text-xl text-gray-800" value="plasticos" {{ old('clasificacion') == 'plasticos' ? 'selected' : '' }}>Plasticos</option>
                        <option class="font-bold text-xl text-gray-800" value="frutasyverduras" {{ old('clasificacion') == 'frutasyverduras' ? 'selected' : '' }}>Frutas Y Verduras</option>
                        <option class="font-bold text-xl text-gray-800" value="emprendimiento" {{ old('clasificacion') == 'emprendimiento' ? 'selected' : '' }}>Emprendimiento</option>
                        <option class="font-bold text-xl text-gray-800" value="otros" {{ old('clasificacion') == 'otros' ? 'selected' : '' }}>Otros</option>

                        </select>
                    </div>

                    <!-- Estado del Producto -->
                    <div class="flex justify-center">
                        <input type="hidden" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 text-gray-400" name="estado" required value="Disponible">
                    </div>
                </div>

                <!-- Botón para Guardar -->
                <div class="flex justify-center mt-16">
                    <button class="bg-black w-72 h-10 text-white font-bold rounded-md">Guardar</button>
                </div>
            </div>
        </section>
    </form>

    <script>
        function togglePriceFields() {
            var priceType = document.getElementById('price-type').value;
            var fixedPriceField = document.getElementById('fixed-price-field');
            var perDollarField = document.getElementById('per-dollar-field');

            if (priceType === 'fixed') {
                fixedPriceField.classList.remove('hidden');
                perDollarField.classList.add('hidden');
                document.querySelector('input[name="price"]').required = true;
            } else {
                fixedPriceField.classList.add('hidden');
                perDollarField.classList.remove('hidden');
                document.querySelector('input[name="price"]').required = false;
            }
        }

        function calculatePrice() {
            var priceType = document.getElementById('price-type').value;
            if (priceType === 'per_dollar') {
                var quantity = document.getElementById('quantity').value;
                if (quantity) {
                    var calculatedPrice = 1 / quantity;
                    document.querySelector('input[name="price"]').value = calculatedPrice.toFixed(2);
                }
            }
        }

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('image-preview');
                output.src = reader.result;
                output.classList.remove('hidden');
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>





</body>
</html>
