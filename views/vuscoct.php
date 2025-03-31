<?php
require_once 'models/conexion.php';
require_once 'controllers/cbarxprod.php';

$mbarxprod = new Mbarxprod();
$datAll = $mbarxprod->getAllProd();
?>

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="css/carcomp.css">
<br>
<br>
<h1><i class="fa-solid fa-martini-glass"></i> Cocteles</h1>
<hr>
<br>

<section class="shop container">
    <div class="shop-content">
        <?php
        $productCount = 0;
        if ($datAll) {
            foreach ($datAll as $index => $dta) {
                if ($dta['tipoprod'] == 'coctel') {
                    $formattedPrice = number_format($dta['vlrprod'], 0, ',', '.');
                    $productCount++; // Contamos los productos
                    // Solo los primeros 8 productos serán visibles
                    $visibility = ($productCount <= 8) ? 'block' : 'none';
        ?>
                    <div class="product-box" style="display: <?= $visibility; ?>;">
                        <a href="home.php?pg=1014&idprod=<?= $dta['idprod']; ?>">
                            <img src="img/productos/<?= $dta["fotprod"]; ?>" alt="" class="product-img">
                        </a>
                        <strong class="product-name"><?= $dta['nomprod']; ?></strong>
                        <br>
                        <strong class="product-price" style="font-size: 22px; color: green;">$<?= $formattedPrice; ?></strong>
                        <br>
                        <small style="border-radius: 10px; border: 1px solid black; font-size: 14px; padding-left: 5px; padding-right: 5px;">
                            <?= $dta['nombar']; ?>
                        </small>
                        <a href="home.php?pg=1014&idprod=<?= $dta['idprod']; ?>">
                            <i class='bx bxs-cart add-cart'></i>
                        </a>
                    </div>
        <?php
                }
            }
        }
        ?>
    </div>
    <!-- Botón para cargar más -->
    <div class="text-center mt-4">
        <button id="loadMore" class="btn-load-more">
            Ver más
        </button>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let offset = 8; // Inicialmente se muestran 8 productos
        const products = document.querySelectorAll(".product-box");
        const loadMoreButton = document.getElementById("loadMore");

        loadMoreButton.addEventListener("click", function() {
            let count = 0;
            // Mostrar 4 productos más
            for (let i = offset; i < products.length && count < 4; i++, count++) {
                products[i].style.display = "block"; // Asegura que se muestren los productos ocultos
            }
            offset += 4; // Cargar más 4 productos por clic

            // Si no hay más productos, ocultamos el botón
            if (offset >= products.length) {
                loadMoreButton.style.display = "none";
            }
        });
    });
</script>

<style>
    /* Estilo del botón */
    .btn-load-more {
        background-color: #ffc107;
        color: #000;
        border: none;
        padding: 12px 30px;
        font-size: 18px;
        font-weight: bold;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 10px rgba(255, 193, 7, 0.4);
        outline: none;
    }

    /* Efecto hover */
    .btn-load-more:hover {
        background-color: #ffdd75;
        color: #000000;
        box-shadow: 0 6px 15px rgba(255, 221, 117, 0.6);
    }

    /* Animación al hacer clic */
    .btn-load-more:active {
        transform: scale(0.95);
        box-shadow: 0 2px 5px rgba(255, 193, 7, 0.5);
    }
</style>


