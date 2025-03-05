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

<div class="container mt-4">
    <h4 class="text-center text-primary">Historial de Pedidos</h4>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Marcar</th>
                    <th>ID Pedido</th>
                    <th>Cantidad</th>
                    <th>Fecha Pedido</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Empleado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr id="pedido-<?= $pedido['idpedido'] ?>">
                        <td>
                            <button class="btn btn-outline-dark select-row">
                                <i class="fas fa-check"></i>
                            </button>
                        </td>
                        <td><?= $pedido['idpedido'] ?></td>
                        <td><?= $pedido['cantidad'] ?></td>
                        <td><?= $pedido['fecha_pedido'] ?></td>
                        <td class="fw-bold <?= ($pedido['estado_pedido'] == 'Entregado') ? 'text-success' : 'text-warning' ?>">
                            <?= $pedido['estado'] ?>
                        </td>
                        <td>$<?= number_format($pedido['total'], 2) ?></td>
                        <td><?= $pedido['nomemp'] ?: 'Pendiente' ?></td>
                        <td>
                            <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#pedidoModal<?= $pedido['idpedido'] ?>">
                                Ver Detalles
                            </button>
                        </td>
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
                                    <p><strong>Dirección:</strong> <?= $pedido['direccion'] ?? 'No disponible'; ?></p>
                                    <p><strong>Mensaje:</strong> <?= $pedido['mensaje'] ?? 'No disponible'; ?></p>
                                    <p><strong>Método de Pago:</strong> <?= $pedido['metodo_pago'] ?? 'No especificado'; ?></p>
                                    <p><strong>Estado de Pago:</strong> <?= $pedido['estado_pago'] ?? 'No especificado'; ?></p>
                                    <hr>

                                    <h5 class="text-center">Productos</h5>
                                    <?php
                                        $detalles = $detalleModel->getDetallesPorPedido($pedido['idpedido']);
                                        if (!empty($detalles)): 
                                            $contador = 1; // Inicializa el contador
                                        ?>
                                            <?php foreach ($detalles as $detalle): ?>
                                                <p>
                                                    <strong><?= $contador; ?>.</strong> <?= $detalle['nomprod']; ?> - Cant <?= $detalle['cantidad']; ?> - $<?= number_format($detalle['precio'], 2); ?> - Bar: <?= $detalle['nombar']; ?>
                                                </p>
                                                <?php 
                                                $contador++; // Incrementa el contador en cada iteración
                                                ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p class="text-danger">No hay productos disponibles.</p>
                                        <?php endif; ?>
                                </div>
                               <!-- MODAL DETALLE DE PEDIDO -->
                                <div class="modal-footer">
                                    <?php 
                                    // Obtener la factura asociada al pedido actual
                                    $facturaPedido = null;
                                    foreach ($facturas as $factura) {
                                        if ($factura["idpedido"] == $pedido["idpedido"]) {
                                            $facturaPedido = $factura;
                                            break; // Salir del bucle cuando se encuentra la factura correspondiente
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
    background-color: rgba(0, 0, 0, 0.4) !important; /* Más claro */
}

.selected {
    background-color: rgba(255, 193, 7, 0.5) !important; /* Amarillo con opacidad */
}
</style>

<!-- Script para marcar la fila -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".select-row").forEach(button => {
        button.addEventListener("click", function() {
            let row = this.closest("tr");

            // Alternar la clase "selected"
            row.classList.toggle("selected");
        });
    });
});
</script>
