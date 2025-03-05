<?php
require_once 'controllers/cempedacep.php';
$pedidoController = new PedidoController();
$idemp = $_SESSION['idusu'];
$pedidos = $pedidoController->listarPedidosPorEmpleado($idemp);
?>
<link rel="stylesheet" href="css/bares.css">

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <?php if (!empty($pedidos)): ?>
            <?php foreach ($pedidos as $pedido): ?>
                <div class="col-md-5 mb-5 me-2 ms-2 p-3 dtped border rounded shadow">
                    <div class="rounded bg-black">
                        <a href="home.php?pg=2006&idpedido=<?php echo $pedido['idpedido']; ?>"
                            class="dtpedproc text-center text-white mb-3">
                            <i class="fa-solid fa-eye"></i> Ver Detalles
                        </a>
                    </div>
                    <h6 class="fw-bold">No. Pedido <?php echo $pedido['idpedido']; ?></h6>
                    <h6>Dirección: <?php echo $pedido['direccion']; ?></h6>
                    <h6>Cant Productos: <?php echo $pedido['cantidad']; ?></h6>

                    <div class="progress mb-3">

                        <?php
                        $estadoPedido = $pedido['estado_pedido']; // El estado viene como texto

                        if ($estadoPedido == "En preparación") {
                            $porcentaje = '50%';
                            $claseEstado = 'bg-info';
                            $textoEstado = 'En preparación';
                        } elseif ($estadoPedido == "En camino") {
                            $porcentaje = '90%';
                            $claseEstado = 'bg-primary';
                            $textoEstado = 'En camino';
                        } else {
                            $porcentaje = '100%';
                            $claseEstado = 'bg-success';
                            $textoEstado = 'Entregado';
                        }
                        ?>
                        <div class="progress-bar <?php echo $claseEstado; ?> estado-barra" style="width: <?php echo $porcentaje; ?>;">
                            <?php echo $textoEstado; ?>
                        </div>
                    </div>

                    <button class="btn btn-dark btn-sm btn-confirmar"
                        data-idpedido="<?php echo $pedido['idpedido']; ?>"
                        data-estado="<?php echo $pedido['estado_pedido']; ?>">
                        <i class="fas fa-arrow-right"></i> Confirmar
                    </button>

                    <div class="modal fade" id="modalClave<?php echo $pedido['idpedido']; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirmar Entrega</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Ingrese la clave secreta para confirmar la entrega.</p>
                                    <input type="password" id="clave<?php echo $pedido['idpedido']; ?>" class="form-control" placeholder="Clave Secreta">
                                    <p id="msgClave<?php echo $pedido['idpedido']; ?>" class="text-danger mt-2" style="display: none;"></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary btn-validar"
                                        data-idpedido="<?php echo $pedido['idpedido']; ?>">Validar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center">
                <img src="img/no_pedidos.png" alt="No hay pedidos" class="img-fluid" style="max-width: 300px;">
                <p class="mt-3">No hay pedidos en proceso.</p>
            </div>
        <?php endif; ?>
    </div>
</div>