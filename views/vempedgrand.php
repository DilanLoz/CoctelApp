<?php
require_once 'controllers/cempedgrand.php';
require_once 'controllers/cempedproc.php';

$idpedido = isset($_GET['idpedido']) ? $_GET['idpedido'] : null;
$detalleController = new Cdetpedido();
$productos = $detalleController->listarDetallesPedido($idpedido);
$totalGeneral = 0;
$direccionPedido = isset($productos[0]['direccion']) ? $productos[0]['direccion'] : 'No disponible';
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
                <img src="img/productos/<?php echo htmlspecialchars($producto['fotprod'] ?: 'default.jpg'); ?>"
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
            <?php $totalGeneral += $producto['total']; ?>
          <?php endforeach; ?>
        </div>

        <div class="mt-4 p-3 bg-light rounded text-dark text-center">
          <h5 class="fw-bold">Dirección de Entrega:</h5>
          <p class="mb-0"> <?php echo htmlspecialchars($direccionPedido); ?> </p>
        </div>
        <div class="mt-4 p-3 bg-dark rounded text-white text-center">
          <h4 class="fw-bold">Total General: $<?php echo number_format($totalGeneral, 2); ?></h4>
        </div>
      <?php else: ?>
        <div class="text-center">
          <h3 class="mt-3 fw-bold fs-4 fs-md-3 fs-lg-2">No hay detalles de pedido.</h3>
          <img src="./img/coctelapp/svg/personal _goals _checklist-pana.png" alt="Sin pedidos" class="img-fluid w-50 w-md-50 w-lg-25">
        </div>
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
<!-- Modal de Éxito -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title fw-bold" id="successModalLabel">Pedido Aceptado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="fw-bold text-dark">El pedido ha sido aceptado correctamente.</p>
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
        <p class="fw-bold text-dark">Hubo un problema al aceptar el pedido. Intenta de nuevo.</p>
      </div>
    </div>
  </div>
</div>


<script>
  function aceptarPedido() {
    var idpedido = "<?php echo $idpedido; ?>"; // ID del pedido actual
    var idemp = "<?php echo $_SESSION['idusu']; ?>"; // ID del usuario en sesión (empleado)

    fetch('controllers/cempedproc.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `idpedido=${idpedido}&idemp=${idemp}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Mostrar el modal de éxito
          var successModal = new bootstrap.Modal(document.getElementById('successModal'));
          successModal.show();

          // Redirigir después de 2 segundos
          setTimeout(() => {
            window.location.href = "home.php?pg=2005";
          }, 2000);
        } else {
          // Mostrar modal de error si falla
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