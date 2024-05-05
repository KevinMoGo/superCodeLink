<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen</title>
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estructura.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navegador.css') }}">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 600px;
            margin: auto;
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
        }

        input[type="text"], input[type="file"], button {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: border-color 0.3s ease;
            width: 100%; /* Ancho completo */
        }

        input[type="text"]:focus, input[type="file"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            background-color: black;
            color: white;
            border: 1px solid black;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%; /* Ancho completo */
        }

        button:hover {
            background-color: white;
            color: black;
            border: 1px solid black;
        }

        /* Estilos para hacer el formulario responsive */
        .subbody {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        @media (max-width: 768px) {
            .container {
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
    @include('nav.navbar')

    <div class="subbody">
        <div class="container">
            <h1>Subir Imagen</h1>
            <form action="/subir" method="post" enctype="multipart/form-data">
                @csrf
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo" id="titulo">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion">
                <label for="foto">Seleccionar imagen</label>
                <input type="file" name="foto" id="foto">
                <button type="submit">SUBIR</button>
            </form>
        </div>
    </div>
</body>
</html>
