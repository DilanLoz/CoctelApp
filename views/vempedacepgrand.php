<?php
require_once 'controllers/cempedgrand.php';
require_once 'controllers/cempedproc.php';
require_once 'controllers/cempedacep.php';

$idpedido = isset($_GET['idpedido']) ? $_GET['idpedido'] : null;
$detalleController = new Cdetpedido();
$productos = $detalleController->listarDetallesPedido($idpedido);
$totalGeneral = 0;
$direccionPedido = isset($productos[0]['direccion']) ? $productos[0]['direccion'] : 'No disponible';
$mensajePedido = isset($productos[0]['mensaje']) ? $productos[0]['mensaje'] : 'Sin mensaje';
$estadoPedido = (!empty($productos) && isset($productos[0]['estado'])) ? $productos[0]['estado'] : 'Sin estado';

// Calcular el total antes de mostrarlo
foreach ($productos as $producto) {
  $totalGeneral += $producto['total'];
}
?>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-12 text-center">
      <h1 class="text-dark fw-bold">Pedido No. <?php echo $idpedido; ?></h1>
      <hr class="border border-warning border-3 w-50 mx-auto">
    </div>
  </div>
  <div class="row mt-4 justify-content-center">
    <div class="col-md-8 mx-auto text-center">
      <!-- Barra de estado -->
      <div class="mt-3">
        <div class="progress mb-3">
          <div class="progress-bar bg-info estado-barra" style="width: 60%;">
            <?php echo htmlspecialchars($estadoPedido); ?>
          </div>
        </div>
        <button class="btn btn-warning btn-confirmar" data-bs-toggle="modal" data-bs-target="#confirmModal">
          <i class="fas fa-arrow-right"></i> Continuar
        </button>
      </div>

      <!-- Mostrar el total general antes de la lista -->
      <div class="mt-4 mb-4 p-3 bg-dark rounded text-white text-center">
        <h4 class="fw-bold">Total General: $<?php echo number_format($totalGeneral, 2); ?></h4>
      </div>

      <div class="mt-4 p-3 bg-light rounded text-dark text-center">
        <h5 class="fw-bold">Dirección de Entrega:</h5>
        <p class="mb-0"><?php echo htmlspecialchars($direccionPedido); ?></p>
      </div>

      <div class="mt-2 mb-2 p-3 bg-light rounded text-dark text-center">
        <h5 class="fw-bold">Mensaje:</h5>
        <p class="mb-0"><?php echo htmlspecialchars($mensajePedido); ?></p>
      </div>

      <h3 class="mb-4 fw-bold">Detalles de Pedido</h3>

      <?php if (!empty($productos)): ?>
        <div class="row g-3 justify-content-center">
          <?php foreach ($productos as $producto): ?>
            <div class="col-md-6">
              <div class="card shadow-sm border-warning text-center">
                <img src="img/<?php echo htmlspecialchars($producto['fotprod'] ?: 'default.jpg'); ?>"
                  class="card-img-top mx-auto d-block mt-2"
                  style="width: 90px; height: auto;"
                  alt="Imagen del producto">
                <div class="card-body">
                  <h5 class="card-title text-dark fw-bold"><?php echo $producto['nombre_producto']; ?></h5>
                  <h6 class="text-muted">Bar: <?php echo $producto['nombar']; ?></h6>
                  <p class="mb-1">Cantidad: <span class="fw-bold"><?php echo $producto['cantidad']; ?></span> - ml <span class="fw-bold"><?php echo $producto['mililitros']; ?></span></p>
                  <p class="mb-1">Precio Unidad: <span class="fw-bold">$<?php echo number_format($producto['precio'], 2); ?></span></p>
                  <p class="mb-0">Total: <span class="fw-bold text-success">$<?php echo number_format($producto['total'], 2); ?></span></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p class="text-danger">No hay detalles para este pedido.</p>
      <?php endif; ?>
    </div>
  </div>
</div>
<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="confirmModalLabel">Confirmar Entrega</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="fw-bold text-dark">¿Estás seguro de marcar este pedido como entregado?</p>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-warning fw-bold" onclick="entregarPedido()">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Éxito -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title fw-bold" id="successModalLabel">Pedido Entregado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="fw-bold text-dark">El pedido ha sido marcado como entregado correctamente.</p>
        <div class="spinner-border text-success" role="status">
          <span class="visually-hidden">Redirigiendo...</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Error -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fw-bold" id="errorModalLabel">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="fw-bold text-dark">Hubo un problema al actualizar el pedido. Intenta de nuevo.</p>
      </div>
    </div>
  </div>
</div>

<style>
  .progress {
    height: 30px;
    /* Aumenta la altura de la barra */
    border-radius: 5px;
    overflow: hidden;
    /* Evita que el fondo blanco se vea */
  }

  .progress-bar {
    font-size: 16px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .btn-confirmar {
    width: 100%;
  }
</style>
<script>
function entregarPedido() {
    var idpedido = "<?php echo $idpedido; ?>"; // ID del pedido actual

    fetch('controllers/cempedproc.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `idpedido=${idpedido}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          var successModal = new bootstrap.Modal(document.getElementById('successModal'));
          successModal.show();

          setTimeout(() => {
            window.location.href = "home.php?pg=2005";
          }, 2000);
        } else {
          var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
          errorModal.show();
        }
      })
      .catch(error => {
        console.error("Error en la solicitud:", error);
        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
      });
}
</script>