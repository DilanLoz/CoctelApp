<?php
require_once 'models/mushipe.php';
require_once 'models/mbargan.php';

if (!isset($_SESSION['idusu'])) {
    die('El usuario no está autenticado.');
}

$idusu = $_SESSION['idusu'];
$detalleModel = new Mushipe();
$pedidos = $detalleModel->getPedidoDetalle($idusu);
$facturaModel = new Mbargan(); // Instanciar el modelo si no está ya instanciado
$facturas = $facturaModel->getHistorialPedidos($idusu) ?? []; // Obtener facturas del usuario

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="container mt-5">
    <h2 class="text-center text-warning fw-bold mb-4">Historial de Pedidos</h2>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID Pedido y Fecha</th>
                    <th>Estado</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php usort($pedidos, function ($a, $b) {
                    return $b['idpedido'] <=> $a['idpedido']; // Orden descendente
                });
                ?>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr id="pedido-<?= $pedido['idpedido'] ?>">
                        <td>
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#pedidoModal<?= $pedido['idpedido'] ?>">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <br>
                            <?= $pedido['idpedido'] ?> <br>
                            <?= $pedido['fecha_pedido'] ?>
                        </td>
                        <td>
                            <div class="estado-box border rounded 
                                <?= ($pedido['estado'] == 'En preparacion') ? 'text-danger bg-light-red border-danger' : '' ?>
                                <?= ($pedido['estado'] == 'En camino') ? 'text-primary bg-light-blue border-primary' : '' ?>
                                <?= ($pedido['estado'] == 'Entregado') ? 'text-success bg-light-green border-success' : '' ?>">
                                <?= $pedido['estado'] ?>
                            </div>
                        </td>
                        <td>$<?= number_format($pedido['total'],) ?></td>
                    </tr>

                    <!-- MODAL DETALLE DE PEDIDO -->
                    <div class="modal fade" style="text-align: left;" id="pedidoModal<?= $pedido['idpedido'] ?>" tabindex="-1" aria-labelledby="pedidoModalLabel<?= $pedido['idpedido'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-success-subtle text-dark">
                                    <h5 class="modal-title">Detalles del Pedido #<?= $pedido['idpedido'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="text-center">Detalles del Pedido</h5>

                                    <!-- Empleado asignado -->
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="img/empleados/<?= htmlspecialchars($pedido['fotiden'] ?: 'default.jpg'); ?>"
                                            class="rounded-circle me-3"
                                            style="width: 50px; height: 50px; object-fit: cover;"
                                            alt="Foto del Empleado">
                                        <div>
                                            <p class="mb-0"><strong>Empleado asignado:</strong> <?= $pedido['nomemp'] ?: 'Pendiente' ?></p>
                                            <p class="mb-0"><strong>Teléfono:</strong> <?= $pedido['celemp'] ?: 'No disponible' ?></p>
                                        </div>
                                    </div>

                                    <p><strong>Dirección:</strong> <?= $pedido['direccion'] ?? 'No disponible'; ?></p>
                                    <p><strong>Mensaje:</strong> <?= $pedido['mensaje'] ?? 'No disponible'; ?></p>
                                    <p><strong>Método de Pago:</strong> <?= $pedido['metodo_pago'] ?? 'No especificado'; ?></p>
                                    <p><strong>Servicio de Bartender:</strong> <?= $pedido['servicio'] ?? 'No especificado'; ?></p>

                                    <hr>
                                    <h5 class="text-center">Productos</h5>

                                    <?php
                                    $detalles = $detalleModel->getDetallesPorPedido($pedido['idpedido']);
                                    if (!empty($detalles)):
                                        $contador = 1;
                                    ?>
                                        <?php foreach ($detalles as $detalle): ?>
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="img/productos/<?= htmlspecialchars($detalle['fotprod'] ?: 'default.jpg'); ?>"
                                                    class="rounded me-3"
                                                    style="width: 90px; height: 90px; object-fit: cover;"
                                                    alt="Imagen del Producto">
                                                <div>
                                                    <p class="mb-0"><strong><?= $contador; ?>.</strong> <?= $detalle['nomprod']; ?></p>
                                                    <p class="mb-0"><strong>Cantidad:</strong> <?= $detalle['cantidad']; ?></p>
                                                    <p class="mb-0"><strong>Precio:</strong> $<?= number_format($detalle['precio'], 2); ?></p>
                                                    <p class="mb-0"><strong>Bar:</strong> <?= $detalle['nombar']; ?>, <strong>Tel:</strong> <?= $detalle['telbar']; ?></p>
                                                </div>
                                            </div>
                                            <?php $contador++; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-danger">No hay productos disponibles.</p>
                                    <?php endif; ?>

                                </div>
                                <div class="modal-footer">
                                    <?php
                                    $facturaPedido = null;
                                    foreach ($facturas as $factura) {
                                        if ($factura["idpedido"] == $pedido["idpedido"]) {
                                            $facturaPedido = $factura;
                                            break;
                                        }
                                    }

                                    if ($facturaPedido): ?>
                                        <a href='PDF/Usuario/HisFacturaUsu.php?idfact=<?= $facturaPedido["idfact"] ?>'
                                            class='btn btn-outline-danger btn-sm'
                                            target='_blank'
                                            rel='noopener noreferrer'>
                                            Factura <i class='fas fa-file-pdf'></i>
                                        </a>
                                    <?php endif; ?>

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FIN MODAL -->
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Estilos CSS para destacar la fila seleccionada -->
<style>
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.4) !important;
        /* Más claro */
    }

    .selected {
        background-color: rgba(255, 193, 7, 0.5) !important;
        /* Amarillo con opacidad */
    }

    .estado-box {
        padding: 5px;
        border-radius: 5px;
        display: inline-block;
        font-weight: bold;
        min-width: 120px;
        text-align: center;
    }

    /* Colores de fondo más claros */
    .bg-light-red {
        background-color: #f8d7da;
    }

    /* Rojo claro */
    .bg-light-blue {
        background-color: #cce5ff;
    }

    /* Azul claro */
    .bg-light-green {
        background-color: #d4edda;
    }

    /* Verde claro */
</style>

<!-- Script para marcar la fila -->
<script>
    document.querySelectorAll(".select-row").forEach(button => {
        button.addEventListener("click", function() {
            let row = this.closest("tr");
            row.classList.toggle("selected");
        });
    });
</script>