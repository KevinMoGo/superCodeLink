<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Amigos</h1>

    <ul>
        @foreach ($amigos as $amigo)
            <li>
                {{ $amigo->nombre }}
            </li>
        @endforeach
    <a href="/inicio">Volver al inicio</a>
</body>
</html>