<?php
require_once "models/conexion.php";

class CronJobs {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->get_conexion();
    }

    private function ejecutarConsulta($sql) {
        $stmt = $this->db->prepare($sql);
        return $stmt->execute();
    }

    public function actualizarEstadoEntregado() {
        $sql = "UPDATE pedido SET estado = 'Entregado' WHERE estado_pago = 'Pagado' AND estado <> 'Entregado'";
        $this->ejecutarConsulta($sql);
    }

    public function actualizarEstadoPedidos() {
        $sql = "UPDATE pedido SET estado_pedido = 3 WHERE estado_pedido = 1 AND TIMESTAMPDIFF(HOUR, fecha_pedido, NOW()) > 8";
        $this->ejecutarConsulta($sql);
    }

    public function actualizarFacturasPendientes() {
        $sql1 = "UPDATE pedido p JOIN facturas_pendientes fp ON p.idpedido = fp.idpedido SET p.idfactura = fp.idfactura";
        $sql2 = "DELETE FROM facturas_pendientes WHERE idpedido IN (SELECT idpedido FROM pedido)";
        $this->ejecutarConsulta($sql1);
        $this->ejecutarConsulta($sql2);
    }

    public function actualizarPedidoCantidad() {
        $sql = "UPDATE pedido p SET p.cantidad = (SELECT COALESCE(SUM(dp.cantidad), 0) FROM detpedido dp WHERE dp.idpedido = p.idpedido)";
        $this->ejecutarConsulta($sql);
    }

    public function actualizarTotalesFactura() {
        $sql = "UPDATE factura f INNER JOIN (SELECT df.idfact, SUM(df.subtotal) AS total_factura FROM detfact df GROUP BY df.idfact) AS temp ON f.idfact = temp.idfact SET f.total = temp.total_factura";
        $this->ejecutarConsulta($sql);
    }

    public function eliminarPedidosVacios() {
        $sql = "DELETE FROM pedido WHERE idpedido NOT IN (SELECT DISTINCT idpedido FROM detpedido)";
        $this->ejecutarConsulta($sql);
    }

    public function anularFacturas() {
        $sql = "UPDATE factura SET estado = 'anulada' WHERE estado = 'activa' AND fecha < NOW() - INTERVAL 3 DAY";
        $this->ejecutarConsulta($sql);
    }

    public function procesarFacturas() {
        $sql1 = "INSERT INTO factura (idpedido, fecha, idemp, cantidad, total, direccion, idusu, metodo_pago, estado_pago, estado) SELECT idpedido, NOW(), idemp, cantidad, total, direccion, idusu, metodo_pago, 'Pagado', 'activa' FROM pedido WHERE idpedido IN (SELECT idpedido FROM temp_factura)";
        $sql2 = "DELETE FROM temp_factura WHERE idpedido IN (SELECT idpedido FROM temp_factura)";
        $this->ejecutarConsulta($sql1);
        $this->ejecutarConsulta($sql2);
    }
}

// Ejecutar los cron jobs
$cron = new CronJobs();
$cron->actualizarEstadoEntregado();
$cron->actualizarEstadoPedidos();
$cron->actualizarFacturasPendientes();
$cron->actualizarPedidoCantidad();
$cron->actualizarTotalesFactura();
$cron->eliminarPedidosVacios();
$cron->anularFacturas();
$cron->procesarFacturas();

echo "Cron jobs ejecutados correctamente.";

// Registrar en un archivo de log
file_put_contents(__DIR__ . "/cron_log.log", date("Y-m-d H:i:s") . " - Cron ejecutado\n", FILE_APPEND);

?>
