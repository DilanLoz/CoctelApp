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
    private $telefono;
    private $direccion;
    private $mensaje;
    private $idfactura;
    private $estado_pago;
    private $metodo_pago;
    private $estado_pedido;
    private $idemp;
    private $passecret;
    private $servicio;


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
    public function getTelefono() {
        return $this->telefono;
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
    public function getPassecret() {
        return $this->passecret;
    }
    public function getServicio() {
        return $this->servicio;
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
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
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
    public function setPassecret($passecret) {
        $this->passecret = $passecret;
    }
    public function setServicio($servicio) {
        $this->servicio = $servicio;
    }
    // Método para obtener los pedidos en proceso (menos de 24 horas y no aceptados)
    public function getAll() {
        try {
            $sql = "SELECT p.idpedido, p.idcarrito, p.cantidad, p.fecha_pedido, p.estado, p.total, 
               p.idusu, p.direccion, p.estado_pago, p.metodo_pago, p.estado_pedido, p.telefono, p.servicio
        FROM pedido AS p 
        WHERE p.estado_pedido = 1
        ORDER BY p.idpedido DESC";
            
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
    public function actualizarEstadoPago($idpedido) {
    try {
        // Actualizamos tanto estado_pago a 'Pagado' como estado a 'Entregado' al mismo tiempo
        $sql = "UPDATE pedido SET estado_pago = 'Pagado', estado = 'Entregado' WHERE idpedido = :idpedido";
        
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':idpedido', $idpedido, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            $errorInfo = $stmt->errorInfo(); // Obtener detalles del error
            file_put_contents('debug.log', "Error en SQL: " . implode(" | ", $errorInfo) . "\n", FILE_APPEND);
            return false;
        }

        file_put_contents('debug.log', "Consulta ejecutada correctamente para pedido $idpedido\n", FILE_APPEND);
        return true;
    } catch (Exception $e) {
        file_put_contents('debug.log', "Excepción SQL: " . $e->getMessage() . "\n", FILE_APPEND);
        return false;
    }
}

    
    
}
?>

