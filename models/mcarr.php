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

        // Si no se pasa $idusu, tomarlo de la sesión
        if (!$idusu) {
            $idusu = $_SESSION['idusu'];
        }

        // 1️⃣ Verificar si el usuario ya tiene un carrito (si no se pasó como parámetro)
        if (!$idcarrito) {
            $sqlCarrito = "SELECT idcarrito FROM carrito WHERE idusu = :idusu";
            $stmtCarrito = $this->conexion->prepare($sqlCarrito);
            $stmtCarrito->bindParam(':idusu', $idusu, PDO::PARAM_INT);
            $stmtCarrito->execute();
            $carrito = $stmtCarrito->fetch(PDO::FETCH_ASSOC);

            if (!$carrito) {
                // 2️⃣ Si no tiene carrito, crearlo
                $sqlCrearCarrito = "INSERT INTO carrito (idusu, fecha_creacion, estado) 
                    VALUES (:idusu, CURDATE(), 'activo')";
                $stmtCrearCarrito = $this->conexion->prepare($sqlCrearCarrito);
                $stmtCrearCarrito->bindParam(':idusu', $idusu, PDO::PARAM_INT);
                $stmtCrearCarrito->execute();

                // Obtener el idcarrito recién insertado
                $idcarrito = $this->conexion->lastInsertId();
            } else {
                // Si ya existe el carrito, obtener su idcarrito
                $idcarrito = $carrito['idcarrito'];
            }
        }

        // 3️⃣ Insertar el producto en detcarrito o actualizar cantidad si ya existe
        $sqlDetalle = "INSERT INTO detcarrito (idcarrito, idprod, cantidad, precar) 
            VALUES (:idcarrito, :idprod, :cantidad, :precar) 
            ON DUPLICATE KEY UPDATE cantidad = cantidad + :cantidad";

        $stmtDetalle = $this->conexion->prepare($sqlDetalle);
        $stmtDetalle->bindParam(':idcarrito', $idcarrito, PDO::PARAM_INT);
        $stmtDetalle->bindParam(':idprod', $idprod, PDO::PARAM_INT);
        $stmtDetalle->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmtDetalle->bindParam(':precar', $precar, PDO::PARAM_STR);
        $stmtDetalle->execute();

        $this->conexion->commit(); // Confirmar la transacción

        return true;
    } catch (Exception $e) {
        $this->conexion->rollBack(); // Revertir la transacción si hay error
        return false;
    }
}


    public function eliminarProducto($idusu, $idprod )
    {
        $this->conexion->beginTransaction(); // Iniciar transacción

        // 1️⃣ Obtener el ID del carrito del usuario
        $sqlCarrito = "SELECT idcarrito FROM carrito WHERE idusu = :idusu";
        $stmtCarrito = $this->conexion->prepare($sqlCarrito);
        $stmtCarrito->bindParam(':idusu', $idusu, PDO::PARAM_INT);
        $stmtCarrito->execute();
            $carrito = $stmtCarrito->fetch(PDO::FETCH_ASSOC);

            if (!$carrito) {
                throw new Exception("El usuario no tiene un carrito.");
            }

            $idcarrito = $carrito['idcarrito'];

            // 2️⃣ Eliminar el producto del detcarrito
            $sqlEliminar = "DELETE FROM detcarrito WHERE idcarrito = :idcarrito AND idprod  = :idprod ";
            $stmtEliminar = $this->conexion->prepare($sqlEliminar);
            $stmtEliminar->bindParam(':idcarrito', $idcarrito, PDO::PARAM_INT);
            $stmtEliminar->bindParam(':idprod', $idprod , PDO::PARAM_INT);
            $stmtEliminar->execute();

            $this->conexion->commit(); // Confirmar la transacción

            return true;
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
