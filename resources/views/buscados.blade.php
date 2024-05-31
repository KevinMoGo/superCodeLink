<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de la búsqueda</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .lupaBuscar {
            cursor: pointer;
            background-color: black;
            border-radius: 10px;
        }
    </style>
</head>

@include('nav.navbar')
<body class="bg-gray-100 relative">
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach ($usuarios as $usuario)
                <div class="bg-white p-4 rounded-lg shadow-md border-2 border-orange-500 buscado">
                    <img src="{{ $usuario->PP }}" alt="{{ $usuario->nombre }}" class="w-32 h-32 object-cover rounded-full mx-auto mb-4 border-4 border-orange-500">
                    <h2 class="text-lg font-bold text-center">{{ $usuario->nombre }}</h2>
                    <p class="text-sm text-center">{{ $usuario->username }}</p>
                    <div class="flex justify-center mt-4 space-x-4">
                        @if ($solicitudes->contains('usuario_receptor_id', $usuario->id))
                            <button class="btn btn-primary bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg border border-yellow-700" disabled>Enviada</button>
                        @elseif ($amistades->contains('usuario1_id', $usuario->id) || $amistades->contains('usuario2_id', $usuario->id))
                            <button class="btn btn-primary bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg border border-green-500 hover:border-green-700" disabled>Amigo</button>
                        @else
                            <button class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg border border-blue-500 hover:border-blue-700" onclick="enviarSolicitud({{ $usuario->id }})" id="usuario{{ $usuario->id }}">Enviar solicitud</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="fixed bottom-0 right-0 p-2 mr-4 mb-4 lupaBuscar">
        <img src="{{ asset('/svg/buscar.svg') }}" alt="Lupa" class="w-11 h-11 lupa">
    </div>

    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden" id="formulario">
        <div class="w-11/12 sm:w-3/4 md:w-1/2 lg:w-1/3 xl:w-1/4 bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center">Buscar</h2>
            <div class="mt-4">
                <label for="username" class="block text-sm font-bold text-gray-700">Username</label>
                <input type="text" name="username" id="username" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div class="mt-4">
                <label for="nombre" class="block text-sm font-bold text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div class="mt-4">
                <label for="sexo" class="block text-sm font-bold text-gray-700">Sexo</label>
                <select name="sexo" id="sexo" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                </select>
            </div>
            <div class="mt-4">
                <label for="edad" class="block text-sm font-bold text-gray-700">Edad</label>
                <input type="number" name="edad" id="edad" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div class="mt-4">
                <label for="pais" class="block text-sm font-bold text-gray-700">País</label>
                <input type="text" name="pais" id="pais" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div class="mt-4 flex justify-around">
                <button class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg border border-blue-500 hover:border-blue-700">Buscar</button>
                <button class="btn btn-primary bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg border border-red-500 hover:border-red-700 cerrarBusqueda">Cerrar</button>
            </div>
        </div>
    </div>

</body>
</html>

<script>
    function enviarSolicitud(id) {
        // Hacemos una llamada a la API para enviar la solicitud mediante una peticion POST y ruta /nuevaSolicitud
        fetch('/nuevaSolicitud', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                id: id
            })
        })
        .then(response => response.json())
        .then(data => {
            // Si la respuesta es correcta mostramos un mensaje de éxito
            if (data.success) {
                // le cambiamos el estilo al boton que hemos pulsado
                document.getElementById('usuario' + id).classList.remove('bg-blue-500', 'hover:bg-blue-700', 'border-blue-500', 'hover:border-blue-700');
                document.getElementById('usuario' + id).classList.add('bg-yellow-700', 'border-yellow-700');
                document.getElementById('usuario' + id).innerHTML = 'Enviada';
                document.getElementById('usuario' + id).disabled = true;
                


            }
            else{
                // Mostramos un confirm de el usuario ya tiene una solicitud enviada, quieres ir a notificaciones
                if (confirm('Ya tienes una solicitud de este usuario, ¿quieres ir a notificaciones?')) {
                    window.location.href = '/notis';
                }
            }
        });
    }
</script>

<script>
    // addevetListener para que cuando se pulse la lupa se muestre el formulario
    document.querySelector('.lupaBuscar').addEventListener('click', () => {
        document.querySelector('#formulario').classList.remove('hidden');
    });

    // addevetListener para que cuando se pulse el botón cerrar se cierre el formulario
    document.querySelector('.cerrarBusqueda').addEventListener('click', () => {
        document.querySelector('#formulario').classList.add('hidden');
    });
</script>
