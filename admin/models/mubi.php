<?php
class Mubi {
    private $codubi;
    private $nomubi;
    private $depubi;
    //Metodos get ubi
    public function getCodubi() {
        return $this->codubi;
    }
    public function getNomubi() {
        return $this->nomubi;
    }
    public function getDepubi() {
        return $this->depubi;
    }
    //Metodos set 
    public function setCodubi($codubi) {
        $this->codubi = $codubi;
    }
    public function setNomubi($nomubi) {
        $this->nomubi = $nomubi;
    }
    //Metodos set ubi
    public function setDepubi($depubi) {
        $this->depubi = $depubi;
    }
    public function getAll() {
        try {
            $sql = "SELECT codubi, nomubi, depubi
                    FROM ubicacion";
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
            $sql = "SELECT codubi, nomubi, depubi
                    FROM ubicacion
                    where codubi=:codubi";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":codubi", $this->codubi);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Error al obtener el registro: " . $e->getMessage());
        }
    }
    public function save() {
        try {
            $sql = "INSERT INTO ubicacion (codubi, nomubi, depubi) 
                    VALUES (:codubi, :nomubi, :depubi)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            
            // Debug
            error_log("Valores a insertar:");
            error_log("codubi: " . $this->getCodubi());
            error_log("nomubi: " . $this->getNomubi());
            error_log("depubi: " . $this->getDepubi());
            
            $result->bindParam(":codubi", $this->codubi);
            $result->bindParam(":nomubi", $this->nomubi);
            $result->bindParam(":depubi", $this->depubi);
            
            $success = $result->execute();
            
            if (!$success) {
                error_log("Error SQL: " . print_r($result->errorInfo(), true));
            }
            
            return $success;
        } catch (Exception $e) {
            error_log("Error en save(): " . $e->getMessage());
            throw new Exception("Error al guardar: " . $e->getMessage());
        }
    }
    
        // Método para editar
        public function edit() {
            try {
                $sql = "UPDATE ubicacion 
                        SET 
                            nomubi = :nomubi, 
                            depubi = :depubi
                        WHERE codubi = :codubi";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $result->bindParam(":codubi", $this->codubi);
                $result->bindParam(":nomubi", $this->nomubi);
                $result->bindParam(":depubi", $this->depubi);
                
                return $result->execute();
            } catch (Exception $e) {
                throw new Exception("Error al editar: " . $e->getMessage());
            }
        }

    public function del() {
        $sql = "DELETE FROM ubicacion WHERE codubi = :codubi";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $codubi = $this->getCodubi();
        $result->bindParam(":codubi", $codubi);
        $result->execute();
    }
    public function getCodubiNomubi() {
        try {
            $sql = "SELECT codubi, nomubi FROM ubicacion ORDER BY nomubi ASC";
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