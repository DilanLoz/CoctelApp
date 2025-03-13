<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__ . '/../models/mcarped.php';
require_once __DIR__ . '/../models/conexion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    $conexion = (new Conexion())->get_conexion();
    $idUsuario = $_SESSION['idusu'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'] ?? null;

        if ($accion === 'guardarCarrito') {
            $direccion = $_POST['direccion'] ?? null;
            $mensaje = $_POST['mensaje'] ?? null;
            $telefono = $_POST['telefono'] ?? null;
            $metodo_pago = $_POST['metodo_pago'] ?? null;

            if (!$direccion || !$metodo_pago) {
                echo json_encode(['success' => false, 'error' => 'Faltan datos obligatorios']);
                exit;
            }

            $mpcarrito = new MPedido();
            $mpcarrito->setIdUsu($idUsuario);
            $mpcarrito->setDireccion($direccion);
            $mpcarrito->setMensaje($mensaje);
            $mpcarrito->setTelefono($telefono);
            $mpcarrito->setMetodoPago($metodo_pago);

            $resultado = $mpcarrito->saveCarrito();
            if ($resultado === true) {
                echo json_encode(['success' => true, 'idcarrito' => $mpcarrito->getIdCarrito()]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error al guardar el carrito: ' . $resultado]);
            }
            exit;
        }

        if ($accion === 'convertirCarrito') {
            $idcarrito = $_POST['idcarrito'] ?? null;

            if (!$idcarrito) {
                echo json_encode(['success' => false, 'error' => 'ID de carrito faltante']);
                exit;
            }

            $pedidoModel = new MPedido();
            $resultado = $pedidoModel->actualizarCarrito($idcarrito);

            echo json_encode(['success' => $resultado, 'error' => $resultado ? null : 'Error al actualizar en BD']);
            exit;
        }
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Error crítico: ' . $e->getMessage()]);
    exit;
}
