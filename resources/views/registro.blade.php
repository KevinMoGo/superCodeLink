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


</head>
<body class="bg-gray-800 flex justify-center items-center h-screen">

    <!-- Div para el formulario de registro de usuarios -->
    <div class="container max-w-lg w-full p-8 bg-white shadow-md rounded-md md:border-l md:border-r md:rounded-lg" style="margin: 0 20px;" id="registroDiv">
    @csrf
        <h1 class="text-center text-3xl mb-8 text-gray-800">Registro de usuarios</h1>
        <div class="space-y-4" id="registroForm">
            <!-- Nombre de usuario -->
            <div>
                <p class="text-gray-800 username">Nombre de usuario</p>
                <input type="text" id="usernameID" name="usernameID" autocomplete="off" class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:border-black" maxlength="25" autofocus>
            </div>
            <!-- Nombre -->
            <div>
                <p class="text-gray-800">Nombre</p>
                <input type="text" id="nombreID" name="nombreID" autocomplete="off" class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:border-black" maxlength="25">
            </div>
            <!-- Contraseña -->
            <div>
                <p class="text-gray-800">Contraseña</p>
                <input type="password" id="contrasenaID" name="contrasenaID" autocomplete="off" class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:border-black" maxlength="21">
            </div>
            <!-- Edad y Sexo -->
            <div class="flex space-x-4">
                <div class="w-1/2">
                    <p class="text-gray-800">Edad</p>
                    <input type="number" id="edadID" name="edadID" autocomplete="off" class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:border-black" min="18" max="122">
                </div>
                <div class="w-1/2">
                    <p class="text-gray-800">Sexo</p>
                    <select id="sexo" name="sexo" class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:border-black">
                        <option value="Hombre">Hombre</option>
                        <option value="Mujer">Mujer</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
            </div>
            <!-- País -->
            <div>
                <p class="text-gray-800">País</p>
                <select id="pais" name="pais" class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:border-black">
                    <option value="">Selecciona un país</option>
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
            <!-- Botones -->
            <div class="flex space-x-4">
                <button type="button" class="w-full px-4 py-2 bg-black text-white rounded-md transition duration-300 hover:bg-gray-900" onclick="registrarDatos()">Guardar</button>
                <button type="button" class="w-full px-4 py-2 bg-red-600 text-white rounded-md transition duration-300 hover:bg-red-700" onclick="cancelarRegistro()">Cancelar</button>
            </div>
            <!-- Mensajes de error y éxito -->
            <p id="rellenarError" class="mensajeError2 text-red-500 hidden">Rellene los campos</p>
            <p id="edadError" class="mensajeError2 text-red-500 hidden">Edad mínima 18 y máxima 122</p>
            <p id="min3" class="mensajeError text-red-500 hidden">Introduce al menos 4 caracteres</p>
            <p id="sucess" class="mensajeSuccess text-green-500 hidden">Datos guardados</p>
            <p id="creacionError" class="mensajeError text-red-500 hidden">Error en la creación</p>
            <p id="successCreation" class="mensajeSuccess text-green-500 hidden">Usuario creado</p>
            <p id="usernameError" class="mensajeError text-red-500 hidden">Nombre de usuario no disponible</p>
        </div>
    </div>

</body>




</html>


<script>
    // Cada vez que se cambie el valor del input de nombre de usuario, se ejecutará la función comprobarUsername, usaremos algo que detecte los cambios del valor del input
    document.getElementById('usernameID').addEventListener('input', comprobarUsername);

    function comprobarUsername(){
        escondeMensajes();
        // Comprobamos que no esté vacío el input
        if(document.getElementById('usernameID').value !== '' && document.getElementById('usernameID').value.length >= 4){
            escondeMensajes();
           // Comprobamos que tenga más de 3 caracteres, en caso de no tenerlos muestra un mensaje de error
            if(document.getElementById('usernameID').value.length < 4){
                document.getElementById('min3').classList.remove('hidden');
                // Hacemos un focus al input para que el usuario lo vea y lo ponemos un outline rojo durante 3 segundos y luego vuelve a su color original
                document.getElementById('usernameID').focus();
                document.getElementById('usernameID').style.borderColor = 'red';
                setTimeout(() => {
                    // Le quitamos el outline rojo y le ponemos un none
                    document.getElementById('usernameID').style.borderColor = 'gray';
                    // Ocultamos los mensajes de error
                    escondeMensajes();
                }, 3000);
            }
            else{
                // Cogemos el elemento p con clase username y le dejamos el texto Nombre de usuario
                document.querySelector('.username').innerHTML = 'Nombre de usuario';
                // Route::get('/validarUsername/{username}', [UsuariosController::class, 'validarUsername']); y mostramos data en la consola
                fetch('/validarUsername/' + document.getElementById('usernameID').value)
                .then(response => response.json())
                .then(data => {
                    // si es success ponemos el mensaje de nombre de usuario disponible y si no ponemos el mensaje de nombre de usuario no disponible
                    if(data.success){
                        // Cogemos el elemento p con clase username y le agregamos un texto verde de Disponible
                        document.querySelector('.username').innerHTML = 'Nombre de usuario <span class="text-green-500">disponible</span>';
                    }
                    else{
                        // Cogemos el elemento p con clase username y le agregamos un texto rojo de No disponible
                        document.querySelector('.username').innerHTML = 'Nombre de usuario <span class="text-red-500">no disponible</span>';
                        // Le quitamos la funcion onclick al botón de guardar
                        document.querySelector('.w-full').removeAttribute('onclick');
                    }
                });
            }
        }
        else{
            // Cogemos el elemento p con clase username y le dejamos el texto Nombre de usuario
            document.querySelector('.username').innerHTML = 'Nombre de usuario';
        }
    }


    function cancelarRegistro() {
        // Redirigir a la página de inicio
        window.location.href = '/';
    }


    function registrarDatos(){
        escondeMensajes();
        // Primero comprobamos que el username no esté vacío y en caso de no estarlo comprobamos que tenga más de 3 caracteres
        if(document.getElementById('usernameID').value === ''){
            // Mostramos el mensaje de error de que el campo está vacío
            document.getElementById('rellenarError').classList.remove('hidden');
            // Hacemos un focus al input para que el usuario lo vea y lo ponemos un outline rojo durante 3 segundos y luego vuelve a su color original
            document.getElementById('usernameID').focus();
            document.getElementById('usernameID').style.borderColor = 'red';
            setTimeout(() => {
                // Le quitamos el outline rojo y le ponemos un none
                document.getElementById('usernameID').style.borderColor = 'gray';
                // Ocultamos los mensajes de error
                escondeMensajes();
            }, 3000);
        }
        // Comprobamos que tenga al menos 4 caracteres
        else if(document.getElementById('usernameID').value.length < 4){
            // Mostramos el mensaje de error de que el campo está vacío
            document.getElementById('min3').classList.remove('hidden');
            // Hacemos un focus al input para que el usuario lo vea y lo ponemos un outline rojo durante 3 segundos y luego vuelve a su color original
            document.getElementById('usernameID').focus();
            document.getElementById('usernameID').style.borderColor = 'red';
            setTimeout(() => {
                // Le quitamos el outline rojo y le ponemos un none
                document.getElementById('usernameID').style.borderColor = 'gray';
                // Ocultamos los mensajes de error
                escondeMensajes();
            }, 3000);
        }

        else if(document.getElementById('nombreID').value === ''){
            // Mostramos el mensaje de error de que el campo está vacío
            document.getElementById('rellenarError').classList.remove('hidden');
            // Hacemos un focus al input para que el usuario lo vea y lo ponemos un outline rojo durante 3 segundos y luego vuelve a su color original
            document.getElementById('nombreID').focus();
            document.getElementById('nombreID').style.borderColor = 'red';
            setTimeout(() => {
                // Le quitamos el outline rojo y le ponemos un none
                document.getElementById('nombreID').style.borderColor = 'gray';
                // Ocultamos los mensajes de error
                escondeMensajes();
            }, 3000);
        }
        // Comprobamos que tenga al menos 4 caracteres
        else if(document.getElementById('nombreID').value.length < 4){
            // Mostramos el mensaje de error de que el campo está vacío
            document.getElementById('min3').classList.remove('hidden');
            // Hacemos un focus al input para que el usuario lo vea y lo ponemos un outline rojo durante 3 segundos y luego vuelve a su color original
            document.getElementById('nombreID').focus();
            document.getElementById('nombreID').style.borderColor = 'red';
            setTimeout(() => {
                // Le quitamos el outline rojo y le ponemos un none
                document.getElementById('nombreID').style.borderColor = 'gray';
                // Ocultamos los mensajes de error
                escondeMensajes();
            }, 3000);
        }
        else if(document.getElementById('contrasenaID').value === ''){
            // Mostramos el mensaje de error de que el campo está vacío
            document.getElementById('rellenarError').classList.remove('hidden');
            // Hacemos un focus al input para que el usuario lo vea y lo ponemos un outline rojo durante 3 segundos y luego vuelve a su color original
            document.getElementById('contrasenaID').focus();
            document.getElementById('contrasenaID').style.borderColor = 'red';
            setTimeout(() => {
                // Le quitamos el outline rojo y le ponemos un none
                document.getElementById('contrasenaID').style.borderColor = 'gray';
                // Ocultamos los mensajes de error
                escondeMensajes();
            }, 3000);
        }
        // Comprobamos que tenga al menos 4 caracteres
        else if(document.getElementById('contrasenaID').value.length < 4){
            // Mostramos el mensaje de error de que el campo está vacío
            document.getElementById('min3').classList.remove('hidden');
            // Hacemos un focus al input para que el usuario lo vea y lo ponemos un outline rojo durante 3 segundos y luego vuelve a su color original
            document.getElementById('contrasenaID').focus();
            document.getElementById('contrasenaID').style.borderColor = 'red';
            setTimeout(() => {
                // Le quitamos el outline rojo y le ponemos un none
                document.getElementById('contrasenaID').style.borderColor = 'gray';
                // Ocultamos los mensajes de error
                escondeMensajes();
            }, 3000);
        }
        else if(document.getElementById('edadID').value === ''){
            // Mostramos el mensaje de error de que el campo está vacío
            document.getElementById('rellenarError').classList.remove('hidden');
            // Hacemos un focus al input para que el usuario lo vea y lo ponemos un outline rojo durante 3 segundos y luego vuelve a su color original
            document.getElementById('edadID').focus();
            document.getElementById('edadID').style.borderColor = 'red';
            setTimeout(() => {
                // Le quitamos el outline rojo y le ponemos un none
                document.getElementById('edadID').style.borderColor = 'gray';
                // Ocultamos los mensajes de error
                escondeMensajes();
            }, 3000);
        }
        else if(document.getElementById('edadID').value < 18 || document.getElementById('edadID').value > 122){
            // Mostramos el mensaje de error de que el campo está vacío
            document.getElementById('edadError').classList.remove('hidden');
            // Hacemos un focus al input para que el usuario lo vea y lo ponemos un outline rojo durante 3 segundos y luego vuelve a su color original
            document.getElementById('edadID').focus();
            document.getElementById('edadID').style.borderColor = 'red';
            setTimeout(() => {
                // Le quitamos el outline rojo y le ponemos un none
                document.getElementById('edadID').style.borderColor = 'gray';
                // Ocultamos los mensajes de error
                escondeMensajes();
            }, 3000);
        }
        // Ahora nos aseguramos de que se haya elegido un país
        else if(document.getElementById('pais').value === ''){
            // Mostramos el mensaje de error de que el campo está vacío
            document.getElementById('rellenarError').classList.remove('hidden');
            // Hacemos un focus al input para que el usuario lo vea y lo ponemos un outline rojo durante 3 segundos y luego vuelve a su color original
            document.getElementById('pais').focus();
            document.getElementById('pais').style.borderColor = 'red';
            setTimeout(() => {
                // Le quitamos el outline rojo y le ponemos un none
                document.getElementById('pais').style.borderColor = 'gray';
                // Ocultamos los mensajes de error
                escondeMensajes();
            }, 3000);
        }
        // Analizamos que en el p username no ponga no disponible
        else if(document.querySelector('.username').innerHTML.includes('no disponible')){
            // Hace un focus al input de username
            document.getElementById('usernameID').focus();
            // Pone un outline rojo al input de username durante 3 segundos
            document.getElementById('usernameID').style.borderColor = 'red';
            // Muestra un mensaje de error de que el nombre de usuario no está disponible
            document.getElementById('usernameError').classList.remove('hidden');

            setTimeout(() => {
                // Quita el outline rojo al input de username
                document.getElementById('usernameID').style.borderColor = 'gray';
                // Oculta los mensajes de error
                escondeMensajes();
            }, 3000);
        
        }
        else {
    // Si todo está correcto, guardamos los datos
    fetch('/registro', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            username: document.getElementById('usernameID').value,
            nombre: document.getElementById('nombreID').value,
            contrasena: document.getElementById('contrasenaID').value,
            edad: document.getElementById('edadID').value,
            sexo: document.getElementById('sexo').value,
            pais: document.getElementById('pais').value
        })
    })
    .then(response => response.json())
    .then(data => {
        // Si es success muestra mensaje de bienvenida y en 1s redirige a la página de inicio
        if (data.success) {
            document.getElementById('successCreation').classList.remove('hidden');
            setTimeout(() => {
                window.location.href = '/';
            }, 1000);
        } else {
            document.getElementById('creacionError').classList.remove('hidden');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Mostrar un mensaje de error genérico
        document.getElementById('creacionError').classList.remove('hidden');
    });
}






    


        
    }




    function escondeMensajes() {

        document.getElementById('rellenarError').classList.add('hidden');
        document.getElementById('edadError').classList.add('hidden');
        document.getElementById('min3').classList.add('hidden');
        document.getElementById('sucess').classList.add('hidden');
        document.getElementById('creacionError').classList.add('hidden');
        document.getElementById('successCreation').classList.add('hidden');
        document.getElementById('usernameError').classList.add('hidden');

    }





    
</script>


