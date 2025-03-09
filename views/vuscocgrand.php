<?php
require_once('controllers/cprod.php');
include_once(__DIR__ . "/../controllers/ccarr.php");

$mprod = new Mprod();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<?php if ($datOne) {foreach ($datOne as $dta) { ?>
    <div class="container mb-5">
        <div class="row mt-5">
            <!-- Columna de imagen grande -->
            <div class="col-md-6 text-start">
                <h1><strong><img src="img/<?=$dta["fotprod"];?>" alt="" class="product-img"></strong></h1>
            </div>

            <!-- Columna de información del cóctel -->
            <div class="col-md-6">
                <h1><strong><?=$dta['nomprod'];?></strong></h1>
                <h2><strong>Precio: <?=$dta['vlrprod'];?></strong></h2>
                <h2><strong><?=$dta['desprod'];?></strong></h2>

                <!-- Selector para servicio de bartender -->
                <div class="mt-4">
                    <label for="servicioBartender" class="form-label">¿Deseas servicio de bartender?</label>
                    <select id="servicioBartender" class="form-select">
                        <option value="si">Sí</option>
                        <option value="no">No</option>
                    </select>
                    <br>
                    <h4>Seleccione "Sí" si quiere servicio de bartender a domicilio. De lo contrario, si selecciona "No", el cóctel será de un tamaño ya determinado.</h4>
                </div>

                <!-- Botones alineados al texto -->
                <div class="mt-4 d-flex justify-content-start">
                    <button class="btn btn-outline-warning btn-md me-2 add-to-cart"
                        data-idprod="<?= $dta['idprod']; ?>"
                        data-vlrprod="<?= $dta['vlrprod']; ?>"
                        data-idusu="<?= $_SESSION['idusu'] ?>">
                        <i class="fa-solid fa-cart-plus"></i> Agregar al carrito
                    </button>
                    <button class="btn btn-warning btn-md" id="btnComprar">
                        Comprar
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php }} ?>
<style>
    /* Animación de sacudida para el carrito */
@keyframes shake {
    0% { transform: rotate(0deg); }
    25% { transform: rotate(-10deg); }
    50% { transform: rotate(10deg); }
    75% { transform: rotate(-10deg); }
    100% { transform: rotate(0deg); }
}

.cart-animate {
    animation: shake 0.5s ease-in-out;
}

</style>

<script src="js/carrito.js"></script>
