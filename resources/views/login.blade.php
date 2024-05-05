<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
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
        }

        .container {
            max-width: 600px;
            width: 90%;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
            overflow: hidden; /* Evita que los elementos se salgan del contenedor */
        }

        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            min-width: 100px; /* Cambiado a min-width para evitar que las etiquetas sean demasiado pequeñas */
            display: inline-block;
            color: #333;
        }

        input[type="text"], input[type="password"], button {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #666;
            font-size: 16px;
            transition: border-color 0.3s ease;
            width: calc(100% - 22px); /* Ajustado el ancho para tener en cuenta el padding y el borde */
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #000;
            outline: none;
        }

        button {
            background-color: #000;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: auto;
        }

        button:hover {
            background-color: #333;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #000;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Media query para iPads y PCs */
        @media screen and (min-width: 768px) {
            .container {
                width: 60%;
            }

            h1 {
                font-size: 28px;
            }

            label {
                min-width: 150px;
            }

            input[type="text"], input[type="password"], button {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        
        <form method="POST" action="/login">
            @csrf
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" autofocus>
            </div>
            <div>
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena">
            </div>
            <button type="submit">Ingresar</button>
        </form>
        <a href="/registro">Crea una cuenta</a>
    </div>
</body>
</html>
