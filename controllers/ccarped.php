<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../models/mcarped.php';
require_once __DIR__ . '/../models/conexion.php';
$conexion = (new Conexion())->get_conexion();
$idUsuario = $_SESSION['idusu'] ?? null;
$usuario = null;

if ($idUsuario) {
    $stmt = $conexion->prepare("SELECT * FROM usuario WHERE idusu = :idusu");
    $stmt->bindParam(":idusu", $idUsuario, PDO::PARAM_INT);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCarrito = $_POST['idcarrito'] ?? null;
    $cantidad = $_POST['cantidad'] ?? null;
    $total = $_POST['total'] ?? null;
    $direccion = $_POST['direccion'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $mensaje = $_POST['mensaje'] ?? null;
    $metodoPago = $_POST['metodo_pago'] ?? null;

    if (!$idCarrito || !$cantidad || !$total || !$idUsuario || !$direccion || !$metodoPago) {
        echo json_encode(['success' => false, 'error' => 'Faltan datos']);
        exit;
    }

    $pedidoModel = new MPedido();
    
    // Convertir el carrito a "convertido"
    $convertido = $pedidoModel->convertirCarrito($idCarrito);
    if (!$convertido) {
        echo json_encode(['success' => false, 'error' => 'Error al actualizar el carrito']);
        exit;
    }

    // Esperar 10 segundos antes de insertar el pedido
    sleep(10);

    // Insertar el pedido
    $idPedido = $pedidoModel->insertarPedido([
        ':idcarrito' => $idCarrito,
        ':cantidad' => $cantidad,
        ':total' => $total,
        ':idusu' => $idUsuario,
        ':direccion' => $direccion,
        ':mensaje' => $mensaje,
        ':metodo_pago' => $metodoPago
    ]);

    if ($idPedido) {
        echo json_encode(['success' => true, 'idpedido' => $idPedido]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al insertar el pedido']);
    }
    exit;
}
?>
