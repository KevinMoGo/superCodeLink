<!-- Aquí crearemos nuestro menú lateral con diferentes opciones -->
<style>
    .menu {
        width: 250px;
        height: 100%;
        background-color: #333;
        position: fixed;
        top: 12vh;
        transition: right 0.3s ease; /* Transición suave */
        /* Quiero que el menu este totalmente a la derecha, fuera del campo visible */
        right: -250px;
        padding-top: 20px;
    }

    .menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .menu ul li {
        padding: 15px;
        border-bottom: 1px solid #444;
    }

    .menu ul li a {
        color: white;
        text-decoration: none;
    }

    .menu ul li a:hover {
        color: #f1f1f1;
    }
</style>
<div class="menu">
    <ul>
        <li><a href="{{ route('inicio') }}">Inicio</a></li>
        <li><a href="#">Opciones</a></li>
        <li>
            <!-- Botón deslizable para el modo noche -->
            <label class="switch">
                <input type="checkbox" id="modoNocheToggle">
                <span class="slider"></span>
            </label>
        </li>
    </ul>
</div>
