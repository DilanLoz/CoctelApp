<?php
require_once 'conexion.php';

class MPedido {
    private $idUsu;
    private $direccion;
    private $mensaje;
    private $telefono;
    private $metodoPago;
    private $idCarrito;
    private $servicio; // Nueva propiedad

    public function setIdUsu($idUsu) { $this->idUsu = $idUsu; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setMensaje($mensaje) { $this->mensaje = $mensaje; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setMetodoPago($metodoPago) { $this->metodoPago = $metodoPago; }
    public function setServicio($servicio) { $this->servicio = $servicio; } // Nuevo setter

    public function getIdCarrito() { return $this->idCarrito; }
    public function getServicio() { return $this->servicio; } // Nuevo getter

    public function saveCarrito() {
        try {
            $pdo = (new Conexion())->get_conexion();
            
            // Buscar carrito activo
            $idCarritoExistente = $this->obtenerCarritoActivo($this->idUsu);
    
            if ($idCarritoExistente) {
                // Si ya hay un carrito, lo actualizamos
                $sql = "UPDATE carrito SET direccion = :direccion, mensaje = :mensaje, telefono = :telefono, metodo_pago = :metodo_pago, servicio = :servicio WHERE idcarrito = :idcarrito";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':direccion' => $this->direccion,
                    ':mensaje' => $this->mensaje,
                    ':telefono' => $this->telefono,
                    ':metodo_pago' => $this->metodoPago,
                    ':servicio' => $this->servicio,
                    ':idcarrito' => $idCarritoExistente
                ]);
                $this->idCarrito = $idCarritoExistente;
            } else {
                // Si no hay carrito, creamos uno nuevo
                $sql = "INSERT INTO carrito (idusu, direccion, mensaje, telefono, metodo_pago, servicio, estado) 
                        VALUES (:idusu, :direccion, :mensaje, :telefono, :metodo_pago, :servicio, 'pendiente')";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':idusu' => $this->idUsu,
                    ':direccion' => $this->direccion,
                    ':mensaje' => $this->mensaje,
                    ':telefono' => $this->telefono,
                    ':metodo_pago' => $this->metodoPago,
                    ':servicio' => $this->servicio
                ]);
                $this->idCarrito = $pdo->lastInsertId();
            }
    
            return true;
        } catch (Exception $e) {
            return "Error en BD: " . $e->getMessage();
        }
    }
    

    public function actualizarCarrito($idCarrito) {
        try {
            $pdo = (new Conexion())->get_conexion();
            $sql = "UPDATE carrito SET estado = 'convertido' WHERE idcarrito = :idcarrito";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':idcarrito' => $idCarrito]);
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    public function obtenerCarritoActivo($idUsu) {
        try {
            $pdo = (new Conexion())->get_conexion();
            $sql = "SELECT idcarrito FROM carrito WHERE idusu = :idusu AND estado = 'activo' LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':idusu' => $idUsu]);
            $carrito = $stmt->fetch(PDO::FETCH_ASSOC);
            return $carrito ? $carrito['idcarrito'] : null;
        } catch (Exception $e) {
            return null;
        }
    }
}
?>
