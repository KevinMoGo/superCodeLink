<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de la búsqueda</title>
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
            min-height: 100vh;
            flex-direction: column;
        }

        .container {
            width: 80%;
            max-width: 600px;
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        li {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info {
            display: flex;
            align-items: center;
        }

        .name {
            margin-right: 20px;
            font-size: 18px;
            color: #333;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: #007bff;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }

        .title {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .user-image {
            width: 10px; /* Ajusta el tamaño del ancho de la imagen */
            height: 10px; /* Ajusta el tamaño del alto de la imagen */
            border-radius: 50%;
            border: 2px solid #007bff;
        }
    </style>
</head>
<body>
    <h1 class="title">Resultados de la búsqueda</h1>

    <div class="image-container">
        <a href="#"><img src="{{ asset('svg/usuario_defecto.svg') }}" alt="default" class="user-image"></a>
    </div>

    <div class="container">
        <ul>
            @foreach ($usuarios as $usuario)
                <li>
                    <div class="info">
                        <p class="name">{{ $usuario->nombre }}</p>
                        <form method="POST" action="/agregar-solicitud/{{ $usuario->id }}">
                            @csrf
                            @if ($solicitudes->contains('usuario_receptor_id', $usuario->id))
                                <button disabled>Solicitud enviada</button>
                            @elseif ($amigos->contains('usuario1_id', $usuario->id) || $amigos->contains('usuario2_id', $usuario->id))
                                <button disabled>Amigo</button>
                            @else
                                <button type="submit">Enviar solicitud</button>
                            @endif
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        
        <a href="/inicio">Volver al inicio</a>
    </div>
</body>
</html>
