<?php
require_once 'conexion.php';

class Mushipe {
    private $idpedido;
    private $idcarrito;
    private $cantidad;
    private $fecha_pedido;
    private $estado;
    private $total;
    private $idusu;
    private $direccion;
    private $mensaje;
    private $estado_pago;
    private $metodo_pago;
    private $estado_pedido;
    private $idemp;
    private $servicio; // Se agregó el atributo servicio

    private $iddetpedido;
    private $idprod;
    private $precio;
    private $idbar;

    // Métodos Getter
    public function getServicio() { return $this->servicio; }
    public function getIdpedido() { return $this->idpedido; }
    public function getIdcarrito() { return $this->idcarrito; }
    public function getCantidad() { return $this->cantidad; }
    public function getFechaPedido() { return $this->fecha_pedido; }
    public function getEstado() { return $this->estado; }
    public function getTotal() { return $this->total; }
    public function getIdusu() { return $this->idusu; }
    public function getDireccion() { return $this->direccion; }
    public function getMensaje() { return $this->mensaje; }
    public function getEstadoPago() { return $this->estado_pago; }
    public function getMetodoPago() { return $this->metodo_pago; }
    public function getEstadoPedido() { return $this->estado_pedido; }
    public function getIdemp() { return $this->idemp; }
    public function getIddetpedido() { return $this->iddetpedido; }
    public function getIdprod() { return $this->idprod; }
    public function getPrecio() { return $this->precio; }
    public function getIdbar() { return $this->idbar; }

    // Métodos Setter
    public function setServicio($servicio) { $this->servicio = $servicio; }
    public function setIdpedido($idpedido) { $this->idpedido = $idpedido; }
    public function setIdcarrito($idcarrito) { $this->idcarrito = $idcarrito; }
    public function setCantidad($cantidad) { $this->cantidad = $cantidad; }
    public function setFechaPedido($fecha_pedido) { $this->fecha_pedido = $fecha_pedido; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setTotal($total) { $this->total = $total; }
    public function setIdusu($idusu) { $this->idusu = $idusu; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setMensaje($mensaje) { $this->mensaje = $mensaje; }
    public function setEstadoPago($estado_pago) { $this->estado_pago = $estado_pago; }
    public function setMetodoPago($metodo_pago) { $this->metodo_pago = $metodo_pago; }
    public function setEstadoPedido($estado_pedido) { $this->estado_pedido = $estado_pedido; }
    public function setIdemp($idemp) { $this->idemp = $idemp; }
    public function setIddetpedido($iddetpedido) { $this->iddetpedido = $iddetpedido; }
    public function setIdprod($idprod) { $this->idprod = $idprod; }
    public function setPrecio($precio) { $this->precio = $precio; }
    public function setIdbar($idbar) { $this->idbar = $idbar; }

    // Obtener Pedido y su Detalle
    public function getPedidoDetalle($idusu) {
        $sql = "SELECT 
                    p.idpedido, 
                    p.cantidad, 
                    p.fecha_pedido, 
                    p.estado_pedido, 
                    p.total, 
                    COALESCE(e.nomemp, 'Pendiente') AS nomemp,
                    COALESCE(e.celemp, 'No disponible') AS celemp,
                    COALESCE(e.fotiden, 'default.jpg') AS fotiden,
                    p.direccion, 
                    p.mensaje, 
                    p.metodo_pago,
                    p.estado, 
                    p.estado_pago,
                    p.servicio
                FROM pedido p
                LEFT JOIN empleado e ON p.idemp = e.idemp
                WHERE p.idusu = :idusu
                ORDER BY p.idpedido DESC";  
    
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $idusu, PDO::PARAM_INT);
        $result->execute();
    
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }    
    
    public function getDetallesPorPedido($idpedido) {
        $sql = "SELECT 
                    dp.iddetpedido, 
                    p.nomprod, 
                    p.fotprod, -- Agregado para obtener la imagen del producto
                    dp.cantidad, 
                    dp.precio, 
                    COALESCE(b.telbar, 'No hay número telefónico') AS telbar,
                    COALESCE(b.nombar, 'No asignado') AS nombar,
                    pd.direccion, 
                    pd.mensaje, 
                    pd.metodo_pago, 
                    pd.estado_pago
                FROM detpedido dp
                INNER JOIN producto p ON dp.idprod = p.idprod
                LEFT JOIN bar b ON dp.idbar = b.idbar
                INNER JOIN pedido pd ON dp.idpedido = pd.idpedido
                WHERE dp.idpedido = :idpedido
                ORDER BY dp.iddetpedido DESC";
    
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idpedido", $idpedido, PDO::PARAM_INT);
        $result->execute();
    
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>