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
            position: relative; /* Establece el cuerpo como un elemento de posición relativa */
        }

        .custom-container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: fixed; /* Fija el contenedor en la ventana del navegador */
            top: 50%; /* Lo coloca en el centro vertical */
            left: 50%; /* Lo coloca en el centro horizontal */
            transform: translate(-50%, -50%); /* Lo ajusta al centro exacto */
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
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .custom-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .custom-name {
            margin-right: 20px;
            font-size: 18px;
            color: #333;
            min-width: 100px;
            max width: 100px;
        }

        .custom-button {
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: #007bff;
        }

        .custom-button:hover {
            background-color: #0056b3;
        }

        .custom-button.sent {
            background-color: orange;
        }

        .custom-button.friend {
            background-color: green;
        }

        .custom-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
            position: absolute; /* Fija el enlace en la ventana del navegador */
            bottom: 20px; /* Lo coloca en la parte inferior */
            left: 50%; /* Lo coloca en el centro horizontal */
            transform: translateX(-50%); /* Lo ajusta al centro exacto */
        }

        .custom-link:hover {
            text-decoration: underline;
        }

        .custom-info img {
            width: 50px;
            height: auto;
            margin-right: 20px;
            border: 1px solid transparent;
            border-image: linear-gradient(135deg, #000, #fff, #fff, #000);
            border-image-slice: 1;
        }
        .custom-user {
            display: flex;
            align-items: center;
        }

        form {
            display: flex;
            align-items: center;
            
        }

        @media screen and (min-width: 768px) {
    .custom-container {
        width: 80%; /* Cambiado para hacerlo responsive */
    }

    .custom-info {
        flex-direction: row; /* Alinea los elementos en fila en pantallas más grandes */
    }

    .custom-name {
        min-width: auto; /* Elimina el ancho mínimo para el nombre */
        max-width: none; /* Elimina el ancho máximo para el nombre */
        margin-right: 20px; /* Ajusta el margen */
    }
}


    </style>
</head>

<body>
    @include('nav.navbar')

    <div class="custom-container">

        <ul class="custom-list">
            @foreach ($usuarios as $usuario)
                <li class="custom-item">
                    <div class="custom-info">
                        <div class="custom-user">
                        <a href="#"><img src="{{ asset('svg/usuario_defecto.svg') }}" alt="default" class="custom-default"></a>
                        <p class="custom-name">{{ $usuario->nombre }}</p>
                        </div>
                        <form method="POST" action="/agregar-solicitud/{{ $usuario->id }}">
                            @csrf
                            @if ($solicitudes->contains('usuario_receptor_id', $usuario->id))
                                <button class="custom-button sent" disabled>Solicitud enviada</button>
                            @elseif ($amigos->contains('usuario1_id', $usuario->id) || $amigos->contains('usuario2_id', $usuario->id))
                                <button class="custom-button friend" disabled>Amigo</button>
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
