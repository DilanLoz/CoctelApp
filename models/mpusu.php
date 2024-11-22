<?php 
class Mpusu {
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
    public function getIdusu() {
        return $this->idusu;
    }
    public function getNomusu() {
        return $this->nomusu;
    }
    public function getEmausu() {
        return $this->emausu;
    }
    public function getCelusu() {
        return $this->celusu;
    }
    public function getFotiden() {
        return $this->fotiden;
    }
    public function getNumdocu() {
        return $this->numdocu;
    }
    public function getFecnausu() {
        return $this->fecnausu;
    }
    public function getPssusu() {
        return $this->pssusu;
    }
    public function getCodubi() {
        return $this->codubi; // Corregido para devolver codubi en lugar de fotiden
    }
    public function getIdper() {
        return $this->idper;
    }
    public function getIdval() {
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
    public function setFotiden($fotiden) {
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

    // Métodos para la base de datos
    public function getAll() {
        $res = NULL;
        $sql = "SELECT * FROM usuario";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getOne() {
        $res = NULL;
    
        // Verificamos que la sesión esté iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Validamos que exista un id de usuario en la sesión
        if (isset($_SESSION['idusu'])) {
            $idusu = $_SESSION['idusu'];
            $sql = "SELECT nomusu, emausu, celusu, numdocu, fotiden, fecnausu, pssusu, codubi, idval, idper 
                    FROM usuario 
                    WHERE idusu = :idusu";
            
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":idusu", $idusu);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
        }
    
        return $res;
    }
    

    public function datusu() {
        $res = NULL;
        if (isset($_SESSION['idusu'])) {
            $idusu = $_SESSION['idusu'];
            $sql = "SELECT nomusu, emausu, celusu, numdocu FROM usuario WHERE idusu = :idusu";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":idusu", $idusu);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            }
        return $res;
    }

    public function save() {
        $sql = "INSERT INTO usuario (nomusu, emausu, celusu, pssusu, codubi, idper, idval) VALUES (:nomusu, :emausu, :celusu, :pssusu, :codubi, :idper, :idval)";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":nomusu", $this->nomusu);
        $result->bindParam(":emausu", $this->emausu);
        $result->bindParam(":celusu", $this->celusu);
        $result->bindParam(":pssusu", $this->pssusu);
        $result->bindParam(":codubi", $this->codubi);
        $result->bindParam(":idper", $this->idper);
        $result->bindParam(":idval", $this->idval);
        $result->execute();
    }

    public function edit() {
        $sql = "UPDATE usuario SET nomusu=:nomusu, emausu=:emausu, celusu=:celusu, pssusu=:pssusu, codubi=:codubi, idper=:idper, idval=:idval WHERE idusu=:idusu";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $this->idusu);
        $result->bindParam(":nomusu", $this->nomusu);
        $result->bindParam(":emausu", $this->emausu);
        $result->bindParam(":celusu", $this->celusu);
        $result->bindParam(":pssusu", $this->pssusu);
        $result->bindParam(":codubi", $this->codubi);
        $result->bindParam(":idper", $this->idper);
        $result->bindParam(":idval", $this->idval);
        $result->execute();
    }

    public function del() {
        $sql = "DELETE FROM usuario WHERE idusu=:idusu";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $this->idusu);
        $result->execute();
    }
}
?>