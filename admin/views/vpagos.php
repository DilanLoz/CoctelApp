<?php
require_once 'admin/models/mpagos.php'; // Asegúrate de que la ruta es correcta

$model = new Mdetfact();
$pagos = $model->getAll(); // Obtiene todos los registros
?>
<br>
<br>
<div class="conte">
    <h1>Pagos</h1>
    <table id="example" class="table table-striped" width="100%" style="text-align: left;">
        <thead>
            <tr>
                <th>ID Factura</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>ID Pedido</th>
                <th>Total</th>
                <th>Bar</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pagos)) : ?>
                <?php foreach ($pagos as $pago) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($pago['idfact']); ?></td>
                        <td>
                            <?php
                            $estado = $pago['estado'];
                            ?>
                            <span class="estado-circulo estado-<?php echo strtolower($estado); ?>"></span>
                            <?php echo htmlspecialchars($estado); ?>
                        </td>


                        <td><?php echo htmlspecialchars($pago['fecha']); ?></td>
                        <td><?php echo htmlspecialchars($pago['idpedido']); ?></td>
                        <td><?php echo number_format($pago['total'], 2, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($pago['idbar'] . ' - ' . $pago['nombar']); ?></td>
                        <td><?php echo htmlspecialchars($pago['idusu'] . ' - ' . $pago['nomusu']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">No hay pagos registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<style>
    .estado-circulo {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 5px;
    }

    .estado-activa {
        background-color: #28a745 !important;
    }

    .estado-anulada {
        background-color: #dc3545 !important;
    }
</style>