<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de la búsqueda</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estructura.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navegador.css') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .custom-container {
            width: 80%;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .custom-list {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .custom-item {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-info {
            display: flex;
            align-items: center;
        }

        .custom-name {
            margin-right: 20px;
            font-size: 18px;
            color: #333;
        }

        .custom-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: #007bff;
        }

        .custom-button:hover {
            background-color: #0056b3;
        }

        .custom-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }

        .custom-link:hover {
            text-decoration: underline;
        }

        .custom-info img {
            width: 50px; /* Ajusta el ancho de la imagen según tus necesidades */
            height: auto; /* Mantenemos la relación de aspecto */
            border-radius: 50%; /* Esto es opcional, para redondear la imagen */
            margin-right: 20px; /* Ajusta el espacio entre la imagen y el nombre */
            border: 1px solid #ccc; /* Añadimos un borde a la imagen */
        }
    </style>
</head>

<body>
@include('nav.navbar')

    <div class="custom-container">
        <h1 class="custom-title">Resultados de la búsqueda</h1>

        <ul class="custom-list">
            @foreach ($usuarios as $usuario)
                <li class="custom-item">
                    <div class="custom-info">
                        <a href="#"><img src="{{ asset('svg/usuario_defecto.svg') }}" alt="default" class="custom-default"></a>
                        <p class="custom-name">{{ $usuario->nombre }}</p>
                        <form method="POST" action="/agregar-solicitud/{{ $usuario->id }}">
                            @csrf
                            @if ($solicitudes->contains('usuario_receptor_id', $usuario->id))
                                <button class="custom-button" disabled>Solicitud enviada</button>
                            @elseif ($amigos->contains('usuario1_id', $usuario->id) || $amigos->contains('usuario2_id', $usuario->id))
                                <button class="custom-button" disabled>Amigo</button>
                            @else
                                <button class="custom-button" type="submit">Enviar solicitud</button>
                            @endif
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        
        <a href="/inicio" class="custom-link">Volver al inicio</a>
    </div>
</body>
</html>
