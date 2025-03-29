 <?php
require_once 'models/conexion.php';
class Mcbarxprod {

    private $idprod;
    private $nomprod;
    private $desprod;
    private $vlrprod;
    private $fotprod;
    private $idval;
    private $idbar;
    private $cantprod;
    private $idserv;
    private $idusu;
    private $nombar;
    private $tipoprod;

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

    public function getIdval() {
        return $this->idval;
    }

    public function getIdbar() {
        return $this->idbar;
    }

    public function getCantprod() {
        return $this->cantprod;
    }

    public function getIdserv() {
        return $this->idserv;
    }

    public function getIdusu() {
        return $this->idusu;
    }
    public function getNombar() {
        return $this->nombar;
    }


    public function getTipoprod() {
        return $this->tipoprod;
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
    
    public function setIdval($idval) {
        $this->idval = $idval;
    }
    
    public function setIdbar($idbar) {
        $this->idbar = $idbar;
    }
    
    public function setCantprod($cantprod) {
        $this->cantprod = $cantprod;
    }
    
    public function setIdserv($idserv) {
        $this->idserv = $idserv;
    }
    
    public function setIdusu($idusu) {
        $this->idusu = $idusu;
    }
    public function setNombar($nombar) {
        $this->nombar = $nombar;
    }
    
    public function setTipoprod($tipoprod) {
        $this->tipoprod = $tipoprod;
    }

    // Methods (getAll, getOne, save, edit, del) should be closed with }
    public function getAll() {
        try {
            $sql = "SELECT p.idprod, p.nomprod, p.desprod, p.vlrprod, p.fotprod, p.idval, p.idbar, p.cantprod, p.idserv, p.idusu, b.nombar, p.tipoprod FROM producto AS p 
            INNER JOIN bar AS b ON p.idbar=b.idbar";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }
    public function getOne() {
        try {
            $sql = "SELECT p.idprod, p.nomprod, p.desprod, p.vlrprod, p.fotprod, p.idval, p.idbar, p.cantprod, p.idserv, p.idusu, b.nombar, p.tipoprod FROM producto AS p 
            INNER JOIN bar AS b ON p.idbar=b.idbar WHERE idprod=:idprod";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprod = $this->getIdprod();
            $result->bindParam(":idprod", $idprod);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }

    public function save() {
        try {
            $sql = "INSERT INTO producto (nomprod, desprod, vlrprod, fotprod, idval, idbar, cantprod, idserv, idusu, nombar, tipoprod) VALUES (:nomprod, :desprod, :vlrprod, :fotprod, :idval, :idbar, :cantprod, :idserv, :idusu, :nombar, :tipoprod)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nomprod = $this->getNomprod();
            $result->bindParam(":nomprod", $nomprod);
            $desprod = $this->getDesprod();
            $result->bindParam(":desprod", $desprod);
            $vlrprod = $this->getVlrprod();
            $result->bindParam(":vlrprod", $vlrprod);
            $fotprod = $this->getFotprod();
            $result->bindParam(":fotprod", $fotprod);
            $idval = $this->getIdval();
            $result->bindParam(":idval", $idval);
            $idbar = $this->getIdbar();
            $result->bindParam(":idbar", $idbar);
            $cantprod = $this->getCantprod();
            $result->bindParam(":cantprod", $cantprod);
            $idserv = $this->getIdserv();
            $result->bindParam(":idserv", $idserv);
            $idusu = $this->getIdusu();
            $result->bindParam(":idusu", $idusu);
            $nombar = $this->getNombar();
            $result->bindParam(":nombar", $nombar);
            $tipoprod = $this->getTipoprod();
            $result->bindParam(":tipoprod", $tipoprod);
            $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }

    public function edit() {
        try {
            $sql = "UPDATE producto SET nomprod=:nomprod, desprod=:desprod, vlrprod=:vlrprod, fotprod=:fotprod, idval=:idval, idbar=:idbar, cantprod=:cantprod, idserv=:idserv,
        idusu=:idusu, nombar=:nombar, tipoprod=:tipoprod WHERE idprod=:idprod";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprod = $this->getIdprod();
            $result->bindParam(":idprod", $idprod);
            $nomprod = $this->getNomprod();
            $result->bindParam(":nomprod", $nomprod);
            $desprod = $this->getDesprod();
            $result->bindParam(":desprod", $desprod);
            $vlrprod = $this->getVlrprod();
            $result->bindParam(":vlrprod", $vlrprod);
            $fotprod = $this->getFotprod();
            $result->bindParam(":fotprod", $fotprod);
            $idval = $this->getIdval();
            $result->bindParam(":idval", $idval);
            $idbar = $this->getIdbar();
            $result->bindParam(":idbar", $idbar);
            $cantprod = $this->getCantprod();
            $result->bindParam(":cantprod", $cantprod);
            $idserv = $this->getIdserv();
            $result->bindParam(":idserv", $idserv);
            $idusu = $this->getIdusu();
            $result->bindParam(":idusu", $idusu);
            $tipoprod = $this->getTipoprod();
            $result->bindParam(":tipoprod", $tipoprod);
            $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }

    public function del() {
        try {
            $sql = "DELETE FROM producto WHERE idprod=:idprod";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprod = $this->getIdprod();
            $result->bindParam(":idprod", $idprod);
            $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }

} // This closes the class

?>