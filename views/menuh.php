<?php include "controllers/cmenu.php"; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="css/menu.css">
<?php
$pg = isset($_GET["pg"]) ? $_GET["pg"] : NULL;
?>

<div id="contenedor-barra">
    <div>
        <a id="logo-navegacion" target="_blank">
            <img src="img/coctelapp/logo.png" id="logococtelapp">
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
            <?php if ($dat) {
                foreach ($dat as $dt) { ?>
                    <li>
                        <a href="home.php?pg=<?= $dt['idpag']; ?>" title="<?= $dt['titupag']; ?>" class="enlace-menu <?php echo ($pg == $dt['idpag']) ? 'activo' : ''; ?>">
                            <i class="<?= $dt['icopag']; ?>"></i> <?= $dt['nompag']; ?>
                        </a>
                    </li>
            <?php
                }
            }
            ?>
            <li class="lista-menu">
                <a class="enlace-menu" href="views/vsal.php" title="Salir">
                    <i class="fa-solid fa-right-from-bracket" style="color: red;"></i>
                </a>
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

    document.addEventListener("DOMContentLoaded", function() {
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
        inputBuscar.addEventListener("keydown", function(e) {
            if (e.key === "Enter") {
                realizarBusqueda();
            }
        });

        // Buscar al hacer clic en el botón
        botonBuscar.addEventListener("click", realizarBusqueda);
    });
</script>