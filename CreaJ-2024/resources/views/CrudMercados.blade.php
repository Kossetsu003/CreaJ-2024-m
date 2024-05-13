<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD con Tailwind CSS</title>
    <!-- Agrega Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <!-- Encabezado -->
        <h1 class="text-3xl mb-6 text-center">CRUD de Mercados</h1>

        <!-- Botón Agregar -->
        <div class="flex justify-center mb-4">
            <button class="bg-purple-600 hover:bg-purple-800 text-white font-bold py-2 px-4 rounded">
                Agregar Mercado
            </button>
        </div>

        <!-- Tabla de Mercados -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Imagen</th>
                        <th class="px-4 py-2">Descripción</th>
                        <th class="px-4 py-2">Municipio</th>
                        <th class="px-4 py-2">Ubicación</th>
                        <th class="px-4 py-2">Horario</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se agregarán las filas de la tabla con datos dinámicos -->
                    <tr>
                        <td class="px-4 py-2">Mercado Central</td>
                        <td class="px-4 py-2">
                            <img src="imagen.jpg" alt="Imagen del mercado" class="w-16 h-16 object-cover">
                        </td>
                        <td class="px-4 py-2">El mercado central de la ciudad.</td>
                        <td class="px-4 py-2">Ciudad de México</td>
                        <td class="px-4 py-2">Calle 5 de Mayo #123</td>
                        <td class="px-4 py-2">8:00 - 20:00</td>
                        <td class="px-4 py-2">
                            <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Editar</button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
