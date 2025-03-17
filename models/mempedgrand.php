<?php
class Mdetpedido
{
    // Atributos
    private $iddetpedido;
    private $idpedido;
    private $idprod;
    private $cantidad;
    private $precio;
    private $total;
    private $idusu;
    private $idbar;

    // Métodos GET
    public function getIddetpedido()
    {
        return $this->iddetpedido;
    }
    public function getIdpedido()
    {
        return $this->idpedido;
    }
    public function getIdprod()
    {
        return $this->idprod;
    }
    public function getCantidad()
    {
        return $this->cantidad;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getTotal()
    {
        return $this->total;
    }
    public function getIdusu()
    {
        return $this->idusu;
    }
    public function getIdbar()
    {
        return $this->idbar;
    }

    // Métodos SET
    public function setIddetpedido($iddetpedido)
    {
        $this->iddetpedido = $iddetpedido;
    }
    public function setIdpedido($idpedido)
    {
        $this->idpedido = $idpedido;
    }
    public function setIdprod($idprod)
    {
        $this->idprod = $idprod;
    }
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    public function setTotal($total)
    {
        $this->total = $total;
    }
    public function setIdusu($idusu)
    {
        $this->idusu = $idusu;
    }
    public function setIdbar($idbar)
    {
        $this->idbar = $idbar;
    }
    public function getDetallesPedido($idpedido)
    {
        try {
            $sql = "SELECT dp.iddetpedido, dp.idpedido, dp.idprod, dp.cantidad, dp.precio, 
            (dp.cantidad * dp.precio) AS total, dp.idusu, dp.idbar, 
            p.fotprod, p.nomprod AS nombre_producto, p.mililitros, 
            b.nombar, ped.direccion, ped.mensaje, ped.metodo_pago, ped.estado, ped.servicio
        FROM detpedido AS dp
        INNER JOIN producto AS p ON dp.idprod = p.idprod
        INNER JOIN bar AS b ON dp.idbar = b.idbar
        INNER JOIN pedido AS ped ON dp.idpedido = ped.idpedido
        WHERE dp.idpedido = :idpedido";

            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":idpedido", $idpedido, PDO::PARAM_INT);
            $result->execute();

            $productos = $result->fetchAll(PDO::FETCH_ASSOC);
            return $productos;
        } catch (Exception $e) {
            echo "Error en SQL: " . $e->getMessage();
        }
    }
    public function getPedidosPorBar($idbar) {
        try {
            $sql = "SELECT 
                        dp.idpedido, dp.idprod, dp.cantidad, dp.precio, 
                        (dp.cantidad * dp.precio) AS total, 
                        p.nomprod AS nombre_producto, p.mililitros, p.fotprod, 
                        b.nombar, ped.direccion, 
                        emp.nomemp, ped.fecha_pedido, 
                        usu.nomusu, ped.estado_pedido, ped.estado_pago, ped.servicio, 
                        (SELECT SUM(dp2.cantidad * dp2.precio) 
                         FROM detpedido dp2 
                         WHERE dp2.idpedido = dp.idpedido) AS total_pedido  
                    FROM detpedido AS dp
                    INNER JOIN producto AS p ON dp.idprod = p.idprod
                    INNER JOIN bar AS b ON dp.idbar = b.idbar
                    INNER JOIN pedido AS ped ON dp.idpedido = ped.idpedido
                    LEFT JOIN empleado AS emp ON ped.idemp = emp.idemp
                    INNER JOIN usuario AS usu ON ped.idusu = usu.idusu  
                    WHERE dp.idbar = :idbar 
                    AND ped.estado_pedido IN (1,2)  -- Solo pedidos con estado 1 y 2
                    AND ped.estado_pago != 'Pagado'  -- Excluye los pedidos pagados
                    ORDER BY dp.idpedido DESC";
            
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":idbar", $idbar, PDO::PARAM_INT);
            $result->execute();
    
            $productos = $result->fetchAll(PDO::FETCH_ASSOC);
            return $productos;
        } catch (Exception $e) {
            echo "Error en SQL: " . $e->getMessage();
        }
    }
    
}
