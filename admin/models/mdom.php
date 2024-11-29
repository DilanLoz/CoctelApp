<?php
class Mdom{
    private $iddom;
    private $nomdom;

    public function getIddom(){
        return $this->iddom;
    }
    public function getNomdom(){
        return $this->nomdom;
    }

    // Métodos SET
    public function setIddom($iddom){
        $this->iddom = $iddom;
    }
    public function setNomdom($nomdom){
        $this->nomdom = $nomdom;
    }

    public function getAll(){
        $sql = "SELECT iddom, nomdom FROM dominio";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getOne(){
        $sql = "SELECT nomdom, iddom FROM dominio WHERE iddom = :iddom";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $iddom = $this->getIddom();
        $result->bindParam(":iddom", $iddom);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    public function save(){
        try {
            $sql = "INSERT INTO dominio(nomdom) VALUES (:nomdom)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nomdom = $this->getNomdom();
            $result->bindParam(":nomdom", $nomdom);
            $result->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Muestra el error si ocurre una excepción
        }
    }

    public function edit(){
        try {
            $sql = "UPDATE dominio SET nomdom = :nomdom WHERE iddom = :iddom";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $iddom = $this->getIddom();
            $result->bindParam(":iddom", $iddom);
            $nomdom = $this->getNomdom();
            $result->bindParam(":nomdom", $nomdom);
            $result->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Muestra el error si ocurre una excepción
        }
    }

    public function del(){
        try {
            $sql = "DELETE FROM dominio WHERE iddom = :iddom";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $iddom = $this->getIddom();
            $result->bindParam(":iddom", $iddom);
            $result->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Muestra el error si ocurre una excepción
        }
    }

    public function getDxV($iddom){
        $res = null;
        $modelo = new conexion();
        $sql = "SELECT COUNT(iddom) AS can FROM valor WHERE iddom = :iddom";
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(':iddom', $iddom);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
}
?>
