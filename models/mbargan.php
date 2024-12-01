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
    
    // Obtener todos los bares
    public function getAll() {
        $res = NULL;
        $sql = "SELECT idfact, idpedido, fecha, idbar, total, idusu FROM factura";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    // Obtener un solo bar
    public function getOne() {
        $res = NULL;
        $sql = "SELECT * FROM factura WHERE idfact = :idfact";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idbar = $this->getIdbar();
        $result->bindParam(":idbar", $idbar);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    // Guardar un bar
    public function save() {
        $sql = "INSERT INTO factura (idfact, idpedido, fecha, idbar, total, idusu) 
                VALUES (:idfact, :idpedido, :fecha, :idbar, :total, :idusu)";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idfact = $this->getIdfact();
        $result->bindParam(":idfact", $idfact);
        $idpedido = $this->getIdpedido();
        $result->bindParam(":idpedido", $idpedido);
        $fecha = $this->getFecha();
        $result->bindParam(":fecha", $fecha);
        $idbar = $this->getidbar();
        $result->bindParam(":idbar", $idbar);
        $total = $this->getTotal();
        $result->bindParam(":total", $total);
        $idusu = $this->getIdusu();
        $result->bindParam(":idusu", $idusu);
        $result->execute();
    }

    // Editar un bar
    public function edit() {
        $sql = "UPDATE factura SET idpedido = :idpedido, fecha = :fecha, idbar = :idbar, total = :total, 
                idusu = :idusu WHERE idfact = :idfact";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idfact = $this->getIdfact();
        $result->bindParam(":idfact", $idfact);
        $idpedido = $this->getIdpedido();
        $result->bindParam(":idpedido", $idpedido);
        $fecha = $this->getFecha();
        $result->bindParam(":fecha", $fecha);
        $idbar = $this->getIdbar();
        $result->bindParam(":idbar", $idbar);
        $total = $this->getTotal();
        $result->bindParam(":total", $total);
        $idusu = $this->getidusu();
        $result->bindParam(":idusu", $idusu);
        $result->execute();
    }

    // Eliminar un bar
    public function del() {
        $sql = "DELETE FROM factura WHERE idfact = :idfact";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idfact = $this->getIdfact();
        $result->bindParam(":idfact", $idfact);
        $result->execute();
    }
     // Obtener facturas según el idusu de la sesión
     public function getBySessionId($idusu) {
        $res = NULL;
        $sql = "SELECT idfact, idpedido, fecha, idbar, total, idusu 
                FROM factura 
                WHERE idbar = :idusu OR idusu = :idusu"; // Corrige aquí
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
