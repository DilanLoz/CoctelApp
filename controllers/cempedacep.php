<?php
require_once 'models/mempedproc.php';

class PedidoEstadoController {
    private $pedidoModel;

    public function __construct() {
        $this->pedidoModel = new PedidoModel();
    }

    public function actualizarEstado($idpedido, $passecret = null) {
        try {
            // Obtener estado actual y clave secreta del pedido
            $pedido = $this->pedidoModel->obtenerPedidoPorId($idpedido);

            if (!$pedido) {
                return ["success" => false, "message" => "Pedido no encontrado"];
            }

            $estadoActual = $pedido['estado'];
            $claveReal = $pedido['passecret'];

            // Determinar el nuevo estado
            if ($estadoActual === "En preparación") {
                $nuevoEstado = "En camino";
            } elseif ($estadoActual === "En camino") {
                if ($passecret === null) {
                    return ["success" => false, "require_password" => true];
                }
                if ($passecret !== $claveReal) {
                    return ["success" => false, "message" => "Clave incorrecta"];
                }
                $nuevoEstado = "Entregado";
            } else {
                return ["success" => false, "message" => "El pedido ya está entregado"];
            }

            // Actualizar el estado del pedido en la base de datos
            $this->pedidoModel->actualizarEstadoPedido($idpedido, $nuevoEstado);

            return ["success" => true, "estado" => $nuevoEstado];
        } catch (Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}

// Manejo de la solicitud AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idpedido = isset($_POST['idpedido']) ? $_POST['idpedido'] : null;
    $passecret = isset($_POST['passecret']) ? $_POST['passecret'] : null;

    if ($idpedido) {
        $pedidoController = new PedidoController();
        $response = $pedidoController->actualizarEstado($idpedido, $passecret);
        echo json_encode($response);
    } else {
        echo json_encode(["success" => false, "message" => "ID de pedido no válido"]);
    }
}
?>
