<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .seccionAmigos::-webkit-scrollbar {
            overflow-x: auto;
        }
    </style>
</head>
@include('nav.navbar')

<body class="bg-gray-100">

    <div class="container mx-auto py-8 p-4">
        <form action="/buscar" method="POST" class="flex justify-center mb-8">
            @csrf
            <div class="w-full md:w-3/5 flex items-center">
                <input type="text" name="search" id="search" class="w-full border-2 border-gray-300 bg-white h-10 px-5 rounded-l-lg text-sm focus:outline-none"
                    placeholder="Buscar">
                <button type="submit" class="bg-black hover:bg-gray-700 text-white font-bold h-10 px-4 rounded-r-lg whitespace-nowrap">Buscar</button>
            </div>
        </form>

        <div class="w-full md:w-3/5 mx-auto">
            <h1 class="text-3xl mb-4">Amigos</h1>
            <div class="seccionAmigos flex gap-2 overflow-x-auto p-2">
                @foreach ($amigos as $amigo)
                    <div class="p-2 rounded-lg flex-shrink-0" id = "amigo{{ $amigo->id }}">
                        
                    <a href="javascript:void(0)" onclick="verPerfilUsuario({{ $amigo->id }})">
                            <img src="{{ $amigo->PP }}" alt="{{ $amigo->nombre }}" class="w-24 h-24 object-cover rounded-full mx-auto mb-2 border-4 border-orange-500">
                        </a>
                        <h2 class="text-lg font-semibold text-center">{{ $amigo->nombre }}</h2>
                    </div>
                @endforeach
            </div>



            <div class="mt-4">
    @foreach ($fotosAmigos as $foto)
        <div class="flex gap-4 p-4 bg-white rounded-lg shadow-md mb-4">
            <div class="relative">
                <img src="{{ $foto->ruta }}" alt="{{ $foto->descripcion }}" class="w-48 h-48 object-cover rounded-lg">
            </div>
            <div class="flex flex-col justify-start">
                <h2 class="text-xl font-bold mb-2 text-left">{{ $foto->titulo }}</h2>
                <p class="text-gray-700 mb-1">{{ $foto->descripcion }}</p>
                <p class="text-gray-500 text-sm">{{ $foto->fecha }}</p>
            </div>
        </div>
    @endforeach
</div>




        </div>
    </div>




<!-- <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden" id="formulario"> -->
<div id="perfilUsuario" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden" style="z-index: 501;">
    <div class="w-full max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold">Perfil de usuario</h1>
            <button onclick="cerrarPerfil()" class="text-red-500 font-bold text-3xl">&times;</button>
        </div>
        <div class="flex gap-4 mb-4">
            <img src="" id="perfilImagen" alt="Imagen del usuario" class="w-24 h-24 object-cover rounded-full">
            <div>
                <h2 id="nombreUsuario" class="text-xl font-semibold"></h2>
                <p id="sexoUsuario" class="text-gray-500"></p>
                <p id="edadUsuario" class="text-gray-500"></p>
                <p id="paisUsuario" class="text-gray-500"></p>
            </div>
        </div>
        <div class="flex justify-around mt-4">
            <button class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg" id="mensajeAmigo">Enviar mensaje</button>
            <button class="btn btn-danger bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg" id="eliminarAmigo">Eliminar Amigo</button>
        </div>
    </div>
</div>




</body>
</body>




</html>

<script>
    function verPerfilUsuario(idUsuario){
        // Llamamos a la funcio fetch con GET a /perfilUsuario/idUsuario
        fetch('/perfilUsuario/' + idUsuario)
        .then(response => response.json())
        .then(data => {
            // Mostramos el div con el perfil del usuario

            document.getElementById('perfilImagen').src = data.PP;
            // Cambiamos el nombre del usuario
            document.getElementById('nombreUsuario').textContent = data.nombre;
            // Cambiamos el sexo del usuario
            document.getElementById('sexoUsuario').textContent = 'Sexo: ' + data.sexo;
            // Cambiamos la edad del usuario
            document.getElementById('edadUsuario').textContent = 'Edad: ' + data.edad;
            // Cambiamos el país del usuario
            document.getElementById('paisUsuario').textContent = 'País: ' + data.pais;

            // le agregamos un onclick al botón de enviar mensaje enviarMensaje con el id del usuario como parámetro
            document.getElementById('mensajeAmigo').setAttribute('onclick', 'enviarMensaje(' + idUsuario + ')');
            // le agregamos un onclick al botón de eliminar amigo eliminarAmigo con el id del usuario como parámetro
            document.getElementById('eliminarAmigo').setAttribute('onclick', 'eliminarAmigo(' + idUsuario + ')');

            document.getElementById('perfilUsuario').classList.remove('hidden');
            

        });
    }

    function cerrarPerfil(){
        // Ocultamos el div con el perfil del usuario
        document.getElementById('perfilUsuario').classList.add('hidden');
    }

    function enviarMensaje(idUsuario){
        // Redirigimos al usuario a la página de chat con el id del usuario
        window.location.href = '/chatAmigo/' + idUsuario;
    }


    function eliminarAmigo(idAmigo){
            if (confirm("¿Estás seguro de que deseas eliminar a este amigo?")) {
                fetch('/delete_amigo/' + idAmigo, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(result => {
                    if (result) {
                        // Remove the friend from the list
                        document.getElementById('amigo' + idAmigo).remove();
                        cerrarPerfil();
                    }
                });
            }
        }
</script>
