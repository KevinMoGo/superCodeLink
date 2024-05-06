<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
        }

        .container {
            border: 1px solid #ccc;
            max-width: 1200px;
            min-height: 360px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            width: 100px;
            display: inline-block;
        }

        input[type="text"], input[type="password"], .botonRegistro {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: black;
            outline: none;
        }

        .botonRegistro {
            background-color: black;
            color: white;
            border: 1px solid black;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            text-align: center;
        }

        botonRegistro:hover {
            background-color: transparent;
            color: black;

        }

        .mensajeError1{
            display: none;
            color: red;
        }

        .mensajeError2{
            display: none;
            color: red;
        }

        .mensajeSuccess{
            display: none;
            color: green;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Registro de usuarios</h1>
        
        <form autocomplete="off">
            @csrf
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" autofocus autocomplete="off">
            </div>
            <div>
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" autocomplete="off">
            </div>
            <div>
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" autocomplete="new-password">
            </div>
            <a href="javascript:void(0)" class="botonRegistro" onclick="registroUsuario()" >Regístrate</a>
        </form>
        <p class="mensajeError1">
            Rellene todos los campos
        </p>
        <p class="mensajeError2">
            <!-- El usuario ya existe -->
        </p>
        <p class="mensajeSuccess">
            <!-- Usuario registrado correctamente -->
        </p>

    </div>
</body>
</html>


<!-- <script type="text/javascript">
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
                    // Find the image container with the corresponding id and remove it
                    document.querySelector('#imagen' + idAmigo).remove();
                }
            });
        }
    }
</script> -->

<script type="text/javascript">
    function registroUsuario(){
        // Reinicializamos los mensajes de error y éxito con display none
        document.querySelector('.mensajeError1').style.display = 'none';
        document.querySelector('.mensajeError2').style.display = 'none';
        document.querySelector('.mensajeSuccess').style.display = 'none';

        let nombre = document.getElementById('nombre').value;
        let usuario = document.getElementById('usuario').value;
        let contrasena = document.getElementById('contrasena').value;

        if(nombre == '' || usuario == '' || contrasena == ''){
            document.querySelector('.mensajeError1').style.display = 'block';
            document.querySelector('.mensajeError2').style.display = 'none';
        }
        else{
            fetch('/creaUsuario', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    nombre: nombre,
                    usuario: usuario,
                    contrasena: contrasena
                })
            })
            // Recibimos la respuesta en formato JSON y si es success mostramos el mensaje de éxito que nos devuelve el servidor, si es un error mostramos el mensaje de error
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    document.querySelector('.mensajeSuccess').style.display = 'block';
                    document.querySelector('.mensajeSuccess').textContent = result.success;

                    // Cuenta atrásd de 5 segundos para redirigir al usuario a la página de login
                    let segundos = 5;
                    setInterval(function(){
                        segundos--;
                        if(segundos == 0){
                            window.location.href = '/login';
                        }
                    }, 1000);
                }
                else if (result.error) {
                    document.querySelector('.mensajeError2').style.display = 'block';
                    document.querySelector('.mensajeError2').textContent = result.error;
                    // Hacemos un focus en el campo de usuario para que el usuario pueda corregirlo
                    document.getElementById('usuario').focus();
                    // Ponemos hacemos que su borde al estar focuseado sea de color rojo, cuando pulse otro campo volverá a su color original
                    document.getElementById('usuario').style.borderColor = 'red';
                    document.getElementById('usuario').addEventListener('focusout', function(){
                        document.getElementById('usuario').style.borderColor = '#ccc';
                    });
                    // Ahora cuando el usuario pulse en el campo de usuario, el borde volverá a ser black
                    document.getElementById('usuario').addEventListener('focus', function(){
                        document.getElementById('usuario').style.borderColor = 'black';
                    });

                    
                }
            });
        }
    }
</script>