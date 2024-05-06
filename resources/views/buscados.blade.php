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

        
        body {
            background-color: #f0f2f5;
            display: flex;
            margin-top: 12vh;
            height: 88vh;
            overflow: hidden;
        }

        .custom-container {
            width: 100%;
            max-height: 100%;
            overflow-y: scroll;
            max-width: 1200px;
            padding: 0 20px 20px 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            
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
            width: 100%;
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
            width: 100px;
            white-space: nowrap;
            
            text-overflow: ellipsis;
            border: 1px solid transparent;

        }

        .custom-button{
            // Le damos un ancho fijo para que no se expanda ni se contraiga
            mix-width: 100px;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: black;
            text-overflow: ellipsis;
        }

        .custom-button:hover {
            background-color: white;
            color: black;
            border: 1px solid black;
        }

        .custom-button.sent {
            background-color: orange;
            width: 100px;
            border: 1px solid white;
            color: white;
        }

        .custom-button.friend {
            min-width: 100px;
            background-color: white;
            color: green;
            border: 1px solid green;
            
        }

        .custom-button.enviar {
            min-width: 100px;

            
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
            width: 75px;
            height: 75px;
            margin-right: 20px;
            border: 1px solid transparent;
            border-image: linear-gradient(135deg, #000, #fff, #fff, #000);
            border-image-slice: 1;
            object-fit: cover;

        }
        .custom-user {
            display: flex;
            align-items: center;
            width: auto;
        }


        form {
            display: flex;
            align-items: center;
            
        }

        @media screen and (min-width: 768px) {

            .custom-info img {
            width: 115px;
            height: 115px;
            

        }
    .custom-container {
        width: 80%; /* Cambiado para hacerlo responsive */
    }

    .custom-info {
        flex-direction: row; /* Alinea los elementos en fila en pantallas más grandes */
    }

    .custom-button.friend {
        width: 150px;
    }

    .custom-button.sent {
        width: 150px;
    }

    .custom-button {
        width: 150px;
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
                        <a href="#"><img src="{{ $usuario->PP }}" alt="default" class="custom-image"></a>
                        <p class="custom-name">{{ $usuario->nombre }}</p>
                        
                        </div>
                        <form method="POST" action="/agregar-solicitud/{{ $usuario->id }}">
                            @csrf
                            @if ($solicitudes->contains('usuario_receptor_id', $usuario->id))
                                <button class="custom-button sent" disabled>Enviada</button>
                            @elseif ($amigos->contains('usuario1_id', $usuario->id) || $amigos->contains('usuario2_id', $usuario->id))
                                <button class="custom-button friend" disabled>Amigo</button>
                            @else
                                <button class="custom-button enviar" type="submit">Enviar</button>
                            @endif
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        
        
    </div>
</body>
</html>
