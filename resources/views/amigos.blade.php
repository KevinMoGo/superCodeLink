<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Lista de Amigos</title>
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estructura.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navegador.css') }}">
    @include('head.header')
    <style>
        *{
            
        }
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
            
            width: 100%;
            justify-content: space-between;
        }
        div.amigo img{
            width: 75px;
            height: 75px;
            border-image: linear-gradient(135deg, #000, #fff, #fff, #000);
            border-image-slice: 1;
            margin-right: 10px;
            object-fit: cover;
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

        .eliminarAmigo{
            background-color: transparent;
            color: red;
            
            padding: 5px;
        }
        .eliminarAmigo:hover{
            background-color: red;
            color: white;
        }

        .escribirAmigo{
            background-color: transparent;
            color: blue;
            border: 1px solid blue;
            padding: 5px;
        }
        .escribirAmigo:hover{
            background-color: blue;
            color: white;
        }

        @media screen and (min-width: 768px) {
            div.amigo img{
                width: 115px;
                height: 115px;
            }
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
                // Hacemos que su id sea imagen + el id del amigo por ejemplo "imagen1", "imagen2", etc
                divAmigo.id = "imagen" + amigo.id;

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

                containerAmigos.appendChild(divAmigo);

                // Creamos un elemento a que tenga como dato interno el id del amigo y cuando cliquemos en el muestre un alert con el id del amigo
                var aEliminar = document.createElement('a');
                aEliminar.href = "javascript:void(0)";
                aEliminar.textContent = "Eliminar";
                aEliminar.classList.add('escribirAmigo');

                // Funcion flecha que muestra un alert con el id del amigo
                aEliminar.onclick = () => {
                    eliminarAmigo(amigo.id);
                }
                var gestionAmigos = document.createElement('div');
                gestionAmigos.classList.add('gestionAmigos');
                gestionAmigos.appendChild(aEliminar);

                divAmigo.appendChild(gestionAmigos);





            });
        });
    }

    getAmigos(userID);
</script>




<script type="text/javascript">
    function eliminarAmigo(idAmigo){
        if (confirm("¿Estás seguro de que deseas eliminar a este amigo?")) {
            fetch('/delete_amigo/' + idAmigo, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(result => {
                if (result) {
                    // Find the image container with the corresponding id and remove it
                    document.querySelector('#imagen' + idAmigo).remove();
                }
            });
        }
    }
</script>


