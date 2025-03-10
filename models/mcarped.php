<?php
require_once 'models/conexion.php';

class MPedido
{
    private $idcarrito;
    private $idusu;
    private $iddetcarrito;
    private $estado;
    private $direccion;
    private $telefono;
    private $mensaje;
    private $metodo_pago;

    public function getIdcarrito()
    {
        return $this->idcarrito;
    }

    public function getIdusu()
    {
        return $this->idusu;
    }
    public function getIddetcarrito()
    {
        return $this->iddetcarrito;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function getMensaje()
    {
        return $this->mensaje;
    }
    public function getMetodoPago()
    {
        return $this->metodo_pago;
    }
    //set
    public function setIdcarrito($idcarrito) {
        $this->idcarrito = $idcarrito;
    }
    public function setIdusu($idusu) {
        $this->idusu = $idusu;
    }
    public function setIddetcarrito($iddetcarrito) {
        $this->iddetcarrito = $iddetcarrito;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    public function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }
    public function setMetodoPago($metodo_pago) {
        $this->metodo_pago = $metodo_pago;
    }
    //metodos
    public function convertirCarrito($idCarrito)
    {
        try {
            $sql = "UPDATE carrito SET estado = 'convertido' WHERE idcarrito = :idcarrito";
            $conexion = (new Conexion())->get_conexion();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':idcarrito', $idCarrito, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            file_put_contents('debug.log', "Error al convertir carrito: " . $e->getMessage() . "\n", FILE_APPEND);
            return false;
        }
    }

    public function insertarPedido($datos)
    {
        try {
            $sql = "INSERT INTO pedido (idusu, direccion, telefono, mensaje, metodo_pago) 
                    VALUES (:idusu, :direccion, :telefono, :mensaje, :metodo_pago)";

            $conexion = (new Conexion())->get_conexion();
            $stmt = $conexion->prepare($sql);
            $stmt->execute($datos);

            return $conexion->lastInsertId();
        } catch (Exception $e) {
            file_put_contents('debug.log', "Error al insertar pedido: " . $e->getMessage() . "\n", FILE_APPEND);
            return false;
        }
    }
}
