<?php
error_reporting(0);
ini_set('display_errors', 0);
require_once 'models/conexion.php';
require_once 'controllers/cbarxprod.php';

$mbarxprod = new Mbarxprod();
$datAll = $mbarxprod->getAllProdIni(100, 0); // Cargar todos los productos
?>
<!-- FontAwesome CDN -->

<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<link rel="stylesheet" href="css/carcomp.css">
<br>
<br>
<h1 class="text-center"> Productos</h1>
<hr>
<br>

<section class="shop container">
    <div class="shop-content" id="product-container">
        <?php if ($datAll) {
            foreach ($datAll as $index => $dta) {
                $formattedPrice = number_format($dta['vlrprod'], 0, ',', '.');
        ?>
                <div class="product-box" style="display: <?= $index < 8 ? 'block' : 'none'; ?>;">
                    <a href="#" class="mostrar-modal">
                        <img src="img/productos/<?= $dta["fotprod"]; ?>" alt="" class="product-img">
                    </a>
                    <strong class="product-name"><?= $dta['nomprod']; ?></strong>
                    <br>
                    <strong class="product-price" style="font-size: 22px; color: green;">$<?= $formattedPrice; ?></strong>
                    <br>
                    <small style="border-radius: 10px; border: 1px solid black; font-size: 14px; padding-left: 5px; padding-right: 5px;">
                        <?= $dta['nombar']; ?>
                    </small>
                    <a href="#" class="mostrar-modal">
                        <i class="bx bxs-cart add-cart"></i>
                    </a>
                </div>
        <?php
            }
        } ?>
    </div>
    <!-- Botón para cargar más -->
    <div class="text-center mt-4">
        <button id="loadMore" class="btn-load-more">
            Ver más 
        </button>
    </div>
</section>

<!-- MODAL -->
<div id="modal-sesion" class="modal">
    <div class="modal-contenido">
        <span class="cerrar-modal">&times;</span>
        <h2>¡Atención!</h2>
        <p>Tienes que iniciar sesión para ver los detalles del producto y agregarlo en carrito de compras.</p>
        <a href="index.php?pg=1002" class="btn-modal">Iniciar Sesión</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    let offset = 4; // Inicialmente se muestran 8 productos
    const products = document.querySelectorAll(".product-box");
    const loadMoreButton = document.getElementById("loadMore");
    const modal = document.getElementById("modal-sesion");
    const closeModal = document.querySelector(".cerrar-modal");
    const showModalButtons = document.querySelectorAll(".mostrar-modal");

    // Mostrar productos adicionales al hacer clic en "Ver más"
    loadMoreButton.addEventListener("click", function() {
        let count = 0;
        for (let i = offset; i < products.length && count < 4; i++, count++) {
            products[i].style.display = "block"; // Asegura que se muestren los productos ocultos
        }
        offset += 4;
        if (offset >= products.length) {
            loadMoreButton.style.display = "none"; // Oculta el botón si no hay más productos
        }
    });

    // Mostrar la modal al hacer clic en los botones de mostrar modal
    showModalButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault(); // Evita que el enlace navegue
            modal.style.display = "flex"; // Muestra la modal
        });
    });

    // Cerrar la modal al hacer clic en la "X"
    closeModal.addEventListener("click", function() {
        modal.style.display = "none"; // Oculta la modal
    });

    // Cerrar la modal si se hace clic fuera de ella
    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none"; // Oculta la modal
        }
    });
});

</script>

<style>
    /* Estilos del modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-contenido {
        background: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        max-width: 400px;
        width: 90%;
    }

    .cerrar-modal {
        float: right;
        font-size: 24px;
        cursor: pointer;
    }

    .btn-modal {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 20px;
        background: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    /* Estilo del botón */
    .btn-load-more {
        background-color: #ffc107;
        /* Color warning */
        color: #000;
        border: none;
        padding: 12px 30px;
        font-size: 18px;
        font-weight: bold;
        border-radius: 50px;
        /* Bordes completamente redondeados */
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 10px rgba(255, 193, 7, 0.4);
        outline: none;
    }

    /* Efecto hover */
    .btn-load-more:hover {
        background-color: #ffdd75;
        /* Amarillo pastel */
        color: #000000;
        /* Texto oscuro para contraste */
        box-shadow: 0 6px 15px rgba(255, 221, 117, 0.6);
    }

    /* Animación al hacer clic */
    .btn-load-more:active {
        transform: scale(0.95);
        box-shadow: 0 2px 5px rgba(255, 193, 7, 0.5);
    }
</style>