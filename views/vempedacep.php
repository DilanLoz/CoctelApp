<?php
require_once 'controllers/cempedproc.php';

if (!isset($_SESSION['idusu'])) {
    die('El usuario no está autenticado.');
}

$idusu = $_SESSION['idusu'];  // Se obtiene el id del usuario desde la sesión

// Se pasa el valor de $idusu a la función listarPedidosAcep
$pedidoAcepController = new PedidoAceptadoController();
$pedidos = $pedidoAcepController->listarPedidosAcep($idusu);  // Pasa $idusu como parámetro

?>
<link rel="stylesheet" href="css/bares.css">
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
    <?php if (!empty($pedidos)): ?>
        <?php foreach ($pedidos as $pedido): ?>
        <div class="col-md-5 mb-5 me-2 ms-2 p-3 border rounded shadow">
            <div class="rounded bg-black">
                <a href="home.php?pg=2008&idpedido=<?php echo $pedido['idpedido']; ?>" 
                   class="dtpedproc text-center text-white mb-3">
                    Ver Detalles
                </a>
            </div>
            <div>
                <h4 class="fw-bold">No. Pedido <?php echo $pedido['idpedido']; ?></h4>
                <h6>Dirección: <?php echo $pedido['direccion']; ?></h6>
                <h6>Cant Productos: <?php echo $pedido['cantidad']; ?></h6>
                <h6>Teléfono: 
                    <span id="telefono-<?php echo $pedido['idpedido']; ?>"><?php echo $pedido['telefono']; ?></span>
                    <button class="btn btn-sm btn-outline-info" 
                            onclick="copiarTelefono('<?php echo $pedido['idpedido']; ?>')">
                            <i class="fa-solid fa-copy"></i>
                    </button>
                </h6>
                <div class="d-flex justify-content-center mb-2 mt-3">
                    <div class="col-8 border-top border-warning border-3"></div>
                </div>
                <center><h5 class="fw-bold">Total: $<?php echo number_format($pedido['total'], 2); ?></h5></center>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center">
                <h3 class="mt-3 fw-bold fs-4 fs-md-3 fs-lg-2">No hay pedidos aceptados.</h3>
                <img src="./img/coctelapp/svg/team_checklist.gif" alt="Sin pedidos" class="img-fluid w-50 w-md-50 w-lg-25">
            </div>
    <?php endif; ?>
    </div>
</div>

<script>
function copiarTelefono(idPedido) {
    var telefono = document.getElementById("telefono-" + idPedido).textContent;
    navigator.clipboard.writeText(telefono).catch(err => {
        console.error("Error al copiar el teléfono:", err);
    });
}
</script>
