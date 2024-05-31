
<meta name="csrf-token" content="{{ csrf_token() }}">
<nav class="bg-black fixed top-0 w-full flex items-center justify-between z-50 px-4 py-2 rounded-b-lg shadow-lg" id="navbar">
    <ul class="flex items-center justify-between w-full space-x-1" id="listaNav">
        <li><a href="/inicio" class="flex items-center navbar-item btn rounded-full p-2 hover:bg-gray-700"><img src="{{ asset('svg/home.svg') }}" alt="casa" class="icono"></a></li>
        <li><a href="/amigos" class="flex items-center navbar-item btn rounded-full p-2 hover:bg-gray-700"><img src="{{ asset('svg/gente.svg') }}" alt="gente" class="icono"></a></li>
        <li><a href="misimagenes" class="flex items-center navbar-item btn rounded-full p-2 hover:bg-gray-700"><img src="{{ asset('svg/archivo.svg') }}" alt="buscar" class="icono"></a></li>
        <li><a href="/registroSubir" class="flex items-center navbar-item btn rounded-full p-2 hover:bg-gray-700"><img src="{{ asset('svg/subir.svg') }}" alt="subir" class="icono"></a></li>
        <li><a href="/notis" class="flex items-center navbar-item btn rounded-full p-2 hover:bg-gray-700"><img src="{{ asset('svg/notificacion.svg') }}" alt="notificacion" class="icono"></a></li>
        <li><a href="javascript:void(0)" id="barraLateral" class="flex items-center navbar-item btn rounded-full p-2 hover:bg-gray-700"><img src="{{ asset('svg/menu.svg') }}" alt="menu" class="icono" onclick="abrirMenu()"></a></li>
    </ul>
</nav>

<div id="sidebar" class="bg-gray-100 hidden">
    <!-- Right Sidebar -->
    <div class="fixed top-0 right-0 h-full bg-gray-800 text-white w-64 md:w-80 lg:w-96 space-y-6 py-7 px-2" style="margin-top: 12vh; z-index: 9999;">
        <!-- User Info -->
        <div class="flex items-center space-x-4 p-2">
            <div class="relative">
                <img src="{{ asset('assets/fotosPerfil/usuario_defecto.svg') }}" alt="User Photo" class="h-16 w-16 rounded-full object-cover" id="fotoUsuarioBarra">
                <a href="javascript:void(0)" class="absolute bottom-0 right-0 bg-blue-500 rounded-full p-1" id="botonEditarPerfil">
                    <img src="{{ asset('svg/editarFoto.svg') }}" alt="Editar Foto" class="h-4 w-4" id="editarPP">
                </a>
            </div>
            <div>
                <p class="font-medium text-lg" id="nombreUsuarioBarra"></p>
                <p class="text-sm text-gray-400" id="usernameBarra"></p>
            </div>
        </div>
        <!-- Navigation -->
        <ul class="space-y-2">
            <li>
                <a href="javascript:void(0)" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700" id="editarPerfil">
                    Editar Perfil
                </a>
            </li>
            <li>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700" onclick="logout()">
                    Cerrar Sesión
                </a>
            </li>
        </ul>
    </div>
</div>



<div class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-50 z-50 hidden" id="editarPPModal">
    <div class="mx-4 md:mx-auto"> <!-- Contenedor con margen -->
        <div class="bg-white rounded-lg shadow-lg p-8 md:max-w-md">
            <h2 class="text-2xl font-semibold mb-4">Subir Foto de Perfil</h2>


            <div id="uploadProfilePictureForm">
                <label for="profilePicture" class="block mb-4">
                    <span class="text-gray-700">Selecciona una foto de perfil:</span>
                    <input type="file" id="fotoPerfil" name="fotoPerfil" accept="image/jpeg, image/png" class="mt-2">
                </label>
                <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" onclick="subirFotoPerfil()">Subir</button>
                <button type="button" class="bg-gray-200 text-gray-700 py-2 px-4 rounded ml-2 hover:bg-gray-300" onclick="closeModal()">Cancelar</button>
            </div>


            <div id="errorMessageFoto" class="hidden text-red-500 mt-2">Selecciona una foto de perfil</div>
            <div id="errorPesoFoto" class="hidden text-red-500 mt-2">La foto de perfil debe pesar menos de 1MB</div>
            <div id="errorTypeFoto" class="hidden text-red-500 mt-2">La foto de perfil debe ser .jpg o .png</div>
            <div id="successMessageFoto" class="hidden text-green-500 mt-2">Foto de perfil guardada</div>
        </div>
    </div>
</div>


<div class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-50 z-50 hidden" id="editarPerfilModal">
    <div class="mx-4 md:mx-auto"> <!-- Contenedor con margen -->
        <div class="bg-white rounded-lg shadow-lg p-8 md:max-w-2xl mx-4"> <!-- Ancho máximo y márgenes -->
            <h2 class="text-2xl font-semibold mb-4">Editar Perfil</h2>
            <div id="editProfileForm">
                <input type="text" id="username" name="username" placeholder="Nombre de Usuario" class="block w-full mt-2 mb-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" maxlength="20">
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="block w-full mt-2 mb-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" maxlength="20">
                <input type="number" id="edad" name="edad" placeholder="Edad" class="block w-full mt-2 mb-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" min="18" max="122">
                <select id="sexo" name="sexo" placeholder="Sexo" class="block w-full mt-2 mb-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="hombre">Hombre</option>
                    <option value="mujer">Mujer</option>
                    <option value="otro">Otro</option>
                </select>

                <select id="pais" name="pais" placeholder="País" class="block w-full mt-2 mb-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
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

                <div class="flex justify-center"> <!-- Centra los botones -->
                    <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mr-2" onclick = "guardarCambios()">Guardar</button>
                    <button type="button" class="bg-gray-200 text-gray-700 py-2 px-4 rounded hover:bg-gray-300" onclick="closeEditar()">Cancelar</button>
                </div>
                <!-- Mensajes de error -->
                <div id="errorMessages" class="text-red-500 mt-4">
                    <p id="errorMessage1" class="hidden">Error: Debes llenar todos los campos</p>
                    <p id="errorMessage2" class="hidden">Ingrese una edad válida. (18-122) </p>
                    <p id="errorMessage3" class="hidden">Username ya en uso</p>
                    <p id="errorMessage4" class="hidden">Introduce al menos 4 letras</p>
                </div>
                
                <div id="successMessage" class="text-green-500 mt-4 hidden">Perfil guardado</div>
            </div>
        </div>
    </div>
</div>









<style>
    body {
        margin-top: 16vh;
        height: 100vh;
    }
    #navbar {
        height: 13vh;
    }
    .icono {
        width: 100%;
        max-width: 35px;
    }
    #listaNav {
        justify-content: space-around;
    }

    @media (min-width: 768px) and (min-height: 600px) {
    .icono {
        max-width: 60px;
        max-height: 60px;
    }
}
</style>

<script>
    let usernameOriginal = '';
    document.addEventListener('DOMContentLoaded', function() {
        fetchDatos();

    });

    function fetchDatos(){
        fetch('/datosBarra')
        .then(response => response.json())
        .then(data => {

            document.getElementById('nombreUsuarioBarra').textContent = data.nombre;
            document.getElementById('usernameBarra').textContent = data.username;
            usernameOriginal = data.username;
            document.getElementById('fotoUsuarioBarra').src = data.PP;


        });
    }



    function abrirMenu() {
    
        var sidebar = document.getElementById('sidebar');
        if (sidebar.classList.contains('hidden')) {
            sidebar.classList.remove('hidden');
        } else {
            sidebar.classList.add('hidden');
        }
    }

    document.getElementById('botonEditarPerfil').addEventListener('click', function() {
        esconderMensaje();
        var modal = document.getElementById('editarPPModal');
        // Le quitamos la clase hidden
        modal.classList.remove('hidden');
    });

    function closeModal() {
        var modal = document.getElementById('editarPPModal');
        // Le agregamos la clase hidden
        modal.classList.add('hidden');
    }


    function subirFotoPerfil() {
        esconderMensaje();
        var fotoPerfil = document.getElementById('fotoPerfil').files[0];
        // primero comprobamos si esta vacio
        if (fotoPerfil == null) {
            document.getElementById('errorMessageFoto').classList.remove('hidden');
        } else if (fotoPerfil.size > 1048576) { // 1MB = 1048576 bytes
            document.getElementById('errorPesoFoto').classList.remove('hidden');
        } else {
            var formData = new FormData();
            formData.append('fotoPerfil', fotoPerfil);
            fetch('/subirFotoPerfil', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {

                if(data.error){
                    document.getElementById('errorTypeFoto').classList.remove('hidden');
                }
                else{
                    document.getElementById('successMessageFoto').classList.remove('hidden');
                    setTimeout(() => {
                        fetchDatos();
                        var modal = document.getElementById('editarPPModal');
                        modal.classList.add('hidden');
                    }, 1000);
                }
            });
        }
    }
    









    document.getElementById('editarPerfil').addEventListener('click', function() {
        esconderMensaje();
        // Hacemos fetch de los datos del usuario
        fetch('/datosEditar')
        .then(response => response.json())
        .then(data => {
            // Llenamos los campos del formulario
            document.getElementById('username').value = data.username;
            usernameOriginal = data.username;
            document.getElementById('nombre').value = data.nombre;
            document.getElementById('edad').value = data.edad;
            // Buscamos en la lista de opciones del select el valor que coincide con el sexo del usuario con un forEach
            document.getElementById('sexo').querySelectorAll('option').forEach(option => {
                if (option.value == data.sexo) {
                    option.selected = true;
                }
            });
            // Buscamos en la lista de opciones del select el valor que coincide con el país del usuario con un forEach
            document.getElementById('pais').querySelectorAll('option').forEach(option => {
                if (option.value == data.pais) {
                    option.selected = true;
                }
            });
            var modal = document.getElementById('editarPerfilModal');
            modal.classList.remove('hidden');

        });

    });

    function closeEditar() {
        var modal = document.getElementById('editarPerfilModal');
        modal.classList.add('hidden');
    }

    function guardarCambios(){
        esconderMensaje();
        if(usernameOriginal == document.getElementById('username').value){
            // Nos aseguramos de que todos los campos estén llenos
            if( document.getElementById('nombre').value == '' ){
                // Mostramos mensaje de error y ponemos un borde rojo al input durante 2 segundos con autofocus
                document.getElementById('errorMessage1').classList.remove('hidden');
                document.getElementById('nombre').classList.add('border-red-500');
                document.getElementById('nombre').focus();
                setTimeout(() => {
                    document.getElementById('nombre').classList.remove('border-red-500');
                    // Quitamos el mensaje de error
                    document.getElementById('errorMessage1').classList.add('hidden');
                }, 2000);

            }
            // Ahora comprobamos si tiene al menos 4 caracteres
            else if(document.getElementById('nombre').value.length < 4){
                document.getElementById('errorMessage4').classList.remove('hidden');
                document.getElementById('nombre').classList.add('border-red-500');
                document.getElementById('nombre').focus();
                setTimeout(() => {
                    document.getElementById('nombre').classList.remove('border-red-500');
                    // Quitamos el mensaje de error
                    document.getElementById('errorMessage4').classList.add('hidden');
                }, 2000);
            }
            else if(document.getElementById('edad').value == ''){
                document.getElementById('errorMessage2').classList.remove('hidden');
                document.getElementById('edad').classList.add('border-red-500');
                document.getElementById('edad').focus();
                setTimeout(() => {
                    document.getElementById('edad').classList.remove('border-red-500');
                    // Quitamos el mensaje de error
                    document.getElementById('errorMessage2').classList.add('hidden');
                }, 2000);
            }
            else if(document.getElementById('edad').value < 18 || document.getElementById('edad').value > 122){
                document.getElementById('errorMessage2').classList.remove('hidden');
                document.getElementById('edad').classList.add('border-red-500');
                document.getElementById('edad').focus();
                setTimeout(() => {
                    document.getElementById('edad').classList.remove('border-red-500');
                    // Quitamos el mensaje de error
                    document.getElementById('errorMessage2').classList.add('hidden');
                }, 2000);
            }
            else{
                // Hacmos una peticio PUT a editarPerfil1 con los datos menos el username
                fetch('/editarPerfil1', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        nombre: document.getElementById('nombre').value,
                        edad: document.getElementById('edad').value,
                        sexo: document.getElementById('sexo').value,
                        pais: document.getElementById('pais').value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Si es succes mostramos mensaje de exito
                    if(data.success){
                        document.getElementById('successMessage').classList.remove('hidden');
                        setTimeout(() => {
                            fetchDatos();
                            var modal = document.getElementById('editarPerfilModal');
                            modal.classList.add('hidden');
                        }, 1000);
                    }
                });
            }

            
        }

        else{
            // Verificamos que todos los campos estén llenos de la misma manera que antes uno por uno
            if( document.getElementById('username').value == '' ){
                // Mostramos mensaje de error y ponemos un borde rojo al input durante 2 segundos con autofocus
                document.getElementById('errorMessage1').classList.remove('hidden');
                document.getElementById('username').classList.add('border-red-500');
                document.getElementById('username').focus();
                setTimeout(() => {
                    document.getElementById('username').classList.remove('border-red-500');
                    // Quitamos el mensaje de error
                    document.getElementById('errorMessage1').classList.add('hidden');
                }, 2000);

            }
            // Ahora comprobamos que tenga al menos 4 caracteres
            else if (document.getElementById('username').value.length < 4) {
                document.getElementById('errorMessage4').classList.remove('hidden');
                document.getElementById('username').classList.add('border-red-500');
                document.getElementById('username').focus();
                setTimeout(() => {
                    document.getElementById('username').classList.remove('border-red-500');
                    // Quitamos el mensaje de error
                    document.getElementById('errorMessage4').classList.add('hidden');
                }, 2000);
            }
            else if(document.getElementById('nombre').value == '' ){
                // Mostramos mensaje de error y ponemos un borde rojo al input durante 2 segundos con autofocus
                document.getElementById('errorMessage1').classList.remove('hidden');
                document.getElementById('nombre').classList.add('border-red-500');
                document.getElementById('nombre').focus();
                setTimeout(() => {
                    document.getElementById('nombre').classList.remove('border-red-500');
                    // Quitamos el mensaje de error
                    document.getElementById('errorMessage1').classList.add('hidden');
                }, 2000);

            }
            else if(document.getElementById('nombre').value.length < 4){
                document.getElementById('errorMessage4').classList.remove('hidden');
                document.getElementById('nombre').classList.add('border-red-500');
                document.getElementById('nombre').focus();
                setTimeout(() => {
                    document.getElementById('nombre').classList.remove('border-red-500');
                    // Quitamos el mensaje de error
                    document.getElementById('errorMessage4').classList.add('hidden');
                }, 2000);
            }
            else if(document.getElementById('edad').value == ''){
                document.getElementById('errorMessage2').classList.remove('hidden');
                document.getElementById('edad').classList.add('border-red-500');
                document.getElementById('edad').focus();
                setTimeout(() => {
                    document.getElementById('edad').classList.remove('border-red-500');
                    // Quitamos el mensaje de error
                    document.getElementById('errorMessage2').classList.add('hidden');
                }, 2000);
            }
            else if(document.getElementById('edad').value < 18 || document.getElementById('edad').value > 122){
                document.getElementById('errorMessage2').classList.remove('hidden');
                document.getElementById('edad').classList.add('border-red-500');
                document.getElementById('edad').focus();
                setTimeout(() => {
                    document.getElementById('edad').classList.remove('border-red-500');
                    // Quitamos el mensaje de error
                    document.getElementById('errorMessage2').classList.add('hidden');
                }, 2000);
            }
            else{
                // Hacemos una peticion POST a editarPerfil con los datos
                fetch('/editarPerfil2', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        username: document.getElementById('username').value,
                        nombre: document.getElementById('nombre').value,
                        edad: document.getElementById('edad').value,
                        sexo: document.getElementById('sexo').value,
                        pais: document.getElementById('pais').value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Si es succes mostramos mensaje de exito
                    if(data.success){
                        document.getElementById('successMessage').classList.remove('hidden');
                        setTimeout(() => {
                            fetchDatos();
                            var modal = document.getElementById('editarPerfilModal');
                            modal.classList.add('hidden');
                        }, 1000);
                    }
                    else{
                        document.getElementById('errorMessage3').classList.remove('hidden');
                        document.getElementById('username').classList.add('border-red-500');
                        document.getElementById('username').focus();
                        setTimeout(() => {
                            document.getElementById('username').classList.remove('border-red-500');
                            // Quitamos el mensaje de error
                            document.getElementById('errorMessage3').classList.add('hidden');
                        }, 2000);
                    }
                });

                
        }

    }
}








    function esconderMensaje() {

        document.getElementById('errorMessage1').classList.add('hidden');
        document.getElementById('errorMessage2').classList.add('hidden');
        document.getElementById('errorMessage3').classList.add('hidden');
        document.getElementById('successMessage').classList.add('hidden');
        document.getElementById('errorMessageFoto').classList.add('hidden');
        document.getElementById('errorPesoFoto').classList.add('hidden');
        document.getElementById('successMessageFoto').classList.add('hidden');
        document.getElementById('errorTypeFoto').classList.add('hidden');


    }

    function logout(){
        fetch('/logout')
        .then(response => response.json())
        .then(data => {
            if(data.success){
                window.location.href = '/';
            }
        });
    }

    
</script>

