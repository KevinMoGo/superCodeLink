
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
    <div class="fixed top-0 right-0 h-full bg-gray-800 text-white w-64 space-y-6 py-7 px-2" style="margin-top: 12vh;">
        <!-- User Info -->
        <div class="flex items-center space-x-4 p-2">
            <div class="relative">
                <img src="{{ asset('assets/fotosPerfil/usuario_defecto.svg') }}" alt="User Photo" class="h-16 w-16 rounded-full object-cover" id="fotoUsuarioBarra">
                <a href="javascript:void(0)" class="absolute bottom-0 right-0 bg-blue-500 rounded-full p-1" id="botonEditarPPModal">
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
                <a href="javascript:void(0)" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700" id = "editarPerfil">
                    Editar Perfil
                </a>
            </li>
            <li>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    Mis Likes
                </a>
            </li>
            <li>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
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
                <input type="number" id="edad" name="edad" placeholder="Edad" class="block w-full mt-2 mb-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" min="1" max="120">
                <select id="sexo" name="sexo" placeholder="Sexo" class="block w-full mt-2 mb-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="hombre">Hombre</option>
                    <option value="mujer">Mujer</option>
                </select>
                <select id="pais" name="pais" placeholder="País" class="block w-full mt-2 mb-4 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </select>
                <div class="flex justify-center"> <!-- Centra los botones -->
                    <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mr-2" onclick = "guardarCambios()">Guardar</button>
                    <button type="button" class="bg-gray-200 text-gray-700 py-2 px-4 rounded hover:bg-gray-300" onclick="closeEditar()">Cancelar</button>
                </div>
                <!-- Mensajes de error -->
                <div id="errorMessages" class="text-red-500 mt-4">
                    <p id="errorMessage1" class="hidden">Error: Debes llenar todos los campos</p>
                    <p id="errorMessage2" class="hidden">Ingrese una edad válida.</p>
                    <p id="errorMessage3" class="hidden">El nombre de usuario ya en uso</p>
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
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/datosBarra')
            .then(response => response.json())
            .then(
                data => {
                    
                    document.getElementById('nombreUsuarioBarra').innerText = data.nombre;
                    document.getElementById('usernameBarra').innerText = '@' + data.username;
                    document.getElementById('fotoUsuarioBarra').src = data.PP;
                }
            )   


            

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

            fetch('/getDatosPerfil')
            .then(response => response.json())
            .then(data => {
                
                document.getElementById('username').value = data.username;
                document.getElementById('nombre').value = data.nombre;
                document.getElementById('edad').value = data.edad;
                document.getElementById('sexo').value = data.sexo;
                document.getElementById('pais').value = data.pais;
            });
    });
    function abrirMenu() {
    
        var sidebar = document.getElementById('sidebar');
        if (sidebar.classList.contains('hidden')) {
            sidebar.classList.remove('hidden');
        } else {
            sidebar.classList.add('hidden');
        }
    }

    document.getElementById('botonEditarPPModal').addEventListener('click', function() {
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
        // Esconde los mensajes de error
        document.getElementById('errorMessageFoto').classList.add('hidden');

        var fotoPerfil = document.getElementById('fotoPerfil').files[0];
        // primero comprobamos si esta vacio
        if (fotoPerfil == null) {
            document.getElementById('errorMessageFoto').classList.remove('hidden');
        }
        else{
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
                
                // Mostar mensaje de éxito
                document.getElementById('successMessageFoto').classList.remove('hidden');
                // Recargamos la página en 1 segundo
                setTimeout(() => {
                    location.reload();
                }, 1000);
                
            });

        }

    }

    document.getElementById('editarPerfil').addEventListener('click', function() {
        var modal = document.getElementById('editarPerfilModal');
        // Le quitamos la clase hidden
        modal.classList.remove('hidden');


    });

    function closeEditar() {
        var modal = document.getElementById('editarPerfilModal');
        // Le agregamos la clase hidden
        modal.classList.add('hidden');
    }


    
</script>


<script>
    function guardarCambios() {
        // Esconde los mensajes de error
        document.getElementById('errorMessage1').classList.add('hidden');
        document.getElementById('errorMessage2').classList.add('hidden');
        document.getElementById('errorMessage3').classList.add('hidden');
        var username = document.getElementById('username').value;
        var nombre = document.getElementById('nombre').value;
        var edad = document.getElementById('edad').value;
        var sexo = document.getElementById('sexo').value;
        var pais = document.getElementById('pais').value;

        // Comprobamos si alguno de los campos está vacío
        if (username == '' ){
            // Hacemos un focus al input y mostrar el mensaje de error y le ponemos un border rojo durante 2 segundos
            document.getElementById('username').focus();
            document.getElementById('errorMessage1').classList.remove('hidden');
            document.getElementById('username').style.border = '1px solid red';
            setTimeout(() => {
                document.getElementById('username').style.border = '1px solid #D1D5DB';
            }, 2000);
        }
        else if(nombre == ''){
            document.getElementById('nombre').focus();
            document.getElementById('errorMessage1').classList.remove('hidden');
            document.getElementById('nombre').style.border = '1px solid red';
            setTimeout(() => {
                document.getElementById('nombre').style.border = '1px solid #D1D5DB';
            }, 2000);
        }
        else if(edad == ''){
            document.getElementById('edad').focus();
            document.getElementById('errorMessage1').classList.remove('hidden');
            document.getElementById('edad').style.border = '1px solid red';
            setTimeout(() => {
                document.getElementById('edad').style.border = '1px solid #D1D5DB';
            }, 2000);
        }
        else if(sexo == ''){
            document.getElementById('sexo').focus();
            document.getElementById('errorMessage1').classList.remove('hidden');
            document.getElementById('sexo').style.border = '1px solid red';
            setTimeout(() => {
                document.getElementById('sexo').style.border = '1px solid #D1D5DB';
            }, 2000);
        }
        else if(pais == ''){
            document.getElementById('pais').focus();
            document.getElementById('errorMessage1').classList.remove('hidden');
            document.getElementById('pais').style.border = '1px solid red';
            setTimeout(() => {
                document.getElementById('pais').style.border = '1px solid #D1D5DB';
            }, 2000);
        }
        else if(edad < 18 || edad > 120){
            document.getElementById('edad').focus();
            document.getElementById('errorMessage2').classList.remove('hidden');
            document.getElementById('edad').style.border = '1px solid red';
            setTimeout(() => {
                document.getElementById('edad').style.border = '1px solid #D1D5DB';
            }, 2000);
        }
        else{
            // Hacemos un fetch posta  /guardarPerfil y manejamos data con .then
            fetch('/guardarPerfil', {
                method: 'POST',
                body: JSON.stringify({
                    username: username,
                    nombre: nombre,
                    edad: edad,
                    sexo: document.getElementById('sexo').value,
                    pais: document.getElementById('pais').value
                }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                
                // Si data.error es true, mostramos el mensaje de error de que el nombre de usuario ya está en uso
                if (data.error) {
                    document.getElementById('errorMessage3').classList.remove('hidden');
                }
                else{
                    document.getElementById('successMessageFoto').classList.remove('hidden');
                    setTimeout(() => {
                        document.getElementById('successMessageFoto').classList.add('hidden');
                    }, 2000);

                    
                    
                }

            });
        }
    }
</script>
