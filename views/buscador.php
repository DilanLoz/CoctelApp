<?php
$idper = isset($_SESSION['idper']) ? $_SESSION['idper'] : null;
?>

<div class="contenedor-nav">
    <!-- Logo con enlace -->
    <a id="logo-navegacion" href="<?php echo ($idper == 10) ? 'home.php?pg=1015' : (($idper == 20) ? 'home.php?pg=2001' : (($idper == 30) ? 'home.php?pg=3001' : '#')); ?>">
        <img src="img/coctelapp/logo.png" id="logococtelapp">
    </a>

    <!-- Imágenes adicionales (fuera del <a> pero alineadas) -->
    <?php if ($idper == 20 || $idper == 30) : ?>
        <img src="img/coctelapp/CoctelApp1.png" class="img-adicional">
    <?php endif; ?>

    <!-- Barra de búsqueda solo si idper es 10 -->
    <?php if ($idper == 10): ?>
        <div class="barra-busqueda">
            <input type="search" name="query" id="search-input" placeholder="Buscar...">
            <button type="button" id="boton-buscar">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <div id="search-results"></div>
    <?php endif; ?>
</div>
<style>
.contenedor-nav {
    display: flex;
    align-items: center; /* Alinea verticalmente */
    gap: 10px; /* Espacio entre elementos */
}
</style>

<script>
function setupSearch() {
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const query = this.value.trim();
            
            if (query.length > 2) {
                fetch('controllers/cbuscador.php?query=' + encodeURIComponent(query))
                    .then(response => response.text())
                    .then(data => {
                        console.log('Respuesta del servidor:', data); // DEBUG

                        if (searchResults) {
                            searchResults.innerHTML = data;
                            searchResults.style.display = "block"; // Asegurar que sea visible
                        }
                    })
                    .catch(error => console.error('Error al buscar:', error));
            } else {
                searchResults.innerHTML = '';
                searchResults.style.display = "none"; // Ocultar si la búsqueda es vacía
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', setupSearch);
document.addEventListener('DOMContentLoaded', function () {
        var idper = <?php echo json_encode($idper); ?>;
        if (idper !== 10) {
            var searchBar = document.querySelector('.barra-busqueda');
            if (searchBar) {
                searchBar.style.display = 'none';
            }
        }
    });
</script>
