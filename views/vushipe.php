
<!-- NECESITO SOBRE PEDIDO Y NO FACTURA ENTONCES ME SIRVE MODELOS DE PEDIDO EN PROCESO -->
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

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered text-center">
            <thead class="table-warning">
                <tr>
                    <th>Marcar</th>
                    <th>ID Factura</th>
                    <th>ID Pedido</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Comisión (2%)</th>
                    <th>Estado de Pago</th>
                    <th>PDF</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($facturas)) {
                    foreach ($facturas as $factura) {
                        $comision = $factura['total'] * 0.02; // 2% del total
                        echo "<tr>
                            <td>
                                <button class='btn btn-outline-dark select-row'>
                                    <i class='fas fa-check'></i>
                                </button>
                            </td>
                            <td>{$factura['idfact']}</td>
                            <td>{$factura['idpedido']}</td>
                            <td>{$factura['fecha']}</td>
                            <td>$ " . number_format($factura['total'], 0, ',', '.') . "</td>
                            <td>$ " . number_format($comision, 0, ',', '.') . "</td>
                            <td>{$factura['estado_pago']}</td>
                            <td>
                                <a href='PDF/Empleado/HisFacturaEmp.php?idfact={$factura["idfact"]}' 
                                class='btn btn-outline-danger btn-sm' 
                                target='_blank' 
                                rel='noopener noreferrer'>
                                    <i class='fas fa-file-pdf'></i>
                                </a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No hay pedidos en el historial.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Agregar el script de selección de fila -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".select-row").forEach(button => {
        button.addEventListener("click", function() {
            let row = this.closest("tr");

            // Alternar la clase "selected"
            row.classList.toggle("selected");
        });
    });
});
</script>

<!-- Estilos CSS para destacar la fila seleccionada -->
<style>
.selected {
    background-color: rgba(255, 193, 7, 0.5) !important; /* Amarillo con opacidad */
}   
</style>
