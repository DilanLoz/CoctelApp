<?php
error_reporting(0);
ini_set('display_errors', 0);

require_once 'models/conexion.php';
require_once 'controllers/cbarxprod.php';

$mbarxprod = new Mbarxprod();
$datAll = $mbarxprod->getAllProdIni(); // Cargar los primeros 12 productos
?>

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
            foreach ($datAll as $dta) {
                $formattedPrice = number_format($dta['vlrprod'], 0, ',', '.');
        ?>
                <div class="product-box">
                    <a href="#" class="mostrar-modal">
                        <img src="img/<?= $dta["fotprod"]; ?>" alt="" class="product-img">
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
        const modal = document.getElementById("modal-sesion");
        const cerrar = document.querySelector(".cerrar-modal");
        const enlaces = document.querySelectorAll(".mostrar-modal");

        enlaces.forEach(enlace => {
            enlace.addEventListener("click", function(event) {
                event.preventDefault();
                modal.style.display = "flex";
            });
        });

        cerrar.addEventListener("click", function() {
            modal.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
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
</style>
 <!-- #region -->