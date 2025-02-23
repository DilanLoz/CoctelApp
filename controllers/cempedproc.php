<?php
require_once 'models/Mempedproc.php'; // Importa el modelo

class PedidoController {
    public function listarPedidos() {
        $pedidoModel = new Mempedproc();
        $pedidos = $pedidoModel->getAll(); // Obtiene los pedidos en proceso
        return $pedidos;
    }
}
?>
