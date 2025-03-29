<?php
class Memhipe {
    private $idpedido;
    private $iddetpedido;

    // Métodos GET
    public function getIdpedido() { 
        return $this->idpedido; }
    public function getIddetpedido() { 
        return $this->iddetpedido; }

    // Métodos SET
    public function setIdpedido($idpedido) {
        $this->idpedido = $idpedido; }
    public function setIddetpedido($iddetpedido) { 
        $this->iddetpedido = $iddetpedido; }

    // Consultas
    public function getAllpedidodt() {
        try {
            $sql = "SELECT p.idmetpago, p.fecha_pedido, p.estado, p.total, p.idusu, dt.idpedido, dt.idprod, dt.cantidad, dt.precio_unitario, dt.subtotal
                    FROM pedido AS p
                    INNER JOIN detpedido AS dt ON p.idpedido = dt.idpedido";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function getDtpedidos($iddetpedido) {
        try {
            $sql = "SELECT idpedido, idprod, cantidad, precio_unitario, subtotal, idusu 
                    FROM detpedido 
                    WHERE iddetpedido = :iddetpedido";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
    
            // Vincular el parámetro
            $result->bindParam(':iddetpedido', $iddetpedido, PDO::PARAM_INT);
    
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function getPedido($idpedido) {
        try {
            $sql = "SELECT idmetpago, fecha_pedido, estado, total, idusu
                    FROM pedido 
                    WHERE idpedido = :idpedido";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
    
            // Vincular el parámetro
            $result->bindParam(':idpedido', $idpedido, PDO::PARAM_INT);
    
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
}
?>
