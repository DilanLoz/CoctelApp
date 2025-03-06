<?php
require_once 'controllers/cempedgrand.php';
require_once 'controllers/cempedproc.php';
require_once 'controllers/cempedacep.php';

$idpedido = isset($_GET['idpedido']) ? $_GET['idpedido'] : null;
$detalleController = new ();
$productos = $detalleController->listarDetallesPedido($idpedido);
$totalGeneral = 0;
$direccionPedido = isset($productos[0]['direccion']) ? $productos[0]['direccion'] : 'No disponible';
$mensajePedido = isset($productos[0]['mensaje']) ? $productos[0]['mensaje'] : 'Sin mensaje';
$estadoPedido = isset($productos[0]['estado']) ? $productos[0]['estado'] : 'Sin mensaje';

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
      <div class="progress-bar bg-info estado-barra" style="width: 60%;"><?php echo htmlspecialchars($estadoPedido); ?></div>
    </div>
    <button class="btn btn-warning btn-confirmar">
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




<style>
        .progress {
            height: 30px; /* Aumenta la altura de la barra */
            border-radius: 5px;
            overflow: hidden; /* Evita que el fondo blanco se vea */
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
    document.querySelectorAll(".btn-confirmar").forEach((boton, index) => {
        let estado = 1; // Estado inicial
        const barra = document.querySelectorAll(".estado-barra")[index];

        boton.addEventListener("click", () => {
            if (estado === 1) {
                barra.style.width = "90%";
                barra.textContent = "En camino";
                barra.classList.remove("bg-info");
                barra.classList.add("bg-primary");
                estado++;
            } else if (estado === 2) {
                barra.style.width = "100%";
                barra.textContent = "Entregado";
                barra.classList.remove("bg-primary");
                barra.classList.add("bg-success");
                estado++;

                // Deshabilitar botón
                boton.classList.remove("btn-dark");
                boton.classList.add("btn-secondary");
                boton.innerHTML = '<i class="fas fa-lock"></i> Pedido ya entregado';
                boton.disabled = true;
            }
        });
    });
    function actualizarEstadoPedido(idpedido) {
    let passecret = null;

    if (document.getElementById("modalClave")) {
        passecret = document.getElementById("claveInput").value;
    }

    fetch("controllers/cempedproc.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `idpedido=${idpedido}&passecret=${passecret}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.estado === "En camino") {
                alert("Estado actualizado a 'En camino'");
            } else if (data.estado === "Entregado") {
                alert("Entrega confirmada");
            }
            location.reload();
        } else if (data.require_password) {
            mostrarModalClave(idpedido);
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error("Error:", error));
}

function mostrarModalClave(idpedido) {
    let modalHtml = `
        <div id="modalClave" class="modal fade show" style="display:block;" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Entrega</h5>
                        <button type="button" class="btn-close" onclick="cerrarModalClave()"></button>
                    </div>
                    <div class="modal-body">
                        <p>Ingresa la clave secreta para confirmar la entrega:</p>
                        <input type="password" id="claveInput" class="form-control">
                        <p id="errorClave" class="text-danger mt-2" style="display:none;">Clave incorrecta</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" onclick="cerrarModalClave()">Cancelar</button>
                        <button class="btn btn-primary" onclick="verificarClave(${idpedido})">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>`;
    
    document.body.insertAdjacentHTML("beforeend", modalHtml);
}

function cerrarModalClave() {
    document.getElementById("modalClave").remove();
}

function verificarClave(idpedido) {
    actualizarEstadoPedido(idpedido);
}

</script>