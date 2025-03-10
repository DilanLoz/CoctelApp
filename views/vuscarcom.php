<?php include_once(__DIR__ . "/../controllers/ccarr.php");
include_once(__DIR__ . "/../controllers/ccar_sum_rest.php"); 
include_once(__DIR__ . "/../controllers/ccarped.php"); ?>
<div class="container mt-5 col-12 col-md-8" id="detpedpq" style="text-align: left">
    <div class="mt-4">
        <h1 class="text-warning fw-bold" style="font-size: 30px">
            <i class="fa-solid fa-cart-shopping"></i> Carrito
        </h1>

        <div class="rounded-3 border border-secondary p-4" style="background-color: #fff;">
            <?php if (!empty($dtCarrito)) { ?>
                <?php foreach ($dtCarrito as $producto) { ?>
                    <div class="row product-item pt-3 ps-3 pe-3 mt-3 bg-body-tertiary rounded-3 m-4">
                        <div class="col-3 col-sm-2 d-flex justify-content-center">
                            <img src="<?php echo 'img/' . htmlspecialchars($producto['fotprod']); ?>" class="prodcar" draggable="false" style="width: 50px; height: 70px;">
                        </div>
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
                        <div class="col-3 d-flex justify-content-between align-items-center mb-3">
                            <div class="counter d-flex align-items-center">
                                <button class="btn btn-outline-success btn-sm increment" data-idprod="<?= $producto['idprod'] ?>" data-idusu="<?= $_SESSION['idusu'] ?>">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                                <input type="text" class="text-center mx-1 form-control quantity" value="<?= $producto['cantidad'] ?>" readonly>
                                <button class="btn btn-outline-danger btn-sm decrement" data-idprod="<?= $producto['idprod'] ?>" data-idusu="<?= $_SESSION['idusu'] ?>">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </div>
                            <button class="trash mb-2" data-idprod="<?= $producto['idprod'] ?>" data-idusu="<?= $_SESSION['idusu'] ?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <!-- 🔴 Mensaje cuando el carrito está vacío -->
                <div class="text-center">
                    <h3 class="mt-3 fw-bold fs-4 fs-md-3 fs-lg-2">No tienes productos en tu carrito.</h3>
                    <img src="./img/coctelapp/svg/Ecommerce_campaign.gif" alt="Sin pedidos" class="img-fluid w-50 w-md-50 w-lg-25">
                </div>
            <?php } ?>
        </div>

        <?php if (!empty($dtCarrito)) { ?>
            <div class="col bx-seg-dt bx-seg-env-minf_det-com bx-res-com-cr rounded-3 border border-secondary p-4 mt-4">
                <div>
                    <h4>Resumen de Compra</h4>
                </div>
                <div class="bx-seg-dt_fech">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-4">
                            <p>Total de productos:</p>
                            <p>Envío:</p>
                            <p>Total General:</p>
                        </div>
                        <div class="col-12 col-md-4 text-md-end">
                            <?php foreach ($dtValoresCarrito as $dts) { ?>
                                <p>$<?= number_format($dts['valor_productos'], 2, ",", ".") ?></p>
                                <p class="vl-green">Gratis</p>
                            <?php } ?>
                            <?php if (!empty($dtTotCarrito) && is_array($dtTotCarrito)) { ?>
                                <p class="tot-carr">$<?= number_format($dtTotCarrito['total_productos'], 2, ",", ".") ?></p>
                            <?php } ?>
                        </div>
                        <div class="col-12 col-md-4 text-md-end order-md-last mt-3 mt-md-0 subir-boton">
                                <input type="hidden" name="productos" id="productos">
                                <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#finalizarModal">Ir a Pagar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- Modal para finalizar pedido -->
<div class="modal fade" id="finalizarModal" tabindex="-1" aria-labelledby="finalizarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="finalizarModalLabel">Finalizar Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="finalizarPedidoForm">
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input class="form-control" type="text" name="direccion" value="<?= isset($usuario['direccion']) ? htmlspecialchars($usuario['direccion']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input class="form-control" type="text" name="telefono" value="<?= isset($usuario['telefono']) ? htmlspecialchars($usuario['telefono']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="referencia" class="form-label">Referencia</label>
                        <input class="form-control" type="text" name="mensaje" value="<?= isset($usuario['mensaje']) ? htmlspecialchars($usuario['mensaje']) : '' ?>" required>
                    </div>
                    <button type="button" class="btn btn-primary" id="confirmarPedido" 
                        data-idcarrito="<?php echo htmlspecialchars($carrito['idcarrito']); ?>" 
                        data-idusuario="<?php echo htmlspecialchars($usuario['idusuario']); ?>">
                        Confirmar Pedido
                    </button>
                </form>
            </div>
        </div>
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
<script src="js/carped.js"></script>
<script>
    function mostrarNombreCompleto(elemento) {
        elemento.parentElement.innerHTML = elemento.dataset.nombre + " | " + elemento.parentElement.innerHTML.split("|")[1];
    }
</script>