<?php
require_once 'models/conexion.php';
class Mbarxprod {

    private $idprod;
    private $nomprod;
    private $desprod;
    private $vlrprod;
    private $fotprod;
    private $idbar;
    private $cantprod;
    private $idusu;
    private $tipoprod;
    private $mililitros;


    public function getIdprod() {
        return $this->idprod;
    }

    public function getNomprod() {
        return $this->nomprod;
    }

    public function getDesprod() {
        return $this->desprod;
    }

    public function getVlrprod() {
        return $this->vlrprod;
    }

    public function getFotprod() {
        return $this->fotprod;
    }


    public function getIdbar() {
        return $this->idbar;
    }

    public function getCantprod() {
        return $this->cantprod;
    }

    public function getIdusu() {
        return $this->idusu;
    }

    public function getTipoprod() {
        return $this->tipoprod;
    }
    public function getMililitros() {
        return $this->mililitros;
    }


    public function setIdprod($idprod) {
        $this->idprod = $idprod;
    }
    
    public function setNomprod($nomprod) {
        $this->nomprod = $nomprod;
    }
    
    public function setDesprod($desprod) {
        $this->desprod = $desprod;
    }
    
    public function setVlrprod($vlrprod) {
        $this->vlrprod = $vlrprod;
    }
    
    public function setFotprod($fotprod) {
        $this->fotprod = $fotprod;
    }
    
    
    public function setIdbar($idbar) {
        $this->idbar = $idbar;
    }
    
    public function setCantprod($cantprod) {
        $this->cantprod = $cantprod;
    }

    public function setIdusu($idusu) {
        $this->idusu = $idusu;
    }
    
    public function setTipoprod($tipoprod) {
        $this->tipoprod = $tipoprod;
    }
    public function setMililitros($mililitros) {
        $this->mililitros = $mililitros;
    }

    // Methods (getAll, getOne, save, edit, del) should be closed with }

    public function getAll() {
		$res = NULL;
		$sql = "SELECT * FROM empleado";
		
		$modelo = new Conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res = $result->fetchAll(PDO::FETCH_ASSOC);
		
		return $res;
	}

    public function getOne($idprod){
        $res = NULL;
        $sql = "SELECT idprod, nomprod, desprod, vlrprod, fotprod, idbar, cantprod, tipoprod, mililitros FROM producto WHERE idprod=:idprod";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idprod", $idprod);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
    
        return $res;
    }

    public function gettabla() {
        $res = NULL;
        $idbar = $_SESSION['idbar']; // Asegurar que $_SESSION['idbar'] tiene un valor válido
    
        $sql = "SELECT
                    p.fotprod,
                    p.idprod,
                    p.nomprod,
                    p.desprod,
                    p.vlrprod,
                    p.cantprod,
                    p.mililitros,
                    p.tipoprod,
                    p.estado
                FROM producto AS p
                INNER JOIN bar AS b ON p.idbar = b.idbar
                WHERE p.idbar = :idbar
                AND p.estado != 2"; // Filtra los productos cuyo estado NO sea 2
    
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(':idbar', $idbar, PDO::PARAM_INT);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
    
        return $res;
    }
    
    



    public function del($idprod) {
        try {
            $sql = "UPDATE producto SET estado = :estado WHERE idprod = :idprod";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $estado = 2; // Nuevo valor del estado
            $result->bindParam(":estado", $estado, PDO::PARAM_INT);
            $result->bindParam(":idprod", $idprod, PDO::PARAM_INT);
            return $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function saveprod() {
        $sql = "INSERT INTO producto (nomprod, desprod, vlrprod, fotprod, idbar, cantprod, tipoprod, mililitros) VALUES (:nomprod, :desprod, :vlrprod, :fotprod, :idbar, :cantprod, :tipoprod, :mililitros)";
        
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
    
        $result->bindParam(":nomprod", $this->nomprod);
        $result->bindParam(":desprod", $this->desprod);
        $result->bindParam(":vlrprod", $this->vlrprod);
        $result->bindParam(":fotprod", $this->fotprod);
        $result->bindParam(":idbar", $this->idbar);
        $result->bindParam(":cantprod", $this->cantprod);
        $result->bindParam(":tipoprod", $this->tipoprod);
        $result->bindParam(":mililitros", $this->mililitros);
    
        return $result->execute();
    }
    

    public function editprod(){

    $sql = "UPDATE producto SET 
                nomprod=:nomprod, 
                desprod=:desprod, 
                vlrprod=:vlrprod,
                idbar=:idbar, 
                cantprod=:cantprod, 
                tipoprod=:tipoprod,  -- Aquí la coma
                mililitros=:mililitros  -- Aquí también la coma
            WHERE idprod=:idprod";

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);

    $result->bindParam(":nomprod", $this->nomprod);
    $result->bindParam(":desprod", $this->desprod);
    $result->bindParam(":vlrprod", $this->vlrprod);
    $result->bindParam(":idbar", $this->idbar);
    $result->bindParam(":cantprod", $this->cantprod);
    $result->bindParam(":tipoprod", $this->tipoprod);
    $result->bindParam(":mililitros", $this->mililitros);
    $result->bindParam(":idprod", $this->idprod); // No te olvides de vincular el idprod también.

    return $result->execute();
}
public function getAllProd() {
    try {
        $sql = "SELECT p.idprod, p.nomprod, p.desprod, p.vlrprod, p.fotprod, p.idbar, p.cantprod, 
                       b.nombar, p.tipoprod, p.mililitros 
                FROM producto AS p 
                INNER JOIN bar AS b ON p.idbar = b.idbar 
                WHERE b.estado = 1"; 

        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
public function getAllProdIni() {
    try {
        $sql = "SELECT p.idprod, p.nomprod, p.desprod, p.vlrprod, p.fotprod, p.idbar, p.cantprod, 
                       b.nombar, p.tipoprod, p.mililitros 
                FROM producto AS p 
                INNER JOIN bar AS b ON p.idbar = b.idbar 
                WHERE b.estado = 1
                ORDER BY RAND()"; 

        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


} 

?>