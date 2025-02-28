<?php
class Mdetpedido {
    // Atributos
    private $iddetpedido;
    private $idpedido;
    private $idprod;
    private $cantidad;
    private $precio;
    private $total;
    private $idusu;
    private $idbar;

    // Métodos GET
    public function getIddetpedido() {
        return $this->iddetpedido;
    }
    public function getIdpedido() {
        return $this->idpedido;
    }
    public function getIdprod() {
        return $this->idprod;
    }
    public function getCantidad() {
        return $this->cantidad;
    }
    public function getPrecio() {
        return $this->precio;
    }
    public function getTotal() {
        return $this->total;
    }
    public function getIdusu() {
        return $this->idusu;
    }
    public function getIdbar() {
        return $this->idbar;
    }

    // Métodos SET
    public function setIddetpedido($iddetpedido) {
        $this->iddetpedido = $iddetpedido;
    }
    public function setIdpedido($idpedido) {
        $this->idpedido = $idpedido;
    }
    public function setIdprod($idprod) {
        $this->idprod = $idprod;
    }
    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
    public function setPrecio($precio) {
        $this->precio = $precio;
    }
    public function setTotal($total) {
        $this->total = $total;
    }
    public function setIdusu($idusu) {
        $this->idusu = $idusu;
    }
    public function setIdbar($idbar) {
        $this->idbar = $idbar;
    }
    public function getDetallesPedido($idpedido) {
        try {
            $sql = "SELECT dp.iddetpedido, dp.idpedido, dp.idprod, dp.cantidad, dp.precio, 
                           (dp.cantidad * dp.precio) AS total, dp.idusu, dp.idbar, 
                           p.nomprod AS nombre_producto, b.nombar 
                    FROM detpedido AS dp
                    INNER JOIN producto AS p ON dp.idprod = p.idprod
                    INNER JOIN bar AS b ON dp.idbar = b.idbar
                    WHERE dp.idpedido = :idpedido";
    
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":idpedido", $idpedido, PDO::PARAM_INT);
            $result->execute();
    
            $productos = $result->fetchAll(PDO::FETCH_ASSOC);
            return $productos;
        } catch (Exception $e) {
            echo "Error en SQL: " . $e->getMessage();
        }
    }
    
    
}
?>
