<?php include_once(__DIR__ . "/../controllers/ccarr.php");
include_once(__DIR__ . "/../controllers/ccar_sum_rest.php"); ?>
<div class="container mt-5 col-12 col-md-8" id="detpedpq" style="text-align: left">
    <div class="mt-4">
        <h1 class="text-warning fw-bold" style="font-size: 30px">
            <i class="fa-solid fa-cart-shopping"></i> Carrito
        </h1>

        <!-- 🖤 Contenedor general con borde negro secundario -->
        <div class="rounded-3 border border-secondary p-4" style="background-color: #fff;">
            <?php foreach ($dtCarrito as $producto) { ?>
                <div class="row product-item pt-3 ps-3 pe-3 mt-3 bg-body-tertiary rounded-3 m-4">
                    <!-- Imagen del producto -->
                    <div class="col-3 col-sm-2 d-flex justify-content-center">
                        <img src="<?php echo 'img/' . htmlspecialchars($producto['fotprod']); ?>" class="prodcar" draggable="false" style="width: 50px; height: 70px;">
                    </div>
                    <!-- Información del producto -->
                    <div class="col-6 col-sm-6">
                        <ul style="list-style-type: none; padding-left: 0;">
                            <li>
                                <b>
                                    <?php
                                    $nombreCompleto = htmlspecialchars($producto['nomprod']);
                                    $nombreCorto = strlen($producto['nomprod']) > 35
                                        ? substr($producto['nomprod'], 0, 35) . "<span class='ver-mas' onclick='mostrarNombreCompleto(this)' data-nombre='" . $nombreCompleto . "'>...</span>"
                                        : $nombreCompleto;
                                    ?>
                                    <span><?= $nombreCorto . " | " . htmlspecialchars($producto['mililitros']) . "ml" ?></span>
                                </b>
                            </li>

                            <li><b style="font-size: 13px;"><?php echo htmlspecialchars($producto['nombar']); ?></b></li>
                            <li><b class="text-warning"><?php echo "$" . number_format($producto['vlrprod'], 2); ?></b></li>
                        </ul>
                    </div>
                    <!-- Contenedor del contador y botón de eliminar -->
                    <div class="col-3 d-flex justify-content-between align-items-center mb-3">
                        <!-- Contador -->
                        <div class="counter d-flex align-items-center">
                            <button class="btn btn-outline-success btn-sm increment" data-idprod="<?= $producto['idprod'] ?>" data-idusu="<?= $_SESSION['idusu'] ?>">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <input type="text" class="text-center mx-1 form-control quantity" value="<?= $producto['cantidad'] ?>" readonly>
                            <button class="btn btn-outline-danger btn-sm decrement" data-idprod="<?= $producto['idprod'] ?>" data-idusu="<?= $_SESSION['idusu'] ?>">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                        </div>
                        <!-- Botón de eliminar -->
                        <button class="trash mb-2" data-idprod="<?= $producto['idprod'] ?>" data-idusu="<?= $_SESSION['idusu'] ?>">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div> <!-- 🔚 Cierre del contenedor con borde negro secundario -->

        <!-- Cálculos y pagos -->
        <?php if (!empty($dtCarrito)) { ?>
            <div class="col bx-seg-dt bx-seg-env-minf_det-com bx-res-com-cr rounded-3 border border-secondary p-4 mt-4">
                <div>
                    <h4>Resumen de Compra</h4>
                </div>
                <div class="bx-seg-dt_fech">
                    <div class="row align-items-center">
                        <!-- 🟢 Columna 1: Etiquetas -->
                        <div class="col-12 col-md-4">
                            <p>Total de productos:</p>
                            <p>Envío:</p>
                            <p>Total General:</p>
                        </div>
                        <!-- 🔵 Columna 2: Valores -->
                        <div class="col-12 col-md-4 text-md-end">
                            <?php foreach ($dtValoresCarrito as $dts) { ?>
                                <p>$<?= number_format($dts['valor_productos'], 2, ",", ".") ?></p>
                                <p class="vl-green">Gratis</p>
                            <?php } ?>
                            <?php if (!empty($dtTotCarrito) && is_array($dtTotCarrito)) { ?>
                                <p class="tot-carr">$<?= number_format($dtTotCarrito['total_productos'], 2, ",", ".") ?></p>
                            <?php } ?>
                        </div>
                        <!-- 🟠 Columna 3: Botón "Ir a Pagar" (se mueve debajo en móviles) -->
                        <div class="col-12 col-md-4 text-md-end order-md-last mt-3 mt-md-0 subir-boton">
                            <form id="formPago" action="controller/resPago.php" method="POST">
                                <input type="hidden" name="productos" id="productos">
                                <button type="submit" class="btn btn-warning w-100">Ir a Pagar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<style>
    .subir-boton {
        position: relative;
        top: -10px;
        /* Ajusta el valor según necesites */
    }

    /* 🔹 Contenedor del contador y botón de eliminar */
    .counter {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* 🔹 Botón de eliminar */
    .trash {
        background-color: transparent;
        border: none;
        color: red;
        font-size: 18px;
        cursor: pointer;
    }

    /* 🔹 Input del contador */
    .counter input {
        width: 45px;
        font-size: 14px;
        text-align: center;
        padding: 5px;
        margin: 0 5px;
    }

    /* 🔹 Solo para móviles (menos de 768px) */
    @media (max-width: 768px) {
        .counter {
            flex-direction: column;
        }

        .subir-boton {
            position: relative;
            top: -5px;
            /* Ajusta el valor según necesites */
        }

        .counter {
            flex-direction: column;
        }

        .counter input {
            width: 35px;
            font-size: 12px;
        }

        .counter button {
            width: 30px;
            height: 30px;
            font-size: 12px;
            padding: 3px;
        }

        /* 🔹 Ajusta el contenedor en móviles */
        .col-3.d-flex {
            flex-direction: column-reverse;
            align-items: center;
            justify-content: center;
        }

        /* 🔹 El botón de eliminar se mantiene alineado a la derecha */
        .trash {
            margin-top: 5px;
        }
    }
</style>
<script src="js/carrito.js"></script>
<script src="js/carrito_sum_rest.js"></script>
<script>
    function mostrarNombreCompleto(elemento) {
        elemento.parentElement.innerHTML = elemento.dataset.nombre + " | " + elemento.parentElement.innerHTML.split("|")[1];
    }
</script>