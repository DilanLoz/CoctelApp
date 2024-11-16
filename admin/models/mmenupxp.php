<?php
require_once 'models/conexion.php';
class Mmenupxp {

    private $idpag;
    private $idper;
    private $nompag;
    private $rutpag;
    private $mospag;
    private $ordpag;
    private $icopag;
    private $despag;

    // Métodos GET
    public function getIdpag() {
        return $this->idpag;
    }

    public function getIdper() {
        return $this->idper;
    }

    public function getNompag() {
        return $this->nompag;
    }

    public function getRutpag() {
        return $this->rutpag;
    }

    public function getMospag() {
        return $this->mospag;
    }

    public function getOrdpag() {
        return $this->ordpag;
    }

    public function getIcopag() {
        return $this->icopag;
    }

    public function getDespag() {
        return $this->despag;
    }

    // Métodos SET
    public function setIdpag($idpag) {
        $this->idpag = $idpag;
    }

    public function setIdper($idper) {
        $this->idper = $idper;
    }

    public function setNompag($nompag) {
        $this->nompag = $nompag;
    }

    public function setRutpag($rutpag) {
        $this->rutpag = $rutpag;
    }

    public function setMospag($mospag) {
        $this->mospag = $mospag;
    }

    public function setOrdpag($ordpag) {
        $this->ordpag = $ordpag;
    }

    public function setIcopag($icopag) {
        $this->icopag = $icopag;
    }

    public function setDespag($despag) {
        $this->despag = $despag;
    }

    // Metodos (getAll, getOne, save, edit, del)
    public function getAll() {
        try {
            $sql = "SELECT p.idpag, p.idper, pg.nompag, pg.rutpag, pg.mospag, pg.ordpag, pg.icopag, pg.despag, pr.nomper, pr.pagini FROM pagper AS p INNER JOIN pagina AS pg ON p.idpag=pg.idpag INNER JOIN perfiles AS pr ON p.idper=pr.idper";
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
    public function getOnePag() {
        try {
            $sql = "SELECT p.idpag, p.idper, pg.nompag, pg.rutpag, pg.mospag, pg.ordpag, pg.icopag, pg.despag, pr.nomper, pr.pagini 
                    FROM pagper AS p 
                    INNER JOIN pagina AS pg ON p.idpag = pg.idpag 
                    INNER JOIN perfiles AS pr ON p.idper = pr.idper 
                    WHERE p.idpag = :idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpag = $this->getIdpag(); 
            $result->bindParam(":idpag", $idpag);
            $result->execute();
            $res = $result->fetch(PDO::FETCH_ASSOC); 
            return $res;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }
    public function getOnePer() {
        try {
            $sql = "SELECT p.idpag, p.idper, pg.nompag, pg.rutpag, pg.mospag, pg.ordpag, pg.icopag, pg.despag, pr.nomper, pr.pagini 
                    FROM pagper AS p 
                    INNER JOIN pagina AS pg ON p.idpag = pg.idpag 
                    INNER JOIN perfiles AS pr ON p.idper = pr.idper 
                    WHERE p.idper = :idper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper(); 
            $result->bindParam(":idper", $idper);
            $result->execute();
            $res = $result->fetch(PDO::FETCH_ASSOC); 
            return $res;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function save() {
        try {
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
    
            // Iniciar una transacción para asegurar que ambas consultas se ejecuten juntas
            $conexion->beginTransaction();
    
            // Paso 1: Insertar en la tabla `pagina`
            $sqlPagina = "INSERT INTO pagina (nompag, rutpag, mospag, ordpag, icopag, despag) 
                          VALUES (:nompag, :rutpag, :mospag, :ordpag, :icopag, :despag)";
            $resultPagina = $conexion->prepare($sqlPagina);
    
            // Obtener valores para la tabla `pagina`
            $nompag = $this->getNompag();
            $rutpag = $this->getRutpag();
            $mospag = $this->getMospag();
            $ordpag = $this->getOrdpag();
            $icopag = $this->getIcopag();
            $despag = $this->getDespag();
    
            // Enlazar parámetros
            $resultPagina->bindParam(":nompag", $nompag, PDO::PARAM_STR);
            $resultPagina->bindParam(":rutpag", $rutpag, PDO::PARAM_STR);
            $resultPagina->bindParam(":mospag", $mospag, PDO::PARAM_INT);
            $resultPagina->bindParam(":ordpag", $ordpag, PDO::PARAM_INT);
            $resultPagina->bindParam(":icopag", $icopag, PDO::PARAM_STR);
            $resultPagina->bindParam(":despag", $despag, PDO::PARAM_STR);
    
            // Ejecutar la consulta
            $resultPagina->execute();
    
            // Obtener el ID de la página recién creada
            $idpag = $conexion->lastInsertId();
    
            // Paso 2: Insertar en la tabla `pagper` para vincular la página con un perfil
            $sqlPagPer = "INSERT INTO pagper (idpag, idper) VALUES (:idpag, :idper)";
            $resultPagPer = $conexion->prepare($sqlPagPer);
    
            // Obtener el valor del perfil
            $idper = $this->getIdper();
    
            // Enlazar parámetros
            $resultPagPer->bindParam(":idpag", $idpag, PDO::PARAM_INT);
            $resultPagPer->bindParam(":idper", $idper, PDO::PARAM_INT);
    
            // Ejecutar la consulta
            $resultPagPer->execute();
    
            // Confirmar la transacción
            $conexion->commit();
    
            echo "Página creada y vinculada al perfil correctamente.";
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conexion->rollBack();
            echo "Error al guardar la página y asignarla al perfil: " . $e->getMessage();
        }
    }
    

    public function edit() {
        try {
            $sql = "UPDATE producto SET idper=:idper, desprod=:desprod, vlrprod=:vlrprod, fotprod=:fotprod, idval=:idval, idbar=:idbar, cantprod=:cantprod, idserv=:idserv, idusu=:idusu, tipoprod=:tipoprod WHERE idpag=:idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpag = $this->getidpag();
            $result->bindParam(":idpag", $idpag);
            $idper = $this->getidper();
            $result->bindParam(":idper", $idper);
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
            $sql = "DELETE FROM producto WHERE idpag=:idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpag = $this->getidpag();
            $result->bindParam(":idpag", $idpag);
            $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }

} // This closes the class

?>