<?php
class Mbar {
    private $idbar;
    private $nombar;
    private $nompropi;
    private $nit;
    private $emabar;
    private $telbar;
    private $pssbar;
    private $dircbar;
    private $codubi;
    private $idper;
    private $idval;
    private $fotbar;

    // Método para obtener todos los bares
    public function select() {
        // Crear la conexión a la base de datos usando la clase Conexion
        $db = new Conexion();
        $conexion = $db->get_conexion(); // Obtener la conexión PDO

        // Preparar la consulta SQL
        $sql = "SELECT * FROM bar"; // Asegúrate de que la tabla se llama "bares"
        
        // Preparar la consulta
        $stmt = $conexion->prepare($sql);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    public function getIdbar() {
        return $this->idbar;
    }
    public function getNombar() {
        return $this->nombar;
    }
    public function getNompropi() {
        return $this->nompropi;
    }
    public function getNit() {
        return $this->nit;
    }
    public function getEmabar() {
        return $this->emabar;
    }
    public function getTelbar() {
        return $this->telbar;
    }
    public function getPssbar() {
        return $this->pssbar;
    }
    public function getDircbar() {
        return $this->dircbar;
    }
    public function getCodubi() {
        return $this->codubi;
    }
    public function getIdper() {
        return $this->idper;
    }
    public function getIdval() {
        return $this->idval;
    }
    public function getFotbar() {
        return $this->fotbar;
    }

    public function setIdbar($idbar) {
        $this->idbar = $idbar;
    }
    public function setNombar($nombar) {
        $this->nombar = $nombar;
    }
    public function setNompropi($nompropi) {
        $this->nompropi = $nompropi;
    }
    public function setNit($nit) {
        $this->nit = $nit;
    }
    public function setEmabar($emabar) {
        $this->emabar = $emabar;
    }
    public function setTelbar($telbar) {
        $this->telbar = $telbar;
    }
    public function setPssbar($pssbar) {
        $this->pssbar = $pssbar;
    }
    public function setDircbar($dircbar) {
        $this->dircbar = $dircbar;
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
    public function setFotbar($fotbar) {
        $this->fotbar = $fotbar;
    }

    public function getAll() {
    	$res = NULL;
    	$sql = "SELECT b.idbar, b.nombar, b.nompropi, b.nit, b.emabar, b.telbar, b.pssbar, b.dircbar, v.iddom, v.nomval, b.codubi, u.nomubi, b.idper, b.idval, b.fotbar FROM bar AS b INNER JOIN ubicacion AS u ON b.codubi=u.codubi LEFT JOIN valor AS v ON b.idval=v.idval";
    	$modelo = new Conexion();
    	$conexion = $modelo->get_conexion();
    	$result = $conexion->prepare($sql);
    	$result->execute();
    	$res = $result->fetchAll(PDO::FETCH_ASSOC);
   	 	return $res;
}
    public function getOne() {
        $res = NULL;
        $sql = "SELECT * FROM bar WHERE idbar = :idbar";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idbar = $this->getIdbar();
        $result->bindParam(":idbar", $idbar);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function save() {
    // Verificar si el codubi existe en la tabla ubicacion
    $codubi = $this->getCodubi();
    $idper = $this->getIdper(); // Obtener el valor de idper

    // Asegurarse de que idper no sea NULL
    if ($idper === NULL) {
        // Asignar un valor predeterminado si es necesario
        // Por ejemplo, si idper es obligatorio, deberías manejar el error o asignar un valor por defecto
        $idper = 1; // Asignar un valor predeterminado si es necesario
    }

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();

    // Verificar existencia de codubi en la tabla ubicacion
    $sqlCheck = "SELECT COUNT(*) FROM ubicacion WHERE codubi = :codubi";
    $stmt = $conexion->prepare($sqlCheck);
    $stmt->bindParam(":codubi", $codubi);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    
    // Si existe, continuar con la inserción en la tabla bar
    $sql = "INSERT INTO bar (nombar, nompropi, nit, emabar, telbar, pssbar, dircbar, codubi, idper, idval, fotbar) 
            VALUES (:nombar, :nompropi, :nit, :emabar, :telbar, :pssbar, :dircbar, :codubi, :idper, :idval, :fotbar)";
    
    $result = $conexion->prepare($sql);

    $nombar = $this->getNombar();
    $result->bindParam(":nombar", $nombar);
    $nompropi = $this->getNompropi();
    $result->bindParam(":nompropi", $nompropi);
    $nit = $this->getNit();
    $result->bindParam(":nit", $nit);
    $emabar = $this->getEmabar();
    $result->bindParam(":emabar", $emabar);
    $telbar = $this->getTelbar();
    $result->bindParam(":telbar", $telbar);
    $pssbar = $this->getPssbar();
    $result->bindParam(":pssbar", $pssbar);
    $dircbar = $this->getDircbar();
    $result->bindParam(":dircbar", $dircbar);
    $result->bindParam(":codubi", $codubi);
    $result->bindParam(":idper", $idper);  // Asegurarse de que idper tenga un valor
    $idval = $this->getIdval();
    $result->bindParam(":idval", $idval);
    $fotbar = $this->getFotbar();
    $result->bindParam(":fotbar", $fotbar);
    $result->execute();
}


    public function edit() {
        $sql = "UPDATE bar SET nombar = :nombar, nompropi = :nompropi, nit = :nit, emabar = :emabar, telbar = :telbar, pssbar = :pssbar, dircbar = :dircbar, codubi = :codubi, idper = :idper, idval = :idval, fotbar = :fotbar  WHERE idbar = :idbar";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idbar = $this->getIdbar();
        $result->bindParam(":idbar", $idbar);
        $nombar = $this->getNombar();
        $result->bindParam(":nombar", $nombar);
        $nompropi = $this->getNompropi();
        $result->bindParam(":nompropi", $nompropi);
        $nit = $this->getNit();
        $result->bindParam(":nit", $nit);
        $emabar = $this->getEmabar();
        $result->bindParam(":emabar", $emabar);
        $telbar = $this->getTelbar();
        $result->bindParam(":telbar", $telbar);
        $pssbar = $this->getPssbar();
        $result->bindParam(":pssbar", $pssbar);
        $dircbar = $this->getDircbar();
        $result->bindParam(":dircbar", $dircbar);
        $codubi = $this->getCodubi();
        $result->bindParam(":codubi", $codubi);
        $idper = $this->getIdper();
        $result->bindParam(":idper", $idper);
        $idval = $this->getIdval();
        $result->bindParam(":idval", $idval);
        $fotbar = $this->getFotbar();
        $result->bindParam(":fotbar", $fotbar);
        $result->execute();
    }

    public function del() {
        $sql = "DELETE FROM bar WHERE idbar = :idbar";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idbar = $this->getIdbar();
        $result->bindParam(":idbar", $idbar);
        $result->execute();
    }
    public function getDep($codubi){
        $resultado = NULL;
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $sql="SELECT * FROM ubicacion WHERE codubi=:codubi
            ORDER BY nomubi";
        $result = $conexion->prepare($sql);
        $result->bindParam(":codubi", $codubi);
        $result->execute();
        $resultado=$result->fetchall(PDO::FETCH_ASSOC);
        return $resultado;
    }
}
?>