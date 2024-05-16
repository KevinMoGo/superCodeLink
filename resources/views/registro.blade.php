<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-800 flex justify-center items-center h-screen">

    <!-- Div para el formulario de nombre de usuario -->
    <div class="container max-w-lg w-full p-8 bg-white shadow-md rounded-md md:border-l md:border-r md:rounded-lg" style="margin: 0 20px;" id="usernameDiv">
        <h1 class="text-center text-3xl mb-8 text-gray-800">Registro de usuarios</h1>
        <form autocomplete="off" class="space-y-4" id="usernameForm">
            @csrf
            <div>
                <label for="username" class="text-gray-800">Nombre de usuario:</label>
                <input type="text" id="usernameID" name="usernameID" autocomplete="off" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black">
            </div>
            <button type="button" class="w-full px-4 py-2 bg-black text-white rounded-md transition duration-300 hover:bg-gray-900" onclick="registrarUsername()">Guardar</button>
        </form>
        <p id="mensajeUsername" class="mensajeError1 text-red-500 hidden">Este nombre ya existe</p>
        <p id="mensajeSuccessUsername" class="mensajeSuccess text-green-500 hidden">Nombre guardado</p>
    </div>

    <!-- Div para el formulario de datos adicionales -->
    <div class="container max-w-lg w-full p-8 bg-white shadow-md rounded-md md:border-l md:border-r md:rounded-lg hidden" style="margin: 0 20px;">
        <form autocomplete="off" class="space-y-4">
            <div>
                <label for="nombre" class="text-gray-800">Nombre:</label>
                <input type="text" id="nombre" name="nombre" autofocus autocomplete="off" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black">
            </div>
            <div>
                <label for="edad" class="text-gray-800">Edad:</label>
                <input type="number" id="edad" name="edad" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black">
            </div>
            <div>
                <label for="genero" class="text-gray-800">Género:</label>
                <select id="genero" name="genero" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black">
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
            <div>
                <label for="pais" class="text-gray-800">País:</label>
                <select id="pais" name="pais" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black">
                    <!-- Los países serán agregados por una API -->
                </select>
            </div>
            <div>
                <label for="contrasena" class="text-gray-800">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" autocomplete="new-password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black">
            </div>
            <button type="button" class="w-full px-4 py-2 bg-black text-white rounded-md transition duration-300 hover:bg-gray-900" onclick="registroUsuario()">Regístrate</button>
        </form>
        <p class="mensajeError1 text-red-500 hidden">Rellene todos los campos</p>
        <p class="mensajeError2 text-red-500 hidden"><!-- El usuario ya existe --></p>
        <p class="mensajeSuccess text-green-500 hidden"><!-- Usuario registrado correctamente --></p>
    </div>
</body>
</html>


<script>
    function recogerPaises() {
        // Array para almacenar los nombres de los países
        let paisesArray = [];

        // Hacemos una petición a la API de países
        fetch('https://restcountries.com/v3.1/all')
            .then(response => response.json())
            .then(data => {
                // Extraemos solo el nombre de los países en español y los agregamos al array
                data.forEach(pais => {
                    paisesArray.push(pais.translations.spa.common);
                });

                // Ordenamos el array alfabéticamente
                paisesArray.sort();

                // Llenamos el select con los países ordenados
                let select = document.getElementById('pais');
                paisesArray.forEach(pais => {
                    select.innerHTML += `<option value="${pais}">${pais}</option>`;
                });
            })
            .catch(error => {
                console.error('Hubo un problema al obtener los países:', error);
            });
    }
    // Llamamos a la función
    recogerPaises();

</script>


<script>
    function registrarUsername() {
        // Obtenemos el valor del input
        let usernameID = document.getElementById('usernameID').value;
        console.log(usernameID);
        

        // Hacemos una petición AJAX para enviar el nombre de usuario
        $.ajax({
            url: '/registroUsername',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                console.log(response);
                

                // if(respuesta == true){
                //     //Mostrar mensaje de error
                //     document.getElementById('mensajeUsername').classList.remove('hidden');
                // }
                // else{
                //     console.log('Nombre guardado');

                // }
            }
        });
    }
</script>
