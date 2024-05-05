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
            max-width: 1200px;
            margin: 0 auto;
            
        }

        div.amigo{
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid red;
            width: 100%;
            justify-content: space-between;
        }
        div.amigo img{
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
            
        }

        div.gestionAmigos{
            display: flex;
            gap: 10px;
            justify-content: end;
        }

        div.fotoNombre{
            display: flex;
            gap: 10px;
            align-items: center;
        }

    </style>
</head>
<body>
        @include('nav.navbar')

        <div class="containerAmigos">
        
        </div>
    

</body>
</html>

<script>
    // Extraemos el ID del usuario de la variable de sesión {{ session('user_id') }}
    var userID = {{ session('user_id') }};
    
    function getAmigos(id){
        fetch('/apiAmigos/' + id)
        .then(response => response.json())
        // Extraemos los datos de la respuesta uno por uno y los mostramos en la consola
        .then(data => {
            console.log(data);
            var containerAmigos = document.querySelector('.containerAmigos');
            data.forEach(amigo => {
                // Creamos un div para cada amigo con la clase "amigo"
                var divAmigo = document.createElement('div');
                divAmigo.classList.add('amigo');

                // Ahora creamos una imagen con la foto del amigo
                var imgAmigo = document.createElement('img');

                // sacamos la ruta del json y la asignamos a la imagen
                imgAmigo.src = amigo.PP;

                // Ahora creamos un span con el nombre del amigo
                var spanAmigo = document.createElement('span');
                spanAmigo.textContent = amigo.nombre;

                // metemos la imagen y el span dentro dentro de un nuevo div cuya clase es "fotoNombre"
                var divFotoNombre = document.createElement('div');
                divFotoNombre.classList.add('fotoNombre');
                divFotoNombre.appendChild(imgAmigo);
                divFotoNombre.appendChild(spanAmigo);

                divAmigo.appendChild(divFotoNombre);

                // Creamos 2 botones y los metemos dentro de un div cuya clase es "gestionAmigos"
                var divBotones = document.createElement('div');
                divBotones.classList.add('gestionAmigos');

                var buttonEliminar = document.createElement('button');
                buttonEliminar.textContent = 'Eliminar';
                buttonEliminar.classList.add('eliminarAmigo');
                buttonEliminar.dataset.id = amigo.id;

                var buttonEscribir = document.createElement('button');
                buttonEscribir.textContent = 'Escribir';
                buttonEscribir.classList.add('escribirAmigo');
                buttonEscribir.dataset.id = amigo.id;

                divBotones.appendChild(buttonEliminar);
                divBotones.appendChild(buttonEscribir);

                divAmigo.appendChild(divBotones);

                // Por último añadimos el div al contenedor de amigos
                containerAmigos.appendChild(divAmigo);

            });
        });
    }

    getAmigos(userID);
</script>



