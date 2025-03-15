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
    $_SESSION['error'] = "Usuario no autenticado.";
    header("Location: views/vuscarcom.php"); // Redirige a la vista
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $idprod = isset($input['idprod']) ? intval($input['idprod']) : null;
    $cantidad = isset($input['cantidad']) ? intval($input['cantidad']) : 1;
    $vlrprod = isset($input['vlrprod']) ? floatval($input['vlrprod']) : 0;
    $accion = isset($input['acc']) ? trim($input['acc']) : null;

    if (!$idprod || $cantidad <= 0) {
        $_SESSION['error'] = "Datos inválidos.";
        header("Location: views/vuscarcom.php");
        exit();
    }

    try {
        if ($accion === "eli") {
            $carritoModel->eliminarProducto($idusu, $idprod);
            $_SESSION['mensaje'] = "Producto eliminado correctamente.";
            header("Location: views/vuscarcom.php");
            exit();
        }

        if ($accion === "sum") {
            $carritoModel->actualizarCantidad($idusu, $idprod, 1);
            $_SESSION['mensaje'] = "Cantidad aumentada correctamente.";
            header("Location: views/vuscarcom.php");
            exit();
        }

        if ($accion === "res") {
            $carritoModel->actualizarCantidad($idusu, $idprod, -1);
            $_SESSION['mensaje'] = "Cantidad reducida correctamente.";
            header("Location: views/vuscarcom.php");
            exit();
        }

        $result = $carritoModel->agregarProducto($idusu, $idprod, $cantidad, $vlrprod);
        $_SESSION['mensaje'] = $result ? "Producto añadido correctamente." : "Error al añadir el producto.";
        header("Location: views/vuscarcom.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: views/vuscarcom.php");
        exit();
    }
}

// Cargar los datos para la vista
$_SESSION['carrito'] = $carritoModel->obtenerCarrito($idusu);
$_SESSION['valoresCarrito'] = $carritoModel->obtenerDetalleProductosFactura($idusu);
$_SESSION['totCarrito'] = $carritoModel->obtenerTotalesFactura($idusu);

?>