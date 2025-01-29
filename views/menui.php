<?php
$pg = isset($_GET["pg"]) ? $_GET["pg"] : NULL;
?>

<div id="contenedor-barra">
    <div>
        <a id="logo-navegacion" target="_blank">
            <img src="img/coctelapp/logo.png" id="logococtelapp" >
            <div class="barra-busqueda">
                <input type="text" id="input-buscar" placeholder="Buscar...">
                <button type="button" id="boton-buscar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </a>
    </div>
    <button id="boton-toggle" aria-controls="menu-principal" aria-expanded="false">
        <span class="linea"></span>
        <span class="linea"></span>
        <span class="linea"></span>
    </button>
    <div id="menu-principal">
        <ul id="lista-menu">
            <li>
                <a href="index.php?pg=1002" class="enlace-menu <?php echo ($pg == '1002') ? 'activo' : ''; ?>">Iniciar Sesion</a>
            </li>
            <li>
                <a href="index.php?pg=1003" class="enlace-menu <?php echo ($pg == '1003') ? 'activo' : ''; ?>">Planes de Bares</a>
            </li>
        </ul>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.querySelector("#boton-toggle");
        const menu = document.querySelector("#menu-principal");
        const menuLinks = document.querySelectorAll(".enlace-menu");

        // Toggle menu open/close
        toggleButton.addEventListener("click", function() {
            const isExpanded = toggleButton.getAttribute("aria-expanded") === "true";
            toggleButton.setAttribute("aria-expanded", !isExpanded);
            menu.classList.toggle("mostrar");
            toggleButton.classList.toggle("abierto");
        });

        // Animación de entrada y salida al hacer clic en un enlace
        menuLinks.forEach(link => {
            link.addEventListener("click", function(e) {
                e.preventDefault(); // Evita la navegación inmediata

                // Aplicar animación de salida al enlace actual
                const enlaceActivo = document.querySelector(".enlace-menu.activo");
                if (enlaceActivo) {
                    enlaceActivo.classList.remove("activo");
                    enlaceActivo.classList.add("salida");
                }

                // Aplicar animación de entrada al nuevo enlace
                this.classList.add("entrada");

                // Esperar a que termine la animación de salida antes de navegar
                setTimeout(() => {
                    window.location.href = this.href; // Navegar a la nueva página
                }, 300); // 300ms = duración de la animación
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
    const inputBuscar = document.getElementById("input-buscar");
    const botonBuscar = document.getElementById("boton-buscar");

    // Función para realizar la búsqueda
    function realizarBusqueda() {
        const termino = inputBuscar.value.trim();
        if (termino) {
            alert(`Buscando: ${termino}`); // Aquí puedes redirigir o hacer la búsqueda
            // Ejemplo: window.location.href = `buscar.php?q=${termino}`;
        } else {
            alert("Por favor, ingresa un término de búsqueda.");
        }
    }

    // Buscar al presionar Enter
    inputBuscar.addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            realizarBusqueda();
        }
    });

    // Buscar al hacer clic en el botón
    botonBuscar.addEventListener("click", realizarBusqueda);
});
</script>