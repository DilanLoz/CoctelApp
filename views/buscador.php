
<a id="logo-navegacion" target="_blank">
<img src="img/coctelapp/logo.png" id="logococtelapp">
<div class="barra-busqueda">
    <input type="search" name="query" id="search-input" placeholder="Buscar productos...">
    <button type="button" id="boton-buscar">
        <i class="fa-solid fa-magnifying-glass"></i>
    </button>
</div>
<div id="search-results"></div>
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
</script>
