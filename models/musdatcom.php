
<?php
require_once 'models/conexion.php';

class Musdatcom {

    private $idmetpago;
    private $nommetpago;
    private $nomtitu;
    private $cvv;
    private $fecvenci;
    private $numtarj;

    // Métodos GET
    public function getIdmetpago() {
        return $this->idmetpago;
    }
    public function getNommetpago() {
        return $this->nommetpago;
    }
    public function getNomtitu() {
        return $this->nomtitu;
    }
    public function getCvv() {
        return $this->cvv;
    }
    public function getFecvenci() {
        return $this->fecvenci;
    }
    public function getNumtarj() {
        return $this->numtarj;
    }

    // Métodos SET
    public function setIdmetpago($idmetpago) {
        $this->idmetpago = $idmetpago;
    }
    public function setNommetpago($nommetpago) {
        $this->nommetpago = $nommetpago;
    }
    public function setNomtitu($nomtitu) {
        $this->nomtitu = $nomtitu;
    }
    public function setCvv($cvv) {
        $this->cvv = $cvv;
    }
    public function setFecvenci($fecvenci) {
        $this->fecvenci = $fecvenci;
    }
    public function setNumtarj($numtarj) {
        $this->numtarj = $numtarj;
    }

    // Obtener todos los registros
    public function getAll() {
        try {
            $sql = "SELECT m.idmetpago, m.nommetpago, m.nomtitu, p.total, m.cvv, m.fecvenci, m.numtarj
                    FROM metpago AS m 
                    INNER JOIN pedido AS p ON m.idmetpago = p.idmetpago";

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

    // Obtener un registro por ID
    public function getOne() {
        try {
            $sql = "SELECT idmetpago, nommetpago, nomtitu, cvv, fecvenci, numtarj 
                    FROM metpago WHERE idmetpago=:idmetpago";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idmetpago = $this->getIdmetpago();
            $result->bindParam(":idmetpago", $idmetpago);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }

    // Guardar un nuevo registro
    public function save() {
        try {
            $sql = "INSERT INTO metpago (nommetpago, nomtitu, cvv, fecvenci, numtarj) 
                    VALUES (:nommetpago, :nomtitu, :cvv, :fecvenci, :numtarj)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nommetpago = $this->getNommetpago();
            $result->bindParam(":nommetpago", $nommetpago);
            $nomtitu = $this->getNomtitu();
            $result->bindParam(":nomtitu", $nomtitu);
            $cvv = $this->getCvv();
            $result->bindParam(":cvv", $cvv);
            $fecvenci = $this->getFecvenci();
            $result->bindParam(":fecvenci", $fecvenci);
            $numtarj = $this->getNumtarj();
            $result->bindParam(":numtarj", $numtarj);
            $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }

    // Editar un registro existente
    public function edit() {
        try {
            $sql = "UPDATE metpago 
                    SET nommetpago=:nommetpago, nomtitu=:nomtitu, cvv=:cvv, fecvenci=:fecvenci, numtarj=:numtarj, 
                    WHERE idmetpago=:idmetpago";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idmetpago = $this->getIdmetpago();
            $result->bindParam(":idmetpago", $idmetpago);
            $nommetpago = $this->getNommetpago();
            $result->bindParam(":nommetpago", $nommetpago);
            $nomtitu = $this->getNomtitu();
            $result->bindParam(":nomtitu", $nomtitu);
            $cvv = $this->getCvv();
            $result->bindParam(":cvv", $cvv);
            $fecvenci = $this->getFecvenci();
            $result->bindParam(":fecvenci", $fecvenci);
            $numtarj = $this->getNumtarj();
            $result->bindParam(":numtarj", $numtarj);
            $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }

    // Eliminar un registro
    public function del() {
        try {
            $sql = "DELETE FROM metpago WHERE idmetpago=:idmetpago";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idmetpago = $this->getIdmetpago();
            $result->bindParam(":idmetpago", $idmetpago);
            $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }
}
?>