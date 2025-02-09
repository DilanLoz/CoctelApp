<?php
class Mval{
    private $idval;
    private $iddom;
    private $nomval;
    private $act;

    // METODOS GET
    public function getIdval(){
        return $this->idval;
    }
    public function getIddom(){
        return $this->iddom;
    }
    public function getNomval(){
        return $this->nomval;
    }
    public function getAct(){
        return $this->act;
    }

    // METODOS SET
    public function setIdval($idval){
        $this->idval = $idval;
    }
    public function setIddom($iddom){
        $this->iddom = $iddom;
    }
    public function setNomval($nomval){
        $this->nomval = $nomval;
    }
    public function setAct($act){
        $this->act = $act;
    }

    function getAll(){
        $sql = "SELECT idval, iddom, nomval, act FROM valor";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getOne(){
        $sql = "SELECT idval, iddom, nomval, act FROM valor WHERE idval = :idval";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idval = $this->getIdval();
        $result->bindParam(":idval", $idval);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function save(){
        try {
            $sql = "INSERT INTO valor(idval, iddom, nomval, act) VALUES (:idval, :iddom, :nomval, :act)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idval = $this->getIdval();
            $result->bindParam(":idval", $idval);
            $iddom = $this->getIddom();
            $result->bindParam(":iddom", $iddom);
            $nomval = $this->getNomval();
            $result->bindParam(":nomval", $nomval);
            $act = $this->getAct();  // Se corrigió: 'getact' debería ser 'getAct'
            $result->bindParam(":act", $act);
            $result->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Muestra el error si ocurre una excepción
        }
    }

    function editAct(){
        try {
            $sql = "UPDATE valor SET act = :act WHERE idval = :idval";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idval = $this->getIdval();
            $result->bindParam(":idval", $idval);
            $act = $this->getAct();
            $result->bindParam(":act", $act);
            $result->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Muestra el error si ocurre una excepción
        }
    }

    function edit(){
        try {
            $sql = "UPDATE valor SET nomval = :nomval, iddom = :iddom, act = :act WHERE idval = :idval";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idval = $this->getIdval();
            $result->bindParam(":idval", $idval);
            $nomval = $this->getNomval();
            $result->bindParam(":nomval", $nomval);
            $iddom = $this->getIddom();
            $result->bindParam(":iddom", $iddom);
            $act = $this->getAct();
            $result->bindParam(":act", $act);
            $result->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Muestra el error si ocurre una excepción
        }
    }

    function del(){
        try {
            $sql = "DELETE FROM valor WHERE idval = :idval";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idval = $this->getIdval();
            $result->bindParam(":idval", $idval);
            $result->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Muestra el error si ocurre una excepción
        }
    }
    public function getValor() {
        try {
            $sql = "SELECT iddom, idval, nomval FROM valor";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Error al obtener registros: " . $e->getMessage());
        }
    }
    public function getDocumentos() {
        try {
            $sql = "SELECT idval, nomval FROM valor WHERE idval IN (101, 102, 103)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Error al obtener registros: " . $e->getMessage());
        }
    }
}
?>
