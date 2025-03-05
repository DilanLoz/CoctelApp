<?php
require_once 'models/mempedproc.php';

class PedidoController {
    private $pedidoModel;

    public function __construct() {
        $this->pedidoModel = new Mempedproc();
    }

    public function listarPedidosPorEmpleado($idemp) {
        return $this->pedidoModel->getPedidosPorEmpleado($idemp);
    }

    public function actualizarEstadoPedido($idpedido, $nuevoEstado) {
        return $this->pedidoModel->actualizarEstadoPedido($idpedido, $nuevoEstado);
    }

    public function confirmarEntrega($idpedido, $claveIngresada) {
        $claveReal = $this->pedidoModel->obtenerClaveSecreta($idpedido);

        if ($claveReal === null) {
            return ["error" => "No se encontró la clave secreta para este pedido."];
        }

        if ($claveReal !== $claveIngresada) {
            return ["error" => "Clave secreta incorrecta."];
        }

        if ($this->pedidoModel->actualizarEstadoPedido($idpedido, 3)) {
            return ["success" => "Pedido entregado exitosamente."];
        } else {
            return ["error" => "Error al actualizar el estado del pedido."];
        }
    }
}
?>
