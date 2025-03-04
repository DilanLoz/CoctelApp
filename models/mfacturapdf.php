<?php
require_once 'conexion.php';

class Factura {
    private $idfact;
    private $idpedido;
    private $fecha;
    private $cantidad;
    private $total;
    private $idusu;
    private $direccion;
    private $estado_pago;
    private $metodo_pago;
    private $idemp;
    private $idbar;
    private $estado;
    
    private $iddetfact;
    private $idprod;
    private $precio_unitario;
    
    // Métodos Getter
    public function getIdfact() { return $this->idfact; }
    public function getIdpedido() { return $this->idpedido; }
    public function getFecha() { return $this->fecha; }
    public function getCantidad() { return $this->cantidad; }
    public function getTotal() { return $this->total; }
    public function getIdusu() { return $this->idusu; }
    public function getDireccion() { return $this->direccion; }
    public function getEstadoPago() { return $this->estado_pago; }
    public function getMetodoPago() { return $this->metodo_pago; }
    public function getIdemp() { return $this->idemp; }
    public function getIdbar() { return $this->idbar; }
    public function getEstado() { return $this->estado; }
    
    public function getIddetfact() { return $this->iddetfact; }
    public function getIdprod() { return $this->idprod; }
    public function getPrecioUnitario() { return $this->precio_unitario; }

    // Métodos Setter
    public function setIdfact($idfact) { $this->idfact = $idfact; }
    public function setIdpedido($idpedido) { $this->idpedido = $idpedido; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
    public function setCantidad($cantidad) { $this->cantidad = $cantidad; }
    public function setTotal($total) { $this->total = $total; }
    public function setIdusu($idusu) { $this->idusu = $idusu; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setEstadoPago($estado_pago) { $this->estado_pago = $estado_pago; }
    public function setMetodoPago($metodo_pago) { $this->metodo_pago = $metodo_pago; }
    public function setIdemp($idemp) { $this->idemp = $idemp; }
    public function setIdbar($idbar) { $this->idbar = $idbar; }
    public function setEstado($estado) { $this->estado = $estado; }

    public function setIddetfact($iddetfact) { $this->iddetfact = $iddetfact; }
    public function setIdprod($idprod) { $this->idprod = $idprod; }
    public function setPrecioUnitario($precio_unitario) { $this->precio_unitario = $precio_unitario; }

    // Obtener Factura y su Detalle
    public function getFacturaDetalle($idfact) {
        $sql = "SELECT 
                    f.idfact, f.fecha, f.total, f.metodo_pago, f.estado_pago,
                    u.nomusu AS usuario, e.nomemp AS empleado, b.nombar AS bar,
                    d.iddetfact, d.idfact, p.nomprod, d.cantidad, d.precio_unitario, d.total AS total_detalle
                FROM factura f
                INNER JOIN detfact d ON f.idfact = d.idfact
                INNER JOIN producto p ON d.idprod = p.idprod
                INNER JOIN usuario u ON f.idusu = u.idusu
                INNER JOIN empleado e ON f.idemp = e.idemp
                INNER JOIN bar b ON f.idbar = b.idbar
                WHERE f.idfact = :idfact";
        
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idfact", $idfact);
        $result->execute();
        
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
