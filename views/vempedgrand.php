<?php
require_once 'controllers/cempedgrand.php';

$idpedido = isset($_GET['idpedido']) ? $_GET['idpedido'] : null;
$detalleController = new Cdetpedido();
$productos = $detalleController->listarDetallesPedido($idpedido);
$totalGeneral = 0;
?>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-12 text-center">
      <h1 class="text-dark fw-bold">Pedido No. <?php echo $idpedido; ?></h1>
      <hr class="border border-warning border-3 w-50 mx-auto">
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-8">
      <h3 class="mb-4 fw-bold">Detalles de Pedido</h3>
      <?php if (!empty($productos)): ?>
        <div class="row g-3">
          <?php foreach ($productos as $producto): ?>
            <div class="col-md-6">
              <div class="card shadow-sm border-warning">
                <div class="card-body">
                  <h5 class="card-title text-dark fw-bold"> <?php echo $producto['nombre_producto']; ?> </h5>
                  <h6 class="text-muted">Bar: <?php echo $producto['nombar']; ?></h6>
                  <p class="mb-1">Cantidad: <span class="fw-bold"> <?php echo $producto['cantidad']; ?></span></p>
                  <p class="mb-1">Precio Unidad: <span class="fw-bold">$<?php echo number_format($producto['precio'], 2); ?></span></p>
                  <p class="mb-0">Total: <span class="fw-bold text-success">$<?php echo number_format($producto['total'], 2); ?></span></p>
                </div>
              </div>
            </div>
            <?php $totalGeneral += $producto['total']; ?>
          <?php endforeach; ?>
        </div>
        <div class="mt-4 p-3 bg-dark rounded text-white text-center">
          <h4 class="fw-bold">Total General: $<?php echo number_format($totalGeneral, 2); ?></h4>
        </div>
      <?php else: ?>
        <p class="text-danger">No hay detalles para este pedido.</p>
      <?php endif; ?>
    </div>

    <div class="col-md-4 d-flex align-items-center justify-content-center mt-4">
      <button class="btn btn-success btn-lg shadow" data-bs-toggle="modal" data-bs-target="#confirmModal">Aceptar Pedido</button>
    </div>
  </div>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="confirmModalLabel">Confirmar Pedido</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="fw-bold text-dark">¿Estás seguro de aceptar este pedido?</p>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-warning fw-bold" onclick="aceptarPedido()">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<script>
function aceptarPedido() {
    alert("Pedido aceptado correctamente.");
    var modal = document.getElementById("confirmModal");
    var modalInstance = bootstrap.Modal.getInstance(modal);
    modalInstance.hide();
}
</script>
