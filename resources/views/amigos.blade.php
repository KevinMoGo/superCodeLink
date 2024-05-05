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
        body{
            margin-top: 12vh;
        }
        div.containerAmigos {
            margin-top: 12vh;
        }

    </style>
</head>
<body>
        @include('nav.navbar')
        <p class="userID">
        {{ session('user_id') }}
        </p>
        <div class="containerAmigos">
            
        </div>
    

</body>
</html>

<script>
    var userID = document.querySelector('.userID').textContent;
    function getAmigos(id){
        fetch('/apiAmigos/' + id)
        .then(response => response.json())
        // Extraemos los datos de la respuesta uno por uno y los mostramos en la consola
        .then(data => {
            console.log(data);
            var containerAmigos = document.querySelector('.containerAmigos');
            data.forEach(amigo => {
                var div = document.createElement('div');
                div.innerHTML = `
                    <p>${amigo.nombre}</p>
                    
                `;
                containerAmigos.appendChild(div);
            });
        });
    }

    getAmigos(userID);
</script>



