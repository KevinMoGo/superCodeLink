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
            overflow-y: hidden;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            
            max-width: calc(100% - 20px);
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
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
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="file"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .subbody {
            /* Todo su contenido se centrara vertical y horizontamlente */
            align-items: center;
            margin-top: 12vh;
            display: flex;
            justify-content: center;
            height: 88vh;
            overflow-y: hidden;
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

            <button type="submit">Subir</button>
        </form>
    </div>
    </div>
</body>
</html>
