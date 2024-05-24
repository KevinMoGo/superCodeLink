<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-800 flex justify-center items-center h-screen">
    <div class="container max-w-lg w-full p-8 bg-white shadow-md rounded-md mx-4">
        <h1 class="text-center text-3xl mb-8 text-gray-800">Login</h1>
        
        <div class="space-y-4">
            @csrf
            <div>
                <label for="username" class="text-gray-800">Username:</label>
                <input type="text" id="username" name="username" autofocus autocomplete="off" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black" maxlength="21">
            </div>
            <div>
                <label for="contrasena" class="text-gray-800">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" autocomplete="new-password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black" maxlength="21">
            </div>
            <button type="button" class="w-full px-4 py-2 bg-black text-white rounded-md transition duration-300 hover:bg-gray-900" onclick="login()">Ingresar</button>
        </div>
        <a href="/registro" class="block text-center mt-4 text-black hover:underline">Crea una cuenta</a>
        <p id="mensajeError" class="text-center text-red-500 mt-4 hidden">El usuario o la contraseña son incorrectos</p>
        <p id="mensajeError2" class="text-center text-red-500 mt-4 hidden">Rellena todos los campos</p>
        <p id="mensajeSuccess" class="text-center text-green-500 mt-4 hidden">¡Bienvenid@!</p>
    </div>
</body>
</html>

<script>

    function login() {
        esconderMensajes();
        let username = document.getElementById('username').value;
        let contrasena = document.getElementById('contrasena').value;
        console.log(username, contrasena);

        if (username === '' || contrasena === '') {
            esconderMensajes();
            
            document.getElementById('mensajeError2').classList.remove('hidden');
            document.getElementById('mensajeError').classList.add('hidden');
            document.getElementById('mensajeSuccess').classList.add('hidden');
            return;
        }

        document.getElementById('mensajeError2').classList.add('hidden');

        fetch('/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                username: username,
                contrasena: contrasena
            })
        })
        .then(response => response.json())
        .then(data => {
            // Si es success muestra mensaje de bienvenida y en 1s redirige a la página de inicio
            if (data.success) {
                document.getElementById('mensajeSuccess').classList.remove('hidden');
                document.getElementById('mensajeError').classList.add('hidden');
                document.getElementById('mensajeError2').classList.add('hidden');
                setTimeout(() => {
                    window.location.href = '/inicio';
                }, 1000);
            } else {
                // Si es error muestra mensaje de error
                document.getElementById('mensajeError').classList.remove('hidden');
                document.getElementById('mensajeSuccess').classList.add('hidden');
                document.getElementById('mensajeError2').classList.add('hidden');
            }
        });
    }

    function esconderMensajes() {
        document.getElementById('mensajeError').classList.add('hidden');
        document.getElementById('mensajeSuccess').classList.add('hidden');
        document.getElementById('mensajeError2').classList.add('hidden');
    }
</script>