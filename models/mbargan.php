<?php
class Mbargan {
    private $idfact;
    private $idpedido;
    private $fecha;
    private $idbar;
    private $total;
    private $idusu;


    // Métodos getter y setter
    public function getIdfact() {
        return $this->idfact;
    }
    public function getIdpedido() {
        return $this->idpedido;
    }
    public function getFecha() {
        return $this->fecha;
    }
    public function getIdbar() {
        return $this->idbar;
    }
    public function getTotal() {
        return $this->total;
    }
    public function getIdusu() {
        return $this->idusu;
    }
    

    // Métodos setter
    public function setIdfact($idfact) {
        $this->idfact = $idfact;
    }
    public function setIdpedido($idpedido) {
        $this->idpedido = $idpedido;
    }
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    public function setIdbar($idbar) {
        $this->idbar = $idbar;
    }
    public function setTotal($total) {
        $this->total = $total;
    }
    public function setIdusu($idusu) {
        $this->idusu = $idusu;
    }



     // Obtener facturas según el idusu de la sesión
     public function getBySessionId($idusu) {
        $res = NULL;
        $sql = "SELECT idfact, idpedido, fecha, idbar, idemp, total, idusu 
                FROM factura 
                WHERE idbar = :idusu OR idusu = :idusu OR idemp = :idusu"; // Agregamos idemp
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $idusu);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    
    
}
?>
