<?php
class Mgan {
    private $iddetfact;
    private $idfact;
    private $idprod;
    private $cantidad;
    private $precio_unitario;
    private $subtotal;
    private $idemp;
    private $idbar;

    // Getters
    public function getIddetfact() {
        return $this->iddetfact;
    }

    public function getIdfact() {
        return $this->idfact;
    }

    public function getIdprod() {
        return $this->idprod;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getPrecio_unitario() {
        return $this->precio_unitario;
    }

    public function getSubtotal() {
        return $this->subtotal;
    }

    public function getIdemp() {
        return $this->idemp;
    }

    public function getIdbar() {
        return $this->idbar;
    }

    // Setters
    public function setIddetfact($iddetfact) {
        $this->iddetfact = $iddetfact;
    }

    public function setIdfact($idfact) {
        $this->idfact = $idfact;
    }

    public function setIdprod($idprod) {
        $this->idprod = $idprod;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function setPrecio_unitario($precio_unitario) {
        $this->precio_unitario = $precio_unitario;
    }

    public function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }

    public function setIdemp($idemp) {
        $this->idemp = $idemp;
    }

    public function setIdbar($idbar) {
        $this->idbar = $idbar;
    }

    // Métodos
    public function getAll() {
        try {
            $sql = "SELECT d.iddetfact, d.idfact, d.idprod, b.nombar, d.cantidad, d.precio_unitario, d.subtotal, d.idemp, d.idbar FROM detfact AS d INNER JOIN bar AS b ON d.idbar=b.idbar";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>