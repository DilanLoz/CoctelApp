<?php include_once(__DIR__ . "/../controllers/ccarr.php");
include_once(__DIR__ . "/../controllers/ccar_sum_rest.php");
include_once(__DIR__ . "/../controllers/ccarped.php"); ?>
<div class="container mt-5 col-12 col-md-8" id="detpedpq" style="text-align: left">
    <div class="mt-4">
        <h1 class="text-warning fw-bold" style="font-size: 30px">
            <i class="fa-solid fa-cart-shopping"></i> Carrito
        </h1>

        <div class="rounded-3 border border-secondary p-4">
            <?php if (!empty($dtCarrito)) { ?>
                <?php foreach ($dtCarrito as $producto) { ?>
                    <div class="row product-item pt-3 ps-3 pe-3 mt-3  rounded-3 m-4">
                        <div class="col-3 col-sm-2 d-flex justify-content-center">
                            <a href="home.php?pg=1014&idprod=<?= $producto['idprod']; ?>">
                                <img src="<?php echo 'img/' . htmlspecialchars($producto['fotprod']); ?>"
                                    class="prodcar" draggable="false"
                                    style="width: 50px; height: 70px;">
                            </a>
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
                <div class="text-center p-5">
                    <h3 class="mt-3 fw-bold fs-4 fs-md-3 fs-lg-2">🛒 Tu carrito está vacío</h3>
                    <img src="./img/coctelapp/svg/Ecommerce_campaign.gif" alt="Carrito vacío" class="img-fluid w-50 w-md-50 w-lg-25">
                    <p class="mt-3 text-muted">¡No te quedes sin tus productos favoritos! Explora nuestro catálogo y encuentra lo que necesitas.</p>
                    <a href="productos.php" class="btn btn-warning mt-3">🛍️ Explorar Productos</a>
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
                        <input class="form-control" type="text" name="direccion" value="<?php echo isset($datOne[0]['direccion']) ? $datOne[0]['direccion'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input class="form-control" type="number" name="telefono" value="<?php echo isset($datOne[0]['telefono']) ? $datOne[0]['telefono'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="referencia" class="form-label">Mensaje de recomendaciones</label>
                        <input class="form-control" type="text" name="mensaje" value="<?php echo isset($datOne[0]['mensaje']) ? $datOne[0]['mensaje'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="metodo_pago" class="form-label">Método de Pago</label>
                        <select class="form-select" name="metodo_pago" required>
                            <?php
                            // Conectar a la base de datos
                            require_once __DIR__ . '/../models/conexion.php';
                            $conexion = (new Conexion())->get_conexion();

                            // Consulta para obtener los valores del ENUM
                            $sql = "SHOW COLUMNS FROM carrito LIKE 'metodo_pago'";
                            $stmt = $conexion->prepare($sql);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($row) {
                                // Extraer los valores del ENUM
                                $enum_values = str_replace(["enum(", ")", "'"], "", $row['Type']);
                                $opciones = explode(",", $enum_values);

                                // Generar las opciones del select
                                foreach ($opciones as $opcion) {
                                    echo '<option value="' . htmlspecialchars($opcion) . '">' . htmlspecialchars($opcion) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary" id="confirmarPedido">
                        Confirmar Pedido
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Carga -->
<div class="modal fade" id="pedidoConfirmadoModal" tabindex="-1" aria-labelledby="pedidoConfirmadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <div class="modal-body">
                <div class="spinner-border text-success" role="status" style="width: 3rem; height: 3rem;"></div>
                <h5 class="mt-3">Pedido Confirmado</h5>
            </div>
        </div>
    </div>
</div>

<style>
    /* Fondo gris claro para toda la página */
    body {
        background-color: #f8f9fa;
        /* Un gris claro */
    }

    /* Estilo para los productos */
    .product-item {
        background-color: white;
        /* Fondo blanco para cada producto */
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        /* Sombra sutil */
        border-radius: 8px;
        /* Bordes redondeados */
        padding: 15px;
        /* Espaciado interno */
        margin: 10px 0;
        /* Espaciado entre productos */
        transition: transform 0.4s ease-in-out, box-shadow 0.4s ease-in-out, border 0.4s ease-in-out;
    }

    .product-item:hover {
        transform: scale(1.02);
        box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.15);
    }

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