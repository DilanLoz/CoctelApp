<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../models/mempedproc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idpedido = $_POST['idpedido'] ?? null;

    if (!$idpedido) {
        echo json_encode(['success' => false, 'error' => 'ID de pedido faltante']);
        exit;
    }

    file_put_contents('debug.log', "ID recibido: $idpedido\n", FILE_APPEND);  // Log del ID recibido

    $pedidoModel = new Mempedproc();
    $resultado = $pedidoModel->actualizarEstadoPago($idpedido);

    if ($resultado) {
        file_put_contents('debug.log', "Pedido $idpedido actualizado correctamente\n", FILE_APPEND);
    } else {
        file_put_contents('debug.log', "Error al actualizar el pedido $idpedido\n", FILE_APPEND);
    }

    echo json_encode(['success' => $resultado, 'error' => $resultado ? null : 'Error al actualizar en BD']);
    exit;
}


class PedidoAceptadoController {
    public function listarPedidosAcep() {
        $pedidoModel = new Mempedproc();
        return $pedidoModel->getAllPedidos();
    }
}
?>
