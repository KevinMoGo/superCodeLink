<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Amigos</title>
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estructura.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navegador.css') }}">
    @include('head.header')
    <style>
        div.containerAmigos {
            margin-top: 12vh;
        }
        .friend-list {
            list-style: none;
            padding: 0;
        }
        .friend-container {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        .friend-info {
            display: flex;
            align-items: center;
        }
        .friend-name {
            margin-right: 20px;
            font-size: 18px;
            color: #333; /* Cambiado a un color más oscuro para mayor contraste */
        }
        .custom-default {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .botonesAmigo {
            display: flex;
        }
        .botonesAmigo a {
            margin-right: 10px;
        }
        .iconoAmigo {
            width: 24px; /* Ajustado el tamaño de los íconos */
            height: 24px;
        }
        .no-amigos {
            margin-top: 10px;
            color: #666; /* Color de texto más claro */
        }
    </style>
</head>
<body>
    @include('nav.navbar')
    <div class="containerAmigos">
        <ul class="friend-list">
            @forelse ($amigos as $amigo)
            <li class="friend-container">
                <div class="friend-info">
                    <img src="{{ asset('svg/usuario_defecto.svg') }}" alt="default" class="custom-default">
                    <div>
                        <div class="datosAmigo">
                            <p class="friend-username">{{ '@' . $amigo->username }}</p>
                            <p class="friend-name">{{ $amigo->nombre }}</p>
                        </div>
                        <div class="botonesAmigo">
                            <a href="#"><img src="{{ asset('svg/mensaje.svg') }}" alt="menu" class="iconoAmigo"></a>
                            <a href="#"><img src="{{ asset('svg/borrarAmigo.svg') }}" alt="menu" class="iconoAmigo"></a>
                        </div>
                    </div>
                </div>
            </li>
            @empty
            <li class="no-amigos">No tienes amigos todavía.</li>
            @endforelse
        </ul>
        <a href="/inicio">Volver al inicio</a>
    </div>
</body>
</html>
