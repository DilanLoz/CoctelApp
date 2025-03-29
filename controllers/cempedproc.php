<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../models/mempedproc.php';  // Sube un nivel para encontrar el archivo


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idpedido = $_POST['idpedido'] ?? null;
    $idemp = $_POST['idemp'] ?? null;

    if (!$idpedido || !$idemp) {
        echo json_encode(['success' => false, 'error' => 'Datos faltantes']);
        exit;
    }

    $pedidoModel = new Mempedproc();
    $resultado = $pedidoModel->aceptarPedido($idpedido, $idemp);

    echo json_encode(['success' => $resultado]);
    exit;
}
class PedidoController {
    public function listarPedidos() {
        $pedidoModel = new Mempedproc();
        return $pedidoModel->getAll();
    }
}
class PedidoAceptadoController {
    public function listarPedidosAcep($idusu) {
        try {
            $sql = "SELECT p.idpedido, p.idcarrito, p.cantidad, p.fecha_pedido, p.estado, p.total, 
                           p.idusu, p.direccion, p.estado_pago, p.metodo_pago, p.estado_pedido, p.telefono
                    FROM pedido AS p 
                    WHERE p.estado_pedido = 2 
                    AND (p.idusu = :idusu OR p.idemp = :idusu)
                    ORDER BY p.idpedido DESC";
            
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute([':idusu' => $idusu]); // Se pasa el valor de idusu
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>