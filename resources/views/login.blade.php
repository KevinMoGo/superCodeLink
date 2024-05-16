<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-800 flex justify-center items-center h-screen">
    <div class="container max-w-lg w-full p-8 bg-white shadow-md rounded-md mx-4">
        <h1 class="text-center text-3xl mb-8 text-gray-800">Login</h1>
        
        <form method="POST" action="/auth" class="space-y-4">
            @csrf
            <div>
                <label for="username" class="text-gray-800">Username:</label>
                <input type="text" id="username" name="username" autofocus autocomplete="off" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black">
            </div>
            <div>
                <label for="contrasena" class="text-gray-800">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" autocomplete="new-password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-black">
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-black text-white rounded-md transition duration-300 hover:bg-gray-900">Ingresar</button>
        </form>
        <a href="/registro" class="block text-center mt-4 text-black hover:underline">Crea una cuenta</a>
    </div>
</body>
</html>
