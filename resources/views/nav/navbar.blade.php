<nav>
    <ul>
    <li><a href="/inicio"><img src="{{ asset('svg/home.svg') }}" alt="casa" class="icono"></a></li>
    <li><a href="/amigos"><img src="{{ asset('svg/gente.svg') }}" alt="gente" class="icono"></a></li>
    <li><a href="misimagenes"><img src="{{ asset('svg/archivo.svg') }}" alt="buscar" class="icono"></a></li>
    <li><a href="/registroSubir"><img src="{{ asset('svg/subir.svg') }}" alt="subir" class="icono"></a></li>
    <li><a href="/notis"><img src="{{ asset('svg/notificacion.svg') }}" alt="notificacion" class="icono"></a></li>
    <li class="Menu"><a href="#"><img src="{{ asset('svg/menu.svg') }}" alt="menu" class="icono"></a></li>
    </ul>
</nav>

<script>
    var menu = document.querySelector('.Menu');
    menu.addEventListener('click', function(){
        document.querySelector('.menu').style.right = '0';
    });
</script>

<!-- script para que cuando pasemos el raton por encima de un elemento li el img svg se haga de color negro -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elementosLi = document.querySelectorAll('nav ul li');
        
        elementosLi.forEach(function(li) {
            li.addEventListener('mouseover', function() {
                // Cambiar el color de fondo del li a blanco
                li.style.backgroundColor = 'white';
                
                // Aplicar un filtro invertido a la imagen dentro del li
                var imagen = li.querySelector('img');
                if (imagen) {
                    imagen.style.filter = 'invert(1)';
                }
            });

            li.addEventListener('mouseout', function() {
                // Restablecer el color de fondo del li
                li.style.backgroundColor = 'initial';
                
                // Eliminar el filtro invertido de la imagen
                var imagen = li.querySelector('img');
                if (imagen) {
                    imagen.style.filter = 'initial';
                }
            });
        });
    });
</script>
