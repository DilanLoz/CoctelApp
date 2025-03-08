<?php
require_once 'controllers/cempedproc.php';
$pedidoController = new PedidoController();
$pedidos = $pedidoController->listarPedidos();
?>
<link rel="stylesheet" href="css/bares.css">
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <?php if (!empty($pedidos)): ?>
            <?php foreach ($pedidos as $pedido): ?>
                <div class="col-md-5 mb-5 me-2 ms-2 p-3 dtped">
                    <div class="rounded bg-black">
                        <a href="home.php?pg=2006&idpedido=<?php echo $pedido['idpedido']; ?>"
                            class="dtpedproc text-center text-white mb-3">
                            Ver Detalles
                        </a>
                    </div>
                    <div>
                        <h6 class="fw-bold">No. Pedido <?php echo $pedido['idpedido']; ?></h6>
                        <h6>Dirección: <?php echo $pedido['direccion']; ?></h6>
                        <h6>Cant Productos: <?php echo $pedido['cantidad']; ?></h6>
                        <div class="d-flex justify-content-center mb-2 mt-3">
                            <div class="col-8 border-top border-warning border-3"></div>
                        </div>
                        <center>
                            <h5 class="fw-bold">Total: $<?php echo number_format($pedido['total'], 2); ?></h5>
                        </center>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center">
                <h3 class="mt-3 fw-bold fs-4 fs-md-3 fs-lg-2">No hay pedidos en proceso.</h3>
                <img src="./img/coctelapp/svg/Heavy_box-bro.png" alt="Sin pedidos" class="img-fluid w-50 w-md-50 w-lg-25">
            </div>
        <?php endif; ?>
    </div>
</div>