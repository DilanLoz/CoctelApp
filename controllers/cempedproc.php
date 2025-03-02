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
?>