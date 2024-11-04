<?php
require_once '../models/conexion.php';
require_once '../models/mbarxprod.php';

$mbarxprod = new Mbarxprod();

// Obtén todos los productos
$datAll = $mbarxprod->getAll(); // Asegúrate de que getAll() retorne datos válidos

// Variables que necesitas definir
$nombreCoctel = "Nombre del cóctel"; // Cambia esto por la variable adecuada
$precio = 10000; // Cambia esto por la variable adecuada
$ciudadVenta = "Ciudad"; // Cambia esto por la variable adecuada
$descripcion = ["Descripción 1", "Descripción 2"]; // Cambia esto por la variable adecuada

?>

<div class="container mb-100">
    <div class="row mt-5">
        <?php if ($datAll) {
            foreach ($datAll as $dta) { ?>
                <div class="col-md-4 text-center">
                    <img src="img/<?= htmlspecialchars($dta['fotprod']); ?>" alt="" class="product-img">
                </div>
                <div class="col-md-8">
                    <h1><b><?= htmlspecialchars($nombreCoctel); ?></b></h1>
                    <div class="mt-4">
                        <label for="opcionesSelect" class="form-label">¿Deseas servicio de bartender?</label>
                        <select id="opcionesSelect" class="form-select">
                            <option value="si">SI</option>
                            <option value="no">NO</option>
                        </select>
                        <br>
                        <h4>Seleccione SI quiere servicio de bartender a domicilio. Por lo contrario, si selecciona NO, el cóctel sería de un tamaño ya determinado.</h4>
                    </div>
                    <div class="border border-warning border-3 rounded-3 mt-5"></div>
                    <div class="row">
                        <div class="col-md-6 mt-4 text-md-start text-center">
                            <h1 class="fw-bold">$<?= number_format($precio, 0, ',', '.'); ?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button class="btn border border-warning border-3 rounded-3 mt-4" id="btnAgregarCarrito">
                                <h3>Agregar al carrito</h3>
                            </button>
                            <button class="btn mt-4 ms-4 border border-warning border-3 rounded-3 bg-warning" id="btnComprar">
                                <h3>Comprar</h3>
                            </button>
                        </div>
                    </div>
                    <div class="mt-5">
                        <h4>Ciudad de venta: <?= htmlspecialchars($ciudadVenta); ?></h4>
                    </div>
                    <div style="margin-top: 50px;">
                        <h3 class="fw-bold">Descripción del producto</h3>
                        <h5><?= implode('</h5><h5>', array_map('htmlspecialchars', $descripcion)); ?></h5>
                    </div>
                </div>
            <?php
            }
        } ?>
    </div>
</div>

<script>
    document.getElementById('btnAgregarCarrito').addEventListener('click', function() {
        // Redirigir a la página de carrito
        window.location.href = 'pagina_carrito.php'; // Cambia esto por la URL de tu página de carrito
    });

    document.getElementById('btnComprar').addEventListener('click', function() {
        // Redirigir a la página de compra
        window.location.href = 'pagina_compra.php'; // Cambia esto por la URL de tu página de compra
    });
</script>
