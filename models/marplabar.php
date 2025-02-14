<?php
class Marplabar {
    private $idfact;
    private $idpedido;
    private $fecha;
    private $idbar;
    private $total;
    private $idusu;
    private $estado;

    // Métodos getter
    public function getIdfact() { return $this->idfact; }
    public function getIdpedido() { return $this->idpedido; }
    public function getFecha() { return $this->fecha; }
    public function getIdbar() { return $this->idbar; }
    public function getTotal() { return $this->total; }
    public function getIdusu() { return $this->idusu; }
    public function getEstado() { return $this->estado; }

    // Métodos setter
    public function setIdfact($idfact) { $this->idfact = $idfact; }
    public function setIdpedido($idpedido) { $this->idpedido = $idpedido; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
    public function setIdbar($idbar) { $this->idbar = $idbar; }
    public function setTotal($total) { $this->total = $total; }
    public function setIdusu($idusu) { $this->idusu = $idusu; }
    public function setEstado($estado) { $this->estado = $estado; }

    // Obtener información del usuario
    public function getInfousu() {
        $sql = "SELECT f.idfact, u.idusu, u.numdocu, u.nomusu FROM factura AS f 
                INNER JOIN usuario AS u ON f.idusu = u.idusu";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener facturas activas del usuario
    public function getByIdBar($idbar) {
        $sql = "SELECT idfact, fecha, total 
                FROM factura 
                WHERE idbar = :idbar 
                  AND estado = 'activo'";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idbar", $idbar, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Sumar total de las facturas activas del usuario
    public function sumarTotalByIdBar($idbar) {
        $sql = "SELECT SUM(total) AS total_suma 
                FROM factura 
                WHERE idbar = :idbar 
                  AND estado = 'activo'";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idbar", $idbar, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['total_suma'] ?? 0;
    }
}
?>
    