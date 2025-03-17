<?php
require_once 'controllers/cbarped.php';

$detalleController = new Cdetpedido();
$pedidos = $detalleController->listarPedidosBar();

// Agrupar productos por ID de pedido
$pedidosAgrupados = [];
foreach ($pedidos as $producto) {
    $idpedido = $producto['idpedido'];
    if (!isset($pedidosAgrupados[$idpedido])) {
        $pedidosAgrupados[$idpedido] = [
            'direccion' => $producto['direccion'],
            'nomemp' => $producto['nomemp'],
            'fecha_pedido' => $producto['fecha_pedido'],
            'servicio' => $producto['servicio'], // Se agrega el campo servicio
            'productos' => []
        ];
    }
    $pedidosAgrupados[$idpedido]['productos'][] = $producto;
}

?>

<div class="container mt-4">
    <div class="row">
        <!-- Columna izquierda: Pedidos sin empleado -->
        <div class="col-md-6 mt-5">
            <div class="border-start border-end border-top border-primary rounded-top p-3 mb-3">
                <h3 class="text-center text-primary fw-bold"><i class="fa-solid fa-person-walking-arrow-loop-left"></i> Pedidos Sin Empleado</h3>
            </div>
            <?php foreach ($pedidosAgrupados as $idpedido => $pedido): ?>
                <?php if ($pedido['productos'][0]['estado_pedido'] == 1): ?>
                    <div class="p-4 mb-4 shadow-lg bg-white rounded">
                        <!-- Contenedor flexible: ID + Total a la izquierda | Info del pedido a la derecha -->
                        <div class="d-flex align-items-center">
                            <!-- ID del pedido y Total -->
                            <div class="me-4 text-center">
                                <h4 class="fw-bold bg-warning text-dark px-3 py-2 rounded">Pedido No. <?php echo $idpedido; ?></h4>
                                <div class="text-success fw-bold fs-5 mt-2">
                                    Total: $<?php echo number_format($pedido['productos'][0]['total_pedido'], 2); ?>
                                    <hr class="mt-1 mb-0 border-2 border-success w-50 mx-auto">
                                </div>
                            </div>

                            <!-- Información del pedido -->
                            <div class="text-end flex-grow-1">
                                <p class="mb-1"><strong>Fecha:</strong> <?php echo $pedido['fecha_pedido']; ?></p>
                                <p class="mb-1"><strong>Empleado:</strong> <?php echo $pedido['nomemp'] ?: 'Pendiente'; ?></p>
                                <p class="mb-1"><strong>Usuario:</strong> <?php echo $pedido['productos'][0]['nomusu']; ?></p>
                                <p class="mb-0"><strong>Dirección:</strong> <?php echo htmlspecialchars($pedido['direccion']); ?></p>
                                <p class="mb-0 text-primary"><strong>Servicio Bartender: <?php echo htmlspecialchars($pedido['servicio']); ?></strong></p>
                            </div>
                        </div>

                        <!-- Lista de productos -->
                        <ul class="list-group mt-3">
                            <?php foreach ($pedido['productos'] as $producto): ?>
                                <li class="list-group-item d-flex align-items-center">
                                    <img src="img/<?php echo htmlspecialchars($producto['fotprod'] ?: 'default.jpg'); ?>"
                                        alt="Imagen de <?php echo htmlspecialchars($producto['nombre_producto']); ?>"
                                        class="me-3"
                                        style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;">
                                    <div class="text-center flex-grow-1">
                                        <strong class="d-block"><?php echo $producto['nombre_producto']; ?></strong>
                                        <span class="text-muted">Cantidad: <?php echo $producto['cantidad']; ?> | <?php echo $producto['mililitros']; ?> ml</span>
                                        <span class="d-block text-success fw-bold">Precio: $<?php echo number_format($producto['precio'], 2); ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Columna derecha: Pedidos Listos -->
        <div class="col-md-6 mt-5">
            <div class="border-start border-end border-top border-success rounded-top p-3 mb-3">
                <h3 class="text-center text-success fw-bold"><i class="fa-regular fa-circle-check"></i> Pedidos Listos</h3>
            </div>
            <?php foreach ($pedidosAgrupados as $idpedido => $pedido): ?>
                <?php if ($pedido['productos'][0]['estado_pedido'] == 2): ?>
                    <div class="p-4 mb-4 shadow-lg bg-white rounded">
                        <!-- Contenedor flexible: ID + Total a la izquierda | Info del pedido a la derecha -->
                        <div class="d-flex align-items-center">
                            <!-- ID del pedido y Total -->
                            <div class="me-4 text-center">
                                <h4 class="fw-bold bg-warning text-dark px-3 py-2 rounded">Pedido No. <?php echo $idpedido; ?></h4>
                                <div class="text-success fw-bold fs-5 mt-2">
                                    Total: $<?php echo number_format($pedido['productos'][0]['total_pedido'], 2); ?>
                                    <hr class="mt-1 mb-0 border-2 border-success w-50 mx-auto">
                                </div>
                            </div>

                            <!-- Información del pedido -->
                            <div class="text-end flex-grow-1">
                                <p class="mb-1"><strong>Fecha:</strong> <?php echo $pedido['fecha_pedido']; ?></p>
                                <p class="mb-1"><strong>Empleado:</strong> <?php echo $pedido['nomemp'] ?: 'Pendiente'; ?></p>
                                <p class="mb-1"><strong>Usuario:</strong> <?php echo $pedido['productos'][0]['nomusu']; ?></p>
                                <p class="mb-0"><strong>Dirección:</strong> <?php echo htmlspecialchars($pedido['direccion']); ?></p>
                                <p class="mb-0 text-primary"><strong>Servicio Bartender: <?php echo htmlspecialchars($pedido['servicio']); ?></strong></p>
                            </div>

                        </div>

                        <!-- Lista de productos -->
                        <ul class="list-group mt-3">
                            <?php foreach ($pedido['productos'] as $producto): ?>
                                <li class="list-group-item d-flex align-items-center">
                                    <img src="img/<?php echo htmlspecialchars($producto['fotprod'] ?: 'default.jpg'); ?>"
                                        alt="Imagen de <?php echo htmlspecialchars($producto['nombre_producto']); ?>"
                                        class="me-3"
                                        style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;">
                                    <div class="text-center flex-grow-1">
                                        <strong class="d-block"><?php echo $producto['nombre_producto']; ?></strong>
                                        <span class="text-muted">Cantidad: <?php echo $producto['cantidad']; ?> | <?php echo $producto['mililitros']; ?> ml</span>
                                        <span class="d-block text-success fw-bold">Precio: $<?php echo number_format($producto['precio'], 2); ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>