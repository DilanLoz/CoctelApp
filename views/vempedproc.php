<?php
require_once 'controllers/cempedproc.php';
$pedidoController = new PedidoController();
$pedidos = $pedidoController->listarPedidos();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="css/bares.css">

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <?php if (!empty($pedidos)): ?>
            <?php foreach ($pedidos as $pedido): ?>
                <div class="col-md-5 mb-5 me-2 ms-2 p-3 dtped">
                    <div class="rounded bg-black">
                        <a href="home.php?pg=2001&id=<?php echo $pedido['idpedido']; ?>" class="dtpedproc text-center text-white mb-3">
                            Ver Detalles
                        </a>
                    </div>
                    <div>
                        <h6 class="fw-bold">No. Pedido <?php echo $pedido['idpedido']; ?></h6>
                        <h6>Dirección: <?php echo $pedido['direccion']; ?></h6>
                        <h6>Cant Productos: <?php echo $pedido['cantidad']; ?></h6>
                        <h6>Tel Cliente: <?php echo $pedido['idusu']; ?></h6> <!-- Aquí deberías mostrar el teléfono -->
                        <div class="d-flex justify-content-center mb-2 mt-3">
                            <div class="col-8 border-top border-warning border-3"></div>
                        </div>
                        <center><h5 class="fw-bold">Total: $<?php echo number_format($pedido['total'], 2); ?></h5></center>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No hay pedidos en proceso.</p>
        <?php endif; ?>
    </div>
</div>
