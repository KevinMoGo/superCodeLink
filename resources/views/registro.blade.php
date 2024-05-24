<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, orientation=landscape">
    <title>Registro de usuarios</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/animaciones.css') }}">

</head>
<body class="bg-gray-800 flex justify-center items-center h-screen">

    <!-- Div para el formulario de nombre de usuario -->
    <div class="container max-w-lg w-full p-8 bg-white shadow-md rounded-md md:border-l md:border-r md:rounded-lg" style="margin: 0 20px;" id="usernameDiv">
        <h1 class="text-center text-3xl mb-8 text-gray-800">Registro de usuarios</h1>
        <div class="space-y-4" id="usernameForm">
            @csrf
            <div>
                <p class="text-gray-800">Nombre de usuario:</p>
                <input type="text" id="usernameID" name="usernameID" autocomplete="new-password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black" maxlength="21">
            </div>
            <button type="button" class="w-full px-4 py-2 bg-black text-white rounded-md transition duration-300 hover:bg-gray-900" onclick="registrarUsername()">Guardar</button>
        </div>
        <p id="mensajeUsername" class="mensajeError1 text-red-500 hidden">Este nombre ya existe</p>
        <p id="mensajeSuccessUsername" class="mensajeSuccess text-green-500 hidden">Nombre guardado</p>
        <p id="mensajeErrorDatos" class="mensajeError2 text-red-500 hidden">introduce algo</p>
    </div>


    

















    <div class="container max-w-lg w-full p-8 bg-white shadow-md rounded-md md:border-l md:border-r md:rounded-lg hidden" style="margin: 0 20px;" id="datosDiv">
    <h1 class="text-center text-3xl mb-8 text-gray-800">Registro de usuarios</h1>
    <div class="space-y-4" id="datosForm">
        <div>
            <p class="text-gray-800">Nombre:</p>
            <input type="text" id="nombreID" name="nombreID" autocomplete="off" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black" autofocus maxlength="21">
        </div>
        <div>
            <p class="text-gray-800">Contraseña:</p>
            
            <input type="password" id="contrasenaID" name="contrasenaID" autocomplete="off" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black" maxlength="21">
        </div>
        <div>
            <p class="text-gray-800">Edad:</p>
            <input type="number" id="edadID" name="edadID" autocomplete="off" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black" min="10" max="122">
        </div>
        <div>
            <p class="text-gray-800">Sexo:</p>
            <select id="sexo" name="sexo" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black">
                <option value="Hombre">Hombre</option>
                <option value="Mujer">Mujer</option>
                <option value="Otro">Otro</option>
            </select>
        </div>
        <div>
            <p class="text-gray-800">País:</p>
            <select id="pais" name="pais" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black">
                <option value="">Selecciona un país</option>
            </select>
        </div>
        <div class="flex space-x-4">
            <button type="button" class="w-full px-4 py-2 bg-black text-white rounded-md transition duration-300 hover:bg-gray-900" onclick="registrarDatos()">Guardar</button>
            <button type="button" class="w-full px-4 py-2 bg-red-600 text-white rounded-md transition duration-300 hover:bg-red-700" onclick="cancelarRegistro()">Cancelar</button>
        </div>
            <p id="ErrorRegistro" class="mensajeError2 text-red-500 hidden">Introduce todos los datos</p>
            <p id="ErrorRegistro2" class="mensajeError2 text-red-500 hidden">Introduce una edad coherente (min 10, max 122)</p>
            <p id="mensajeSuccessDatos" class="mensajeSuccess text-green-500 hidden">Datos guardados</p>
    </div>
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
    
    
    // Evitar que el formulario se envíe
    document.getElementById('usernameForm').addEventListener('submit', function(e) {
        e.preventDefault();
    });

    function registrarUsername() {
        document.getElementById('mensajeUsername').classList.add('hidden');
    document.getElementById('mensajeSuccessUsername').classList.add('hidden');
    document.getElementById('mensajeErrorDatos').classList.add('hidden');
        let username = document.getElementById('usernameID').value;
        console.log(username);
        // Si el usuario está vacío, mostrar mensaje de error en consola
        if (username === '') {
            
            document.getElementById('mensajeErrorDatos').classList.remove('hidden');
            // Hacemos un focus al input para que el usuario lo vea y lo ponemos en rojo durante 3 segundos y luego vuelve a su color original
            document.getElementById('usernameID').focus();
            document.getElementById('usernameID').style.borderColor = 'red';
            setTimeout(() => {
                document.getElementById('usernameID').style.borderColor = 'black';
            }, 3000);
        }
        else{
                    // Hacer una petición POST a la ruta /registroUsername 
        fetch('/registroUsername', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                username: username
            }),
        })
        .then(response => response.json())
        .then(data => {
            // Si el nombre de usuario ya existe, mostrar un mensaje de error y animar el elemento
            if (data.error) {
                document.getElementById('mensajeUsername').classList.remove('hidden');
                document.getElementById('mensajeSuccessUsername').classList.add('hidden');

        

            
} 
 else {
                // Si el nombre de usuario no existe, mostrar un mensaje de éxito
                document.getElementById('mensajeSuccessUsername').classList.remove('hidden');
                document.getElementById('mensajeUsername').classList.add('hidden');

                // Le agregamos la clase animate__slideOutLeft al div para animarlo
                setTimeout(() => {
                    document.getElementById('usernameDiv').classList.add('animate__slideOutLeft');
                    // Despues de la animacion le damos al body un overflow auto
                    document.body.style.overflow = 'auto';
                }, 500);

                setTimeout(() => {
                    
                    document.getElementById('datosDiv').classList.remove('hidden');
                    document.getElementById('datosDiv').classList.add('animate__slideInRight');
                }, 1100);
                
                
            }
        });
    }
        }


    function cancelarRegistro() {
        // Llamamos a la ruta /cancelarRegistro
        fetch('/cancelarRegistro', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
        })
        .then(response => response.json())
        .then(data => {
            // Si la respuesta es success, redirigimos al usuario a la página de inicio
            if (data.success) {
                window.location.href = '/';
            }
        });
    }


    function registrarDatos(){

        // Ocultamos los mensajes de error y éxito
        escondeMensajes();

        // los referenciamos en variables
        let mensajeErrorDatos = document.getElementById('ErrorRegistro');
        let mensajeErrorDatos2 = document.getElementById('ErrorRegistro2');
        let mensajeSuccessDatos = document.getElementById('mensajeSuccessDatos');

        let nombre = document.getElementById('nombreID').value;
        let contrasena = document.getElementById('contrasenaID').value;
        let edad = document.getElementById('edadID').value;
        let sexo = document.getElementById('sexo').value;
        let pais = document.getElementById('pais').value;

        // Verificamos que todos los campos estén llenos
        if (nombre === '' || contrasena === '' || edad === '' || pais === '') {
            document.getElementById('mensajeErrorDatos').classList.remove('hidden');
            // Hacemos un focus al input para que el usuario lo vea y lo ponemos en rojo durante 3 segundos y luego vuelve a su color original
            if (nombre === '') {
                // Ocultamos todos los mensajes de error y éxito
                escondeMensajes();

                document.getElementById('nombreID').focus();
                document.getElementById('nombreID').style.borderColor = 'red';
                setTimeout(() => {
                    document.getElementById('nombreID').style.borderColor = 'black';
                }, 3000);
                // Mostar mensaje de error
                mensajeErrorDatos.classList.remove('hidden');

            } else if (contrasena === '') {
                escondeMensajes();

                document.getElementById('contrasenaID').focus();
                document.getElementById('contrasenaID').style.borderColor = 'red';
                setTimeout(() => {
                    document.getElementById('contrasenaID').style.borderColor = 'black';
                }, 3000);
                // Mostar mensaje de error
                mensajeErrorDatos.classList.remove('hidden');
            } else if (edad === '') {
                escondeMensajes();

                document.getElementById('edadID').focus();
                document.getElementById('edadID').style.borderColor = 'red';
                setTimeout(() => {
                    document.getElementById('edadID').style.borderColor = 'black';
                }, 3000);
                // Mostar mensaje de error
                mensajeErrorDatos.classList.remove('hidden');
            } else if (pais === '') {
                escondeMensajes();

                document.getElementById('pais').focus();
                document.getElementById('pais').style.borderColor = 'red';
                setTimeout(() => {
                    document.getElementById('pais').style.borderColor = 'black';
                }, 3000);
                // Mostar mensaje de error
                mensajeErrorDatos.classList.remove('hidden');
            }
        }
        else if(parseInt(edad) > 122){
            // Comprobamos si edad es superior a 122 pasandolo a entero 
            
                document.getElementById('edadID').focus();
                document.getElementById('edadID').style.borderColor = 'red';
                setTimeout(() => {
                    document.getElementById('edadID').style.borderColor = 'black';
                }, 3000);
                // Mostar mensaje de error
                mensajeErrorDatos2.classList.remove('hidden');
            

        }
        else{
            // Hacer una petición POST a la ruta /registroDatos
            fetch('/registroDatos', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    nombre: nombre,
                    contrasena: contrasena,
                    edad: edad,
                    sexo: sexo,
                    pais: pais
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Si es un success, mostrar mensaje de éxito, inhabilitamos los 2 botones y mostramos esperamos 1s y redirigimos a la página de inicio
                if (data.success) {
                    mensajeSuccessDatos.classList.remove('hidden');
                    document.getElementById('datosForm').querySelectorAll('button').forEach(boton => {
                        boton.disabled = true;
                    });
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 1000);
                }

            });
        
        }

    }

    function escondeMensajes() {
        document.getElementById('ErrorRegistro').classList.add('hidden');
        document.getElementById('ErrorRegistro2').classList.add('hidden');
        document.getElementById('mensajeSuccessDatos').classList.add('hidden');
    }

    
</script>
