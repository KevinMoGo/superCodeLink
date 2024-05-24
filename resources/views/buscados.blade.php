<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de la búsqueda</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <input type="hidden" name="id_receptor" id="id_receptor" value="{{ $usuario->id }}">
                    <div class="flex justify-center mt-4 space-x-4">
                        @if ($solicitudes->contains('usuario_receptor_id', $usuario->id))
                            <button class="btn btn-primary bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg border border-yellow-700" disabled>Enviada</button>
                        @elseif ($amistades->contains('usuario1_id', $usuario->id) || $amistades->contains('usuario2_id', $usuario->id))
                            <button class="btn btn-danger bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg border border-red-500 hover:border-red-700">Eliminar</button>
                        @else
                            <button class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg border border-blue-500 hover:border-blue-700 enviar">Enviar</button>
                        @endif
                        <button class="btn btn-primary bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg border border-green-500 hover:border-green-700">Mensaje</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="fixed bottom-0 right-0 p-2 mr-4 mb-4 lupaBuscar">
        <img src="{{ asset('/svg/buscar.svg') }}" alt="Lupa" class="w-11 h-11 lupa">
    </div>


        <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 hidden" id="formulario">
            <div class="w-11/12 sm:w-3/4 md:w-1/2 lg:w-1/3 xl:w-1/4 bg-white p-4 rounded-lg shadow-md mx-auto mt-24">
                <h2 class="text-2xl font-bold text-center">Buscar</h2>
                <div class="mt-4">
                    <label for="username" class="block text-sm font-bold text-gray-700">Username</label>
                    <input type="text" name="username" id="username" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
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
    let enviar = document.querySelectorAll('.enviar');
    // Referenciamos a la clase buscado
    let buscado = document.querySelectorAll('.buscado');
    // Y haremos que cuando se pulse el botón enviar, se deshabilite y extraiga el id del receptor
    enviar.forEach((enviar, index) => {
        enviar.addEventListener('click', () => {
            // El color azul de fondo, borde y hovers cambiara a amarillo oscuro
            enviar.classList.remove('bg-blue-500', 'hover:bg-blue-700', 'border-blue-500', 'hover:border-blue-700');
            enviar.classList.add('bg-yellow-800', 'hover:bg-yellow-900', 'border-yellow-800', 'hover:border-yellow-900');
            enviar.textContent = 'Enviada';
            
            enviar.disabled = true;
            let id_receptor = buscado[index].querySelector('#id_receptor').value;
            console.log(id_receptor);

            // Haremos una petición AJAX para enviar la solicitud
            fetch('/enviar_solicitud', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    id_receptor: id_receptor
                })
            }).then(response => response.json())
            .then(data => {
                console.log(data);
                // Aquí puedes manejar la respuesta y realizar las acciones necesarias
            })
            .catch(error => {
                console.log(error);
                // Aquí puedes manejar el error en caso de que ocurra
            });
        });
    });
    
</script>

<script>
        // Media queries para pantallas de 768px de ancho y 600px de alto hacemos la lupa más grande
        if (window.matchMedia('(min-width: 768px) and (min-height: 600px)').matches) {
            document.querySelector('.lupa').classList.add('w-18', 'h-18');
        }

        // addevetListener para que cuando se pulse la lupa se muestre el formulario
        document.querySelector('.lupaBuscar').addEventListener('click', () => {
            document.querySelector('#formulario').classList.remove('hidden');
        });

        // addevetListener para que cuando se pulse el botón cerrar se cierre el formulario
        document.querySelector('.cerrarBusqueda').addEventListener('click', () => {
            document.querySelector('#formulario').classList.add('hidden');
        });

        
</script>