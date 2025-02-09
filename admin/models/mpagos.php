<?php
class Mdetfact {
    private $idfact;
    private $idpedido;
    private $fecha;
    private $total;
    private $idbar;
    private $estado;
    private $idusu;

    // Métodos GET
    public function getIdfact() { return $this->idfact; }
    public function getIdpedido() { return $this->idpedido; }
    public function getFecha() { return $this->fecha; }
    public function getTotal() { return $this->total; }
    public function getIdbar() { return $this->idbar; }
    public function getEstado() { return $this->estado; }
    public function getIdusu() { return $this->idusu; }

    // Métodos SET
    public function setIdfact($idfact) { $this->idfact = $idfact; }
    public function setIdpedido($idpedido) { $this->idpedido = $idpedido; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
    public function setTotal($total) { $this->total = $total; }
    public function setIdbar($idbar) { $this->idbar = $idbar; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setIdusu($idusu) { $this->idusu = $idusu; }

    // Obtener todos los registros
    public function getAll() {
        $sql = "SELECT 
                    f.idfact, 
                    f.idpedido, 
                    f.fecha, 
                    f.total, 
                    f.estado,
                    f.idbar,
                    f.idusu,
                    b.nombar, 
                    u.nomusu
                FROM factura f
                LEFT JOIN bar b ON f.idbar = b.idbar
                LEFT JOIN usuario u ON f.idusu = u.idusu";

        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un solo registro por ID
    public function getOne() {
        $sql = "SELECT idfact, idpedido, fecha, total, idbar, estado, idusu FROM factura WHERE idfact = :idfact";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idfact = $this->getIdfact();
        $result->bindParam(":idfact", $idfact);
        $result->execute();
        $res = $result->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
}
?>
