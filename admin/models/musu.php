<?php
require_once 'models/conexion.php';
class Musu{
    private $idusu;
    private $nomusu;
    private $emausu;
    private $celusu;
    private $fotiden;
    private $numdocu;
    private $fecnausu;
    private $pssusu;
    private $codubi;
    private $idper;
    private $idval;


    // Métodos GET
    public function getIdusu(): mixed {
        return $this->idusu;
    }
    
    public function getNomusu(): mixed {
        return $this->nomusu;
    }
    
    public function getEmausu(): mixed {
        return $this->emausu;
    }
    
    public function getCelusu(): mixed {
        return $this->celusu;
    }
    
    public function getFotiden(): mixed {
        return $this->fotiden;
    }
    
    public function getNumdocu(): mixed {
        return $this->numdocu;
    }
    
    public function getFecnausu(): mixed {
        return $this->fecnausu;
    }
    
    public function getpssusu(): mixed {
        return $this->pssusu;
    }
    
    public function getCodubi(): mixed {
        return $this->codubi;
    }
    public function getIdper(): mixed {
        return $this->idper;
    }
    public function getIdval(): mixed {
        return $this->idval;
    }


    // Métodos SET
    public function setIdusu($idusu) {
        $this->idusu = $idusu;
    }
    public function setNomusu($nomusu) {
        $this->nomusu = $nomusu;
    }
    public function setEmausu($emausu) {
        $this->emausu = $emausu;
    }
    public function setCelusu($celusu) {
        $this->celusu = $celusu;
    }
    public function setfotiden($fotiden) {
        $this->fotiden = $fotiden;
    }
    public function setNumdocu($numdocu) {
        $this->numdocu = $numdocu;
    }
    public function setFecnausu($fecnausu) {
        $this->fecnausu = $fecnausu;
    }
    public function setPssusu($pssusu) {
        $this->pssusu = $pssusu;
    }
    public function setCodubi($codubi) {
        $this->codubi = $codubi;
    }
    public function setIdper($idper) {
        $this->idper = $idper;
    }
    public function setIdval($idval) {
        $this->idval = $idval;
    }
    
    // Método para obtener todos los registros
    public function getAll() {
        try {
            $sql = "SELECT * FROM `usuario`";
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
            $sql = "SELECT `idusu`, `nomusu`, `emausu`, `celusu`, `fotiden`, `numdocu`, `fecnausu`, `pssusu`, `codubi`, `idper`, `idval` FROM `usuario` WHERE idusu = :idusu";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":idusu", $this->idusu);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Error al obtener el registro: " . $e->getMessage());
        }
    }

    public function save() {
        try {
            $sql = "INSERT INTO usuario (nomusu, emausu, celusu, fotiden, numdocu, fecnausu, pssusu, codubi, idper, idval) VALUES (:nomusu, :emausu, :celusu, :fotiden, :numdocu, :fecnausu, :pssusu, :codubi, :idper, :idval)";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);

             // Preparar la consulta
        $stmt = $pdo->prepare($sql);

        // Asignar los valores a los parámetros
        $stmt->bindParam(':nomusu', $nomusu);
        $stmt->bindParam(':emausu', $emausu);
        $stmt->bindParam(':celusu', $celusu);
        $stmt->bindParam(':fotiden', $fotiden);
        $stmt->bindParam(':numdocu', $numdocu);
        $stmt->bindParam(':fecnausu', $fecnausu);
        $stmt->bindParam(':pssusu', $pssusu);
        $stmt->bindParam(':codubi', $codubi);
        $stmt->bindParam(':idper', $idper);
        $stmt->bindParam(':idval', $idval);

        // Ejecutar la consulta
        $stmt->execute();

        // Devolver un mensaje de éxito
        return "Usuario guardado correctamente.";
    } catch (PDOException $e) {
        // Manejo de errores
        return "Error al guardar el usuario: " . $e->getMessage();
    }
}
    // idusu`, `nomusu`, `emausu`, `celusu`, `fotiden`, `numdocu`, `fecnausu`, `pssusu`, `codubi`, `idper`, `idval
    public function edit() {
        try {
            $sql = "UPDATE usuario SET idusu = :idusu, nomusu = :nomusu, emausu = :emausu, celusu = :celusu, fotiden = :fotiden, numdocu = :numdocu, fecnausu = :fecnausu pssusu = :pssusu codubi = :codubi idper = :idper idval = :idval WHERE idusu = :idusu";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);

            $idusu = $this->getIdusu();
            $result->bindParam(":idusu", $idusu);
            $nomusu = $this->getNomusu();
            $result->bindParam(":nomusu", $nomusu);
            $emausu = $this->getEmausu();
            $result->bindParam(":emausu", $emausu);
            $celusu = $this->getCelusu();
            $result->bindParam(":celusu", $celusu);
            $fotiden = $this->getFotiden();
            $result->bindParam(":fotiden", $fotiden);
            $numdocu = $this->getNumdocu();
            $result->bindParam(":numdocu", $numdocu);
            $fecnausu = $this->getFecnausu();
            $result->bindParam(":fecnausu", $fecnausu);
            $pssusu = $this->getPssusu();
            $result->bindParam(":pssusu", $pssusu);
            $codubi = $this->getCodubi();
            $result->bindParam(":codubi", $codubi);
            $idper = $this->getIdper();
            $result->bindParam(":idper", $idper);
            $idval = $this->getidval();
            $result->bindParam(":idval", $idval);

            $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function del() {
        try {
            $sql = "DELETE FROM usuario WHERE idusu = :idusu";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idusu = $this->getIdusu();
            $result->bindParam(":idusu", $idusu);
            $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>