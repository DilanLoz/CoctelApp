<?php
require_once "models/conexion.php";

class ProductoController {
    public function buscarProducto($termino) {
        $res = [];
        $sql = "SELECT p.idprod, p.nomprod, p.vlrprod, p.fotprod, p.idbar, b.nombar 
                FROM producto AS p 
                INNER JOIN bar AS b ON p.idbar = b.idbar 
                WHERE p.nomprod LIKE :termino OR p.idprod = CAST(:idexacto AS UNSIGNED)";
        
        try {
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $likeTerm = "%{$termino}%";
            $result->bindParam(":termino", $likeTerm, PDO::PARAM_STR);
            $result->bindParam(":idexacto", $termino, PDO::PARAM_STR);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
        return $res;
    }
}

class PedidoController {
    public function buscarPedido($termino) {
        $res = [];
        $sql = "SELECT idpedido FROM pedido WHERE idpedido LIKE :termino";
        
        try {
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $likeTerm = "%{$termino}%";
            $result->bindParam(":termino", $likeTerm, PDO::PARAM_STR);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
        return $res;
    }
}

// Proceso de búsqueda
if (isset($_GET['termino'])) {
    $termino = trim($_GET['termino']);
    
    $productoController = new ProductoController();
    $pedidoController = new PedidoController();

    $productos = $productoController->buscarProducto($termino);
    $pedidos = $pedidoController->buscarPedido($termino);

    // Devolver resultados en JSON
    header('Content-Type: application/json');
    echo json_encode(["productos" => $productos, "pedidos" => $pedidos]);
}
?>
