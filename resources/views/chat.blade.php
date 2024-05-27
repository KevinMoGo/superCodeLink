<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Chat con {{ $usuario->nombre }}</title>
    <style>
        /* Aplicar overflow-wrap a los contenedores de mensajes */
        .mensaje {
            overflow-wrap: break-word;
        }
    </style>
</head>
<body class="bg-gray-100">

@include('nav.navbar')

<div class="mx-auto px-4 py-8 max-w-4xl"> <!-- Cambia 'max-w-xl' a 'max-w-2xl' -->
    <h1 class="text-2xl font-semibold mb-4">Chat con {{ $usuario->nombre }}</h1>
    <div class="space-y-4">
        <!-- Mensajes -->
        <div class="flex items-center justify-start">
            <div class="bg-blue-500 text-white rounded-lg py-2 px-4 max-w-xs mensaje">
                <p>Soy ajeno</p>
            </div>
        </div>
        <div class="flex items-center justify-start">
            <div class="bg-blue-500 text-white rounded-lg py-2 px-4 max-w-xs mensaje">
                <p>Soy ajenooooooooooooo</p>
            </div>
        </div>
        <div class="flex items-center justify-end">
            <div class="bg-gray-200 rounded-lg py-2 px-4 max-w-xs mensaje">
                <p>Pues yo soy propioooooooooooooooooooooooooooooooooooooooooooooooooooooooo</p>
            </div>
        </div>
        <div class="flex items-center justify-end">
            <div class="bg-gray-200 rounded-lg py-2 px-4 max-w-xs mensaje">
                <p>Y aquí estoy</p>
            </div>
        </div>
    </div>
    <!-- Input de mensaje -->
    <div class="mt-4 flex">
        <input type="text" placeholder="Escribe tu mensaje" class="flex-1 border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500">
        <button class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500">Enviar</button>
    </div>
</div>


</body>
</html>
