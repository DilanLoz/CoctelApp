<?php
require_once 'models/mempedproc.php';

class PedidoController {
    public function listarPedidos() {
        $pedidoModel = new Mempedproc();
        return $pedidoModel->getAll();
    }
}
?>