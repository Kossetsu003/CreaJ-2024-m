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
            <form method="POST" action="{{ route('vendedors.store') }}" role="form" enctype="multipart/form-data">
                @csrf
                <div class="pb-16 mt-10 space-y-4">
                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-2 rounded mt-1 text-sm sm:text-sm text-center">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex justify-center">
                        <input required type="email" name="usuario" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('usuario') is-invalid @enderror" value="{{ old('usuario') }}" id="usuario" placeholder="Escriba el correo electrónico">
                    </div>
                    <div class="flex justify-center">
                        <input required type="password" name="contrasena" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('contrasena') is-invalid @enderror" value="{{ old('contrasena') }}" id="contrasena" placeholder="Escriba su Contraseña">
                    </div>
                    <div class="flex justify-center">
                        <input required type="password" name="contrasena_confirmation" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('contrasena_confirmation') is-invalid @enderror" value="{{ old('contrasena_confirmation') }}" id="contrasena_confirmation" placeholder="Confirme su Contraseña">
                    </div>
                    <div class="flex justify-center">
                        <input required type="text" name="nombre" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" id="nombre" placeholder="Escriba el Nombre del Vendedor">
                    </div>
                    <div class="flex justify-center">
                        <input required type="text" name="apellidos" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos') }}" id="apellidos" placeholder="Escriba los Apellidos del Vendedor">
                    </div>
                    <div class="flex justify-center">
                        <input required type="text" name="telefono" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" id="telefono" placeholder="Digite el Teléfono del Vendedor">
                    </div>
                    <div class="flex justify-center">
                        <input required type="text" name="numero_puesto" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('numero_puesto') is-invalid @enderror" value="{{ old('numero_puesto') }}" id="numero_puesto" placeholder="Escriba el Número Puesto">
                    </div>
                    <div class="flex justify-center">
                        <select required name="fk_mercado" class="border-1 rounded border w-80 h-9 pl-5 text-xs bg-gray-100 shadow-md border-gray-400 form-control @error('fk_mercado') is-invalid @enderror" id="fk_mercado">
                            <option value="">Seleccione un mercado</option>
                            @foreach($mercados as $mercado)
                                <option value="{{ $mercado->id }}" {{ old('fk_mercado') == $mercado->id ? 'selected' : '' }}>{{ $mercado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-center mt-16">
                        <button class="btn btn-primary bg-red-600 w-72 h-10 text-white font-bold rounded-md">Registrar Vendedor</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
