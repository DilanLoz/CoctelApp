<?php
require_once 'conexion.php';
class Mempedproc {
    // Atributos
    private $idpedido;
    private $idcarrito;
    private $cantidad;
    private $fecha_pedido;
    private $estado;
    private $total;
    private $idusu;
    private $direccion;
    private $mensaje;
    private $idfactura;
    private $estado_pago;
    private $metodo_pago;
    private $estado_pedido;
    private $idemp;


    // Métodos GET
    public function getIdpedido() {
        return $this->idpedido;
    }
    public function getIdcarrito() {
        return $this->idcarrito;
    }
    public function getCantidad() {
        return $this->cantidad;
    }
    public function getFecha_pedido() {
        return $this->fecha_pedido;
    }
    public function getEstado() {
        return $this->estado;
    }
    public function getTotal() {
        return $this->total;
    }
    public function getIdusu() {
        return $this->idusu;
    }
    public function getDireccion() {
        return $this->direccion;
    }
    public function getIdfactura() {
        return $this->idfactura;
    }
    public function getEstado_pago() {
        return $this->estado_pago;
    }
    public function getMetodo_pago() {
        return $this->metodo_pago;
    }
    public function getEstado_pedido() {
        return $this->estado_pedido;
    }
    public function getIdemp() {
        return $this->idemp;
    }
    public function getMensaje() {
        return $this->mensaje;
    }

    // Métodos SET
    public function setIdpedido($idpedido) {
        $this->idpedido = $idpedido;
    }
    public function setIdcarrito($idcarrito) {
        $this->idcarrito = $idcarrito;
    }
    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
    public function setFecha_pedido($fecha_pedido) {
        $this->fecha_pedido = $fecha_pedido;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function setTotal($total) {
        $this->total = $total;
    }
    public function setIdusu($idusu) {
        $this->idusu = $idusu;
    }
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    public function setIdfactura($idfactura) {
        $this->idfactura = $idfactura;
    }
    public function setEstado_pago($estado_pago) {
        $this->estado_pago = $estado_pago;
    }
    public function setMetodo_pago($metodo_pago) {
        $this->metodo_pago = $metodo_pago;
    }
    public function setEstado_pedido($estado_pedido) {
        $this->estado_pedido = $estado_pedido;
    }
    public function setIdemp($idemp) {
        $this->idemp = $idemp;
    }
    public function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }
    // Método para obtener los pedidos en proceso (menos de 24 horas y no aceptados)
    public function getAll() {
        try {
            $sql = "SELECT p.idpedido, p.idcarrito, p.cantidad, p.fecha_pedido, p.estado, p.total, 
               p.idusu, p.direccion, p.idfactura, p.estado_pago, p.metodo_pago 
        FROM pedido AS p 
        WHERE p.estado_pedido = 1";
            
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function aceptarPedido($idpedido, $idemp) {
        try {
            $sql = "UPDATE pedido SET idemp = :idemp, estado_pedido = 2 WHERE idpedido = :idpedido AND estado_pedido = 1";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':idemp', $idemp, PDO::PARAM_INT);
            $stmt->bindParam(':idpedido', $idpedido, PDO::PARAM_INT);
    
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }
    
}
?>

