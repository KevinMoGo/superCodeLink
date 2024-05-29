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
                // Ponemos todos los paises en orden alfabético
                <option value="Afganistán">Afganistán</option>
                <option value="Albania">Albania</option>
                <option value="Alemania">Alemania</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Antigua y Barbuda">Antigua y Barbuda</option>
                <option value="Arabia Saudita">Arabia Saudita</option>
                <option value="Argelia">Argelia</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaiyán">Azerbaiyán</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bangladés">Bangladés</option>
                <option value="Barbados">Barbados</option>
                <option value="Baréin">Baréin</option>
                <option value="Bélgica">Bélgica</option>
                <option value="Belice">Belice</option>
                <option value="Benín">Benín</option>
                <option value="Bielorrusia">Bielorrusia</option>
                <option value="Birmania">Birmania</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia y Herzegovina">Bosnia y Herzegovina</option>
                <option value="Botsuana">Botsuana</option>
                <option value="Brasil">Brasil</option>
                <option value="Brunéi">Brunéi</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Bután">Bután</option>
                <option value="Cabo Verde">Cabo Verde</option>
                <option value="Camboya">Camboya</option>
                <option value="Camerún">Camerún</option>
                <option value="Canadá">Canadá</option>
                <option value="Catar">Catar</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Chipre">Chipre</option>
                <option value="Ciudad del Vaticano">Ciudad del Vaticano</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoras">Comoras</option>
                <option value="Corea del Norte">Corea del Norte</option>
                <option value="Corea del Sur">Corea del Sur</option>
                <option value="Costa de Marfil">Costa de Marfil</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Croacia">Croacia</option>
                <option value="Cuba">Cuba</option>
                <option value="Dinamarca">Dinamarca</option>
                <option value="Dominica">Dominica</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egipto">Egipto</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Emiratos Árabes Unidos">Emiratos Árabes Unidos</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Eslovaquia">Eslovaquia</option>
                <option value="Eslovenia">Eslovenia</option>
                <option value="España">España</option>
                <option value="Estados Unidos">Estados Unidos</option>
                <option value="Estonia">Estonia</option>
                <option value="Eswatini">Eswatini</option>
                <option value="Etiopía">Etiopía</option>
                <option value="Filipinas">Filipinas</option>
                <option value="Finlandia">Finlandia</option>
                <option value="Fiyi">Fiyi</option>
                <option value="Francia">Francia</option>
                <option value="Gabón">Gabón</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Ghana">Ghana</option>
                <option value="Granada">Granada</option>
                <option value="Grecia">Grecia</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guyana">Guyana</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-Bisáu">Guinea-Bisáu</option>
                <option value="Guinea Ecuatorial">Guinea Ecuatorial</option>
                <option value="Haití">Haití</option>
                <option value="Honduras">Honduras</option>
                <option value="Hungría">Hungría</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Irak">Irak</option>
                <option value="Irán">Irán</option>
                <option value="Irlanda">Irlanda</option>
                <option value="Islandia">Islandia</option>
                <option value="Islas Marshall">Islas Marshall</option>
                <option value="Islas Salomón">Islas Salomón</option>
                <option value="Israel">Israel</option>
                <option value="Italia">Italia</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japón">Japón</option>
                <option value="Jordania">Jordania</option>
                <option value="Kazajistán">Kazajistán</option>
                <option value="Kenia">Kenia</option>
                <option value="Kirguistán">Kirguistán</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Laos">Laos</option>
                <option value="Lesoto">Lesoto</option>
                <option value="Letonia">Letonia</option>
                <option value="Líbano">Líbano</option>
                <option value="Liberia">Liberia</option>
                <option value="Libia">Libia</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lituania">Lituania</option>
                <option value="Luxemburgo">Luxemburgo</option>
                <option value="Macedonia del Norte">Macedonia del Norte</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malasia">Malasia</option>
                <option value="Malaui">Malaui</option>
                <option value="Maldivas">Maldivas</option>
                <option value="Malí">Malí</option>
                <option value="Malta">Malta</option>
                <option value="Marruecos">Marruecos</option>
                <option value="Mauricio">Mauricio</option>
                <option value="Mauritania">Mauritania</option>
                <option value="México">México</option>
                <option value="Micronesia">Micronesia</option>
                <option value="Moldavia">Moldavia</option>
                <option value="Mónaco">Mónaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Níger">Níger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Noruega">Noruega</option>
                <option value="Nueva Zelanda">Nueva Zelanda</option>
                <option value="Omán">Omán</option>
                <option value="Países Bajos">Países Bajos</option>
                <option value="Pakistán">Pakistán</option>
                <option value="Palaos">Palaos</option>
                <option value="Panamá">Panamá</option>
                <option value="Papúa Nueva Guinea">Papúa Nueva Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Perú">Perú</option>
                <option value="Polonia">Polonia</option>
                <option value="Portugal">Portugal</option>
                <option value="Reino Unido">Reino Unido</option>
                <option value="República Centroafricana">República Centroafricana</option>
                <option value="República Checa">República Checa</option>
                <option value="República del Congo">República del Congo</option>
                <option value="República Democrática del Congo">República Democrática del Congo</option>
                <option value="República Dominicana">República Dominicana</option>
                <option value="Ruanda">Ruanda</option>
                <option value="Rumania">Rumania</option>
                <option value="Rusia">Rusia</option>
                <option value="Samoa">Samoa</option>
                <option value="San Cristóbal y Nieves">San Cristóbal y Nieves</option>
                <option value="San Marino">San Marino</option>
                <option value="San Vicente y las Granadinas">San Vicente y las Granadinas</option>
                <option value="Santa Lucía">Santa Lucía</option>
                <option value="Santo Tomé y Príncipe">Santo Tomé y Príncipe</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leona">Sierra Leona</option>
                <option value="Singapur">Singapur</option>
                <option value="Siria">Siria</option>
                <option value="Somalia">Somalia</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Suazilandia">Suazilandia</option>
                <option value="Sudáfrica">Sudáfrica</option>
                <option value="Sudán">Sudán</option>
                <option value="Sudán del Sur">Sudán del Sur</option>
                <option value="Suecia">Suecia</option>
                <option value="Suiza">Suiza</option>
                <option value="Surinam">Surinam</option>
                <option value="Tailandia">Tailandia</option>
                <option value="Tanzania">Tanzania</option>
                <option value="Tayikistán">Tayikistán</option>
                <option value="Timor Oriental">Timor Oriental</option>
                <option value="Togo">Togo</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad y Tobago">Trinidad y Tobago</option>
                <option value="Túnez">Túnez</option>
                <option value="Turkmenistán">Turkmenistán</option>
                <option value="Turquía">Turquía</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Ucrania">Ucrania</option>
                <option value="Uganda">Uganda</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistán">Uzbekistán</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Vietnam">Vietnam</option>
                <option value="Yemen">Yemen</option>
                <option value="Yibuti">Yibuti</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabue">Zimbabue</option>
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
