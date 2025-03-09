<?php
include_once(__DIR__ . "/../models/mcarr.php");
include_once(__DIR__ . "/../models/conexion.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conexion = (new Conexion())->get_conexion();
$idusu = $_SESSION['idusu'] ?? null;
$carritoModel = new CarritoModel($conexion);

if (!$idusu) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents('php://input'), true);

    $idprod = isset($input['idprod']) ? intval($input['idprod']) : null;
    $cantidad = isset($input['cantidad']) ? intval($input['cantidad']) : 1;
    $vlrprod = isset($input['vlrprod']) ? floatval($input['vlrprod']) : 0;
    $accion = isset($input['acc']) ? trim($input['acc']) : null;

    if (!$idprod || $cantidad <= 0) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
        exit();
    }

    try {
        if ($accion === "eli") {
            $carritoModel->eliminarProducto($idusu, $idprod);
            echo json_encode(['success' => true, 'message' => 'Producto eliminado correctamente.']);
            exit();
        }

        if ($accion === "sum") {
            $result = $carritoModel->actualizarCantidad($idusu, $idprod, 1); // Sumar 1
            echo json_encode(['success' => $result, 'message' => 'Cantidad aumentada correctamente.']);
            exit();
        }

        if ($accion === "res") {
            $result = $carritoModel->actualizarCantidad($idusu, $idprod, -1); // Restar 1
            echo json_encode(['success' => $result, 'message' => 'Cantidad reducida correctamente.']);
            exit();
        }

        $result = $carritoModel->agregarProducto($idusu, $idprod, $cantidad, $vlrprod);

        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Producto añadido correctamente.' : 'Error al añadir el producto.'
        ]);
        exit();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit();
    }
} else {
    $dtCarrito = $carritoModel->obtenerCarrito($idusu);
    $dtValoresCarrito = $carritoModel->obtenerDetalleProductosFactura($idusu);
    $dtTotCarrito = $carritoModel->obtenerTotalesFactura($idusu);

    if (empty($dtCarrito)) {
        echo json_encode(['success' => false, 'message' => 'El carrito está vacío.']);
    }
}
?>