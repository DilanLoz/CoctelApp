<?php include_once(__DIR__ . "/../controllers/ccarr.php"); ?>
<div class="container mt-5 col-12 col-md-8" id="detpedpq" style="text-align: left">
    <div class="mt-4">
        <h1 class="text-warning fw-bold" style="font-size: 30px">
            <i class="fa-solid fa-cart-shopping"></i> Carrito
        </h1>
        <?php foreach ($dtCarrito as $producto) { ?>
        <div class="row">
            <div class="rounded-3 me-4 mb-5 text-black" style="background-color: #fff;">
                <!-- Producto 1 -->
                <div class="rounded-3 border border-secondary mb-3">
                    <div class="row product-item pt-3 ps-3 pe-3 mt-3 bg-body-tertiary rounded-3 m-4">
                        <!-- Imagen del producto -->
                        <div class="col-3 col-sm-2 d-flex justify-content-center">
                        <img src="<?php echo 'img/' . htmlspecialchars($producto['fotprod']); ?>" class="prodcar" draggable="false" style="width: 50px; height: 70px;">
                        </div>
                        

                        <!-- Información del producto -->
                        <div class="col-6 col-sm-6">
                            <ul style="list-style-type: none; padding-left: 0;">
                                <li><b><?php echo htmlspecialchars($producto['nomprod']); ?></b></li>
                                <li><b style="font-size: 13px;"><?php echo htmlspecialchars($producto['nombar']); ?></b></li>
                                <li><b class="text-warning"><?php echo "$" . number_format($producto['vlrprod'], 2); ?></b></li>
                            </ul>
                        </div>

                        <!-- Contenedor del contador y botón de eliminar -->
                        <div class="col-3 d-flex justify-content-between align-items-center mb-3">
                            <!-- Contador -->
                            <div class="counter d-flex align-items-center">
                                <button class="btn btn-outline-success btn-sm increment">
                                    <i class="fa-solid fa-plus"></i>
                                </button>

                                <input type="text" class="text-center mx-1 form-control quantity" value="<?= $producto['cantidad'] ?>" readonly>

                                <button class="btn btn-outline-danger btn-sm decrement">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </div>

                            <!-- Botón de eliminar -->
                            <button class="trash mb-2">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>

                </div>
                <?php } ?>
                <!-- Cálculos y pagos -->
                <?php if (!empty($dtCarrito)) { ?>
                    <div class="col bx-seg-dt bx-seg-env-minf_det-com bx-res-com-cr rounded-3 border border-secondary p-4">
                        <div>
                            <h4>Resumen de Compra</h4>
                        </div>
                        <div class="bx-seg-dt_fech">
                            <?php
                            $total = 0;
                            foreach ($dtValoresCarrito as $dts) { ?>
                                <div class="row">
                                    <div class="col">
                                        <p>Producto:</p>
                                        <p>Envío:</p>
                                    </div>
                                    <div class="col">
                                        <p>$<?= number_format($dts['valor_productos'], 2, ",", ".") ?></p>
                                        <p class="vl-green">Gratis</p>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <?php if (!empty($dtTotCarrito) && is_array($dtTotCarrito)) { ?>
                                    <div class="col">
                                        <p>Total:</p>
                                    </div>
                                    <div class="col">
                                        <p class="tot-carr">$<?= number_format($dtTotCarrito['total_productos'], 2, ",", ".") ?></p>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                        <div class="footer">
                            <form id="formPago" action="controller/resPago.php" method="POST">
                                <input type="hidden" name="productos" id="productos">
                                <button type="submit" class="btn btn-warning col-12 col-md-2">Ir a Pagar</button>
                            </form>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', function() {
            let input = this.nextElementSibling;
            let valor = parseInt(input.value, 10);
            if (valor < 10) {
                input.value = valor + 1;
            }
        });
    });

    document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', function() {
            let input = this.previousElementSibling;
            let valor = parseInt(input.value, 10);
            if (valor > 1) {
                input.value = valor - 1;
            }
        });
    });
</script>

<style>
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
</body>
</html>
