<?php
require_once 'models/mempedgrand.php';
require_once 'models/mempedproc.php';

class Cdetpedido {
    public function listarPedidosBar() {
        $idbar = $_SESSION['idusu']; // ID del usuario en sesión (que es el mismo que idbar)
        
        $detalleModel = new Mdetpedido();
        $pedidos = $detalleModel->getPedidosPorBar($idbar);

        return $pedidos;
    }
}
?>
