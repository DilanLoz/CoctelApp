<?php
require_once 'models/mbargan.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idusu'])) {
    die('El usuario no está autenticado.');
}

$idusu = $_SESSION['idusu'];
$facturaModel = new Mbargan();

// Obtener el historial de pedidos del usuario (cliente, bar o empleado)
$facturas = $facturaModel->getHistorialPedidos($idusu);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="css/style.css">

<div class="container mt-5 mb-5">
    <h2 class="text-center text-warning fw-bold mb-4">Historial de Pedidos</h2>

    <table id="example" class="table table-striped table-bordered text-cente" style="width:100%">
        <thead class="table-warning">
            <tr>
                <th>ID Factura</th>
                <th>ID Pedido</th>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Dirección</th>
                <th>Estado de Pago</th>
                <th>Método de Pago</th>
                <th>Estado</th>
                <th>PDF</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($facturas)) {
                foreach ($facturas as $factura) {
                    echo "<tr>
                        <td>{$factura['idfact']}</td>
                        <td>{$factura['idpedido']}</td>
                        <td>{$factura['fecha']}</td>
                        <td>{$factura['cantidad']}</td>
                        <td>$ " . number_format($factura['total'], 0, ',', '.') . "</td>
                        <td>{$factura['direccion']}</td>
                        <td>{$factura['estado_pago']}</td>
                        <td>{$factura['metodo_pago']}</td>
                        <td>{$factura['estado']}</td>
                      <td>
                        <a href='views/vfacturapdf.php?idfact={$factura["idfact"]}' 
                        class='btn btn-outline-danger' 
                        target='_blank' 
                        rel='noopener noreferrer'>
                            <i class='fas fa-file-pdf'></i>
                        </a>
                    </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='10' class='text-center'>No hay pedidos en el historial.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
