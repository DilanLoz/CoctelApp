<?php
require_once 'models/conexion.php';

class Mpag {
    private $idpag;
    private $idper;
    private $nompag;
    private $rutpag;
    private $mospag;
    private $ordpag;
    private $titupag;
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
    
    public function getTitupag() {
        return $this->titupag;
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
    
    public function setTitupag($titupag) {
        $this->titupag = $titupag;
    }

    public function setIcopag($icopag) {
        $this->icopag = $icopag;
    }

    public function setDespag($despag) {
        $this->despag = $despag;
    }

    // Método para obtener todos los registros
    public function getAll() {
        try {
            $sql = "SELECT p.idpag, p.idper, pg.nompag, pg.rutpag, pg.mospag, 
                           pg.ordpag, pg.titupag, pg.icopag, pg.despag, pr.nomper, pr.pagini 
                    FROM pagper AS p 
                    INNER JOIN pagina AS pg ON p.idpag = pg.idpag 
                    INNER JOIN perfiles AS pr ON p.idper = pr.idper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Error al obtener registros: " . $e->getMessage());
        }
    }

    // Método para obtener un registro
    public function getOne() {
        try {
            $sql = "SELECT p.idpag, p.idper, pg.nompag, pg.rutpag, pg.mospag, 
                           pg.ordpag, pg.titupag, pg.icopag, pg.despag, pr.nomper, pr.pagini 
                    FROM pagper AS p 
                    INNER JOIN pagina AS pg ON p.idpag = pg.idpag 
                    INNER JOIN perfiles AS pr ON p.idper = pr.idper 
                    WHERE p.idpag = :idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":idpag", $this->idpag);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Error al obtener el registro: " . $e->getMessage());
        }
    }

    // Método para guardar
    // Método para guardar
public function save() {
    try {
        $sql = "INSERT INTO pagina (idpag, nompag, rutpag, mospag, ordpag, titupag, icopag, despag) 
                VALUES (:idpag, :nompag, :rutpag, :mospag, :ordpag, :titupag, :icopag, :despag)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);

        // Enlazar parámetros
        $result->bindParam(":idpag", $this->idpag);
        $result->bindParam(":nompag", $this->nompag);
        $result->bindParam(":rutpag", $this->rutpag);
        $result->bindParam(":mospag", $this->mospag);
        $result->bindParam(":ordpag", $this->ordpag);
        $result->bindParam(":titupag", $this->titupag);
        $result->bindParam(":icopag", $this->icopag);
        $result->bindParam(":despag", $this->despag);

        return $result->execute();
    } catch (Exception $e) {
        throw new Exception("Error al guardar: " . $e->getMessage());
    }
}


    // Método para editar
    public function edit() {
        try {
            $sql = "UPDATE pagina 
                    SET nompag = :nompag, 
                        rutpag = :rutpag, 
                        mospag = :mospag, 
                        ordpag = :ordpag,
                        titupag = :titupag, 
                        icopag = :icopag, 
                        despag = :despag 
                    WHERE idpag = :idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            
            $result->bindParam(":idpag", $this->idpag);
            $result->bindParam(":nompag", $this->nompag);
            $result->bindParam(":rutpag", $this->rutpag);
            $result->bindParam(":mospag", $this->mospag);
            $result->bindParam(":ordpag", $this->ordpag);
            $result->bindParam(":titupag", $this->titupag);
            $result->bindParam(":icopag", $this->icopag);
            $result->bindParam(":despag", $this->despag);
            
            return $result->execute();
        } catch (Exception $e) {
            throw new Exception("Error al editar: " . $e->getMessage());
        }
    }

    // Método para editar el campo mospag
    public function editMospag() {
        try {
            $sql = "UPDATE pagina SET mospag = :mospag WHERE idpag = :idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            
            $result->bindParam(":idpag", $this->idpag);
            $result->bindParam(":mospag", $this->mospag);
            
            return $result->execute();
        } catch (Exception $e) {
            throw new Exception("Error al actualizar mospag: " . $e->getMessage());
        }
    }

    // Método para eliminar
    public function del() {
        try {
            $sql = "DELETE FROM pagina WHERE idpag = :idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            
            $result->bindParam(":idpag", $this->idpag);
            
            return $result->execute();
        } catch (Exception $e) {
            throw new Exception("Error al eliminar: " . $e->getMessage());
        }
    }
}
?>