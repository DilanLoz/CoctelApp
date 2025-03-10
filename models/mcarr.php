<?php
// Modelo ajustado

class CarritoModel
{
    private $idusu; // ID del usuario
    private $conexion; // Conexión a la base de datos

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getIdusu()
    {
        return $this->idusu;
    }

    public function obtenerCarrito($idusu)
    {
        $res = "";
        $sql = "SELECT 
                    c.idcarrito, 
                    c.idusu, 
                    dc.iddetcarrito, 
                    dc.idcarrito, 
                    dc.idprod, 
                    dc.cantidad, 
                    dc.precar, 
                    p.nomprod, 
                    p.vlrprod,
                    p.fotprod,
                    p.mililitros,
                    b.nombar,
                    c.estado
                FROM carrito AS c
                INNER JOIN detcarrito AS dc ON dc.idcarrito = c.idcarrito
                INNER JOIN producto AS p ON dc.idprod = p.idprod
                INNER JOIN bar AS b ON b.idbar = p.idbar
                WHERE c.idusu = :idusu 
                AND c.idcarrito = (
                    SELECT idcarrito FROM carrito 
                    WHERE idusu = :idusu 
                    AND estado != 'convertido' 
                    ORDER BY idcarrito DESC 
                    LIMIT 1
                )";
    
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':idusu', $idusu, PDO::PARAM_INT);
        $stmt->execute();
    
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    



    public function agregarProducto($idusu, $idprod, $cantidad, $precar, $idcarrito = null)
{
    try {
        $this->conexion->beginTransaction(); // Iniciar transacción

        if (!$idusu) {
            $idusu = $_SESSION['idusu'];
        }

        // 1️⃣ Obtener el último carrito activo del usuario
        if (!$idcarrito) {
            $sqlCarrito = "SELECT idcarrito FROM carrito WHERE idusu = :idusu AND estado = 'activo' ORDER BY idcarrito DESC LIMIT 1";
            $stmtCarrito = $this->conexion->prepare($sqlCarrito);
            $stmtCarrito->bindParam(':idusu', $idusu, PDO::PARAM_INT);
            $stmtCarrito->execute();
            $carrito = $stmtCarrito->fetch(PDO::FETCH_ASSOC);

            if (!$carrito) {
                // 2️⃣ Si no tiene carrito, crearlo
                $sqlCrearCarrito = "INSERT INTO carrito (idusu, fecha_creacion, estado) VALUES (:idusu, CURDATE(), 'activo')";
                $stmtCrearCarrito = $this->conexion->prepare($sqlCrearCarrito);
                $stmtCrearCarrito->bindParam(':idusu', $idusu, PDO::PARAM_INT);
                $stmtCrearCarrito->execute();
                $idcarrito = $this->conexion->lastInsertId();
            } else {
                $idcarrito = $carrito['idcarrito'];
            }
        }

        // 3️⃣ Verificar si el producto ya está en el carrito
        $sqlCheck = "SELECT cantidad FROM detcarrito WHERE idcarrito = :idcarrito AND idprod = :idprod";
        $stmtCheck = $this->conexion->prepare($sqlCheck);
        $stmtCheck->bindParam(':idcarrito', $idcarrito, PDO::PARAM_INT);
        $stmtCheck->bindParam(':idprod', $idprod, PDO::PARAM_INT);
        $stmtCheck->execute();
        $productoExistente = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($productoExistente) {
            // 4️⃣ Si el producto ya está en el carrito, actualizar la cantidad
            $sqlUpdate = "UPDATE detcarrito SET cantidad = cantidad + :cantidad WHERE idcarrito = :idcarrito AND idprod = :idprod";
            $stmtUpdate = $this->conexion->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $stmtUpdate->bindParam(':idcarrito', $idcarrito, PDO::PARAM_INT);
            $stmtUpdate->bindParam(':idprod', $idprod, PDO::PARAM_INT);
            $stmtUpdate->execute();
        } else {
            // 5️⃣ Si no está en el carrito, insertarlo
            $sqlInsert = "INSERT INTO detcarrito (idcarrito, idprod, cantidad, precar) VALUES (:idcarrito, :idprod, :cantidad, :precar)";
            $stmtInsert = $this->conexion->prepare($sqlInsert);
            $stmtInsert->bindParam(':idcarrito', $idcarrito, PDO::PARAM_INT);
            $stmtInsert->bindParam(':idprod', $idprod, PDO::PARAM_INT);
            $stmtInsert->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $stmtInsert->bindParam(':precar', $precar, PDO::PARAM_STR); // Asegurar que precar es string
            $stmtInsert->execute();
        }

        $this->conexion->commit(); // Confirmar transacción
        return true;
    } catch (Exception $e) {
        $this->conexion->rollBack(); // Revertir en caso de error
        return false;
    }
}


        // 3️⃣ Insertar el producto en detcarrito o actualizar cantidad si ya
        public function eliminarProducto($idusu, $idprod)
{
    try {
        $this->conexion->beginTransaction(); // Iniciar transacción

        // 1️⃣ Obtener el último carrito activo del usuario
        $sqlCarrito = "SELECT idcarrito FROM carrito WHERE idusu = :idusu AND estado = 'activo' ORDER BY idcarrito DESC LIMIT 1";
        $stmtCarrito = $this->conexion->prepare($sqlCarrito);
        $stmtCarrito->bindParam(':idusu', $idusu, PDO::PARAM_INT);
        $stmtCarrito->execute();
        $carrito = $stmtCarrito->fetch(PDO::FETCH_ASSOC);

        if (!$carrito) {
            throw new Exception("El usuario no tiene un carrito activo.");
        }

        $idcarrito = $carrito['idcarrito'];

        // 2️⃣ Eliminar el producto del carrito
        $sqlEliminar = "DELETE FROM detcarrito WHERE idcarrito = :idcarrito AND idprod = :idprod";
        $stmtEliminar = $this->conexion->prepare($sqlEliminar);
        $stmtEliminar->bindParam(':idcarrito', $idcarrito, PDO::PARAM_INT);
        $stmtEliminar->bindParam(':idprod', $idprod, PDO::PARAM_INT);
        $stmtEliminar->execute();

        // 3️⃣ Verificar si el carrito quedó vacío
        $sqlCheckCarrito = "SELECT COUNT(*) as total FROM detcarrito WHERE idcarrito = :idcarrito";
        $stmtCheckCarrito = $this->conexion->prepare($sqlCheckCarrito);
        $stmtCheckCarrito->bindParam(':idcarrito', $idcarrito, PDO::PARAM_INT);
        $stmtCheckCarrito->execute();
        $resultado = $stmtCheckCarrito->fetch(PDO::FETCH_ASSOC);

        if ($resultado['total'] == 0) {
            // Si el carrito quedó vacío, eliminarlo
            $sqlEliminarCarrito = "DELETE FROM carrito WHERE idcarrito = :idcarrito";
            $stmtEliminarCarrito = $this->conexion->prepare($sqlEliminarCarrito);
            $stmtEliminarCarrito->bindParam(':idcarrito', $idcarrito, PDO::PARAM_INT);
            $stmtEliminarCarrito->execute();
        }

        $this->conexion->commit(); // Confirmar transacción
        return true;
    } catch (Exception $e) {
        $this->conexion->rollBack(); // Revertir transacción si hay error
        return false;
    }
}
public function actualizarCantidad($idusu, $idprod, $cantidad)
{
    try {
        $this->conexion->beginTransaction();

        // Obtener carrito activo
        $sqlCarrito = "SELECT idcarrito FROM carrito WHERE idusu = :idusu AND estado = 'activo' ORDER BY idcarrito DESC LIMIT 1";
        $stmtCarrito = $this->conexion->prepare($sqlCarrito);
        $stmtCarrito->bindParam(':idusu', $idusu, PDO::PARAM_INT);
        $stmtCarrito->execute();
        $carrito = $stmtCarrito->fetch(PDO::FETCH_ASSOC);

        if (!$carrito) {
            throw new Exception("No se encontró un carrito activo.");
        }

        $idcarrito = $carrito['idcarrito'];

        // Verificar cantidad actual
        $sqlCantidad = "SELECT cantidad FROM detcarrito WHERE idcarrito = :idcarrito AND idprod = :idprod";
        $stmtCantidad = $this->conexion->prepare($sqlCantidad);
        $stmtCantidad->bindParam(':idcarrito', $idcarrito, PDO::PARAM_INT);
        $stmtCantidad->bindParam(':idprod', $idprod, PDO::PARAM_INT);
        $stmtCantidad->execute();
        $producto = $stmtCantidad->fetch(PDO::FETCH_ASSOC);

        if (!$producto) {
            throw new Exception("Producto no encontrado en el carrito.");
        }

        $nuevaCantidad = $producto['cantidad'] + $cantidad;
        if ($nuevaCantidad <= 0) {
            return $this->eliminarProducto($idusu, $idprod);
        }

        // Actualizar cantidad
        $sqlUpdate = "UPDATE detcarrito SET cantidad = :cantidad WHERE idcarrito = :idcarrito AND idprod = :idprod";
        $stmtUpdate = $this->conexion->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':cantidad', $nuevaCantidad, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':idcarrito', $idcarrito, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':idprod', $idprod, PDO::PARAM_INT);
        $stmtUpdate->execute();

        $this->conexion->commit();
        return true;
    } catch (Exception $e) {
        $this->conexion->rollBack();
        return false;
    }
}





    public function limpiarCarrito($idusu)
    {
            // Obtener el ID del carrito del usuario
            $sqlCarrito = "SELECT idcarrito FROM carrito WHERE idusu = :idusu";
            $stmtCarrito = $this->conexion->prepare($sqlCarrito);
            $stmtCarrito->bindParam(':idusu', $idusu, PDO::PARAM_INT);
            $stmtCarrito->execute();
            $carrito = $stmtCarrito->fetch(PDO::FETCH_ASSOC);

            if ($carrito) {
                $idcarrito = $carrito['idcarrito'];

                // Eliminar los productos del detalle del carrito
                $sqlEliminar = "DELETE FROM detcarrito WHERE idcarrito = :idcarrito";
                $stmtEliminar = $this->conexion->prepare($sqlEliminar);
                $stmtEliminar->bindParam(':idcarrito', $idcarrito, PDO::PARAM_INT);
                $stmtEliminar->execute();
            }

            return true;
    }
    public function obtenerDetalleProductosFactura($idusu)
    {
        $sql = "SELECT 
                    SUM(dc.cantidad * dc.precar) AS valor_productos,
                    dc.idprod,
                    dc.precar,
                    p.nomprod, 
                    dc.cantidad, 
                    p.vlrprod
                FROM detcarrito AS dc
                INNER JOIN producto AS p ON dc.idprod = p.idprod
                WHERE dc.idcarrito = (
                    SELECT idcarrito FROM carrito 
                    WHERE idusu = :idusu 
                    AND estado = 'activo' 
                    ORDER BY idcarrito DESC 
                    LIMIT 1
                )";
    
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":idusu", $idusu, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $res;
    }
    public function obtenerTotalesFactura($idusu)
    {
        $sql = "SELECT 
                    SUM(dc.cantidad * dc.precar) AS total_productos
                FROM detcarrito AS dc
                WHERE dc.idcarrito = (
                    SELECT idcarrito FROM carrito 
                    WHERE idusu = :idusu 
                    AND estado = 'activo' 
                    ORDER BY idcarrito DESC 
                    LIMIT 1
                )";
    
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":idusu", $idusu, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$res || $res['total_productos'] === null) {
            $res['total_productos'] = 0; // Evita errores en la vista
        }
    
        return $res;
    }
        

}
?>
