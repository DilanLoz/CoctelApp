<?php
require_once 'models/mempedgrand.php';

class Cdetpedido {
    public function listarDetallesPedido($idpedido) {
        $detalleModel = new Mdetpedido();
        return $detalleModel->getDetallesPedido($idpedido);
    }
}
?>