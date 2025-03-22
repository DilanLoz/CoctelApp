<?php
$idper = isset($_SESSION['idper']) ? $_SESSION['idper'] : null;
?>

<a id="logo-navegacion" target="_blank">
    <img src="img/coctelapp/logo.png" id="logococtelapp">
    <?php if ($idper == 20 || $idper == 30) : ?>
        <img src="img/coctelapp/CoctelApp1.png" style="width: 100px; height: auto;">
    <?php endif; ?>

    <!-- Mostrar barra de búsqueda solo si idper es 10 -->
    <?php if ($idper == 10): ?>
        <div class="barra-busqueda">
            <input type="search" name="query" id="search-input" placeholder="Buscar productos...">
            <button type="button" id="boton-buscar">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <div id="search-results"></div>
    <?php endif; ?>
</a>

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
