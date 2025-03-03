<?php
class Mbargan {

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
    
        // Métodos getter
        public function getIdfact() {
            return $this->idfact;
        }
        public function getIdpedido() {
            return $this->idpedido;
        }
        public function getFecha() {
            return $this->fecha;
        }
        public function getCantidad() {
            return $this->cantidad;
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
        public function getEstadoPago() {
            return $this->estado_pago;
        }
        public function getMetodoPago() {
            return $this->metodo_pago;
        }
        public function getIdemp() {
            return $this->idemp;
        }
        public function getIdbar() {
            return $this->idbar;
        }
        public function getEstado() {
            return $this->estado;
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
        public function setCantidad($cantidad) {
            $this->cantidad = $cantidad;
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
        public function setEstadoPago($estado_pago) {
            $this->estado_pago = $estado_pago;
        }
        public function setMetodoPago($metodo_pago) {
            $this->metodo_pago = $metodo_pago;
        }
        public function setIdemp($idemp) {
            $this->idemp = $idemp;
        }
        public function setIdbar($idbar) {
            $this->idbar = $idbar;
        }
        public function setEstado($estado) {
            $this->estado = $estado;
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
    public function getHistorialPedidos($idusu) {
        $res = NULL;
        $sql = "SELECT idfact, idpedido, fecha, cantidad, total, idusu, direccion, estado_pago, metodo_pago, idemp, idbar, estado 
                FROM factura 
                WHERE idbar = :idusu OR idusu = :idusu OR idemp = :idusu";
    
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
