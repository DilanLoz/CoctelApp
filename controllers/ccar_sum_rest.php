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

// ✅ Nueva funcionalidad: Obtener los totales sin recargar la página
if (isset($_GET['totales'])) {
    header('Content-Type: application/json');

    sleep(1); // 👈 Prueba agregando un pequeño retraso

    $dtValoresCarrito = $carritoModel->obtenerDetalleProductosFactura($idusu);
    $dtTotCarrito = $carritoModel->obtenerTotalesFactura($idusu);

    echo json_encode([
        'success' => true,
        'valor_productos' => number_format($dtValoresCarrito['total'] ?? 0, 2),
        'total_productos' => number_format($dtTotCarrito['total'] ?? 0, 2),
    ]);
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents('php://input'), true);

    $idprod = $input['idprod'] ?? null;
    $accion = $input['acc'] ?? null;

    if (!$idprod) {
        echo json_encode(['success' => false, 'message' => 'ID de producto inválido.']);
        exit();
    }

    try {
        switch ($accion) {
            case "eli":
                $carritoModel->eliminarProducto($idusu, $idprod);
                echo json_encode(['success' => true, 'message' => 'Producto eliminado correctamente.']);
                break;

                case "sum":
                    $result = $carritoModel->actualizarCantidad($idusu, $idprod, 1);
                    $conexion->query("COMMIT"); // 👈 Asegura que la transacción se complete
                    echo json_encode(['success' => $result, 'message' => 'Cantidad aumentada.']);
                    break;
                
                case "res":
                    $result = $carritoModel->actualizarCantidad($idusu, $idprod, -1);
                    $conexion->query("COMMIT"); // 👈 Asegura que la transacción se complete
                    echo json_encode(['success' => $result, 'message' => 'Cantidad reducida.']);
                    break;
                

            default:
                echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit();
}

// Obtener carrito para la vista
$dtCarrito = $carritoModel->obtenerCarrito($idusu);
$dtValoresCarrito = $carritoModel->obtenerDetalleProductosFactura($idusu);
$dtTotCarrito = $carritoModel->obtenerTotalesFactura($idusu);
?>