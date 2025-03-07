<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../models/mempedproc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idpedido = $_POST['idpedido'] ?? null;

    if (!$idpedido) {
        echo json_encode(['success' => false, 'error' => 'Datos faltantes']);
        exit;
    }

    $pedidoModel = new Mempedproc();
    $resultado = $pedidoModel->entregarPedido($idpedido);

    echo json_encode(['success' => $resultado]);
    exit;
}

?>
