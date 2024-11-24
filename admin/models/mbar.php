<?php
class Mbar {
    //bar
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
    private $horbar;

    // ubicacion
    private $nomubi;
    private $depubi;
    // Valor
    private $iddom;
    private $nomval;
    // Método para obtener todos los bares
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
    public function getHorbar() {
        return $this->horbar;
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
    //Metodos get ubi
    public function getNomubi() {
        return $this->nomubi;
    }
    public function getDepubi() {
        return $this->depubi;
    }
    //Metodos get val
    public function getIddom() {
        return $this->iddom;
    }
    public function getNomval() {
        return $this->nomval;
    }
    //Metodos set bar
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
    public function setHorbar($horbar) {
        $this->horbar = $horbar;
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
    public function setNomubi($nomubi) {
        $this->nomubi = $nomubi;
    }
    //Metodos set ubi
    public function setDepubi($depubi) {
        $this->depubi = $depubi;
    }
    //Metodos set Val
    public function setIddom($iddom) {
        $this->iddom = $iddom;
    }
    public function setNomval($nomval) {
        $this->nomval = $nomval;
    }




    public function getAll() {
    	$res = NULL;
    	$sql = "SELECT b.idbar, b.nombar, b.nompropi, b.nit, b.emabar, b.telbar, b.pssbar, b.dircbar, b.horbar, v.iddom, v.nomval, b.codubi, u.nomubi, u.depubi, b.idper, b.idval, b.fotbar FROM bar AS b INNER JOIN ubicacion AS u ON b.codubi=u.codubi LEFT JOIN valor AS v ON b.idval=v.idval";
    	$modelo = new Conexion();
    	$conexion = $modelo->get_conexion();
    	$result = $conexion->prepare($sql);
    	$result->execute();
    	$res = $result->fetchAll(PDO::FETCH_ASSOC);
   	 	return $res;
}
//Tabla ubi
public function getAllCiu()
{
    $sql = "SELECT codubi, nomubi, depubi FROM ubicacion"; // Ajusta el nombre de la tabla
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->execute();
    $res = $result->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}
//tabla valor
public function getAllVal() {
        $res = NULL;
        $sql = "SELECT idval, iddom, nomval  FROM valor";
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
    try {
        $sql = "INSERT INTO bar (nombar, nompropi, nit, emabar, telbar, pssbar, dircbar, codubi, idper, idval, horbar, fotbar, nomubi) 
                VALUES (:nombar, :nompropi, :nit, :emabar, :telbar, :pssbar, :dircbar, :codubi, :idper, :idval, :horbar, :fotbar, :nomubi)";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
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

        $codubi = $this->getCodubi();
        $result->bindParam(":codubi", $codubi);

        $idper = $this->getIdper();
        $result->bindParam(":idper", $idper);

        $idval = $this->getIdval();
        $result->bindParam(":idval", $idval);

        $horbar = $this->getHorbar();
        $result->bindParam(":horbar", $horbar);

        $fotbar = $this->getFotbar();
        $result->bindParam(":fotbar", $fotbar);

        $nomubi = $this->getNomubi();
        $result->bindParam(":nomubi", $nomubi);

        $result->execute();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

    public function edit() {
        $sql = "UPDATE bar SET nombar = :nombar, nompropi = :nompropi, nit = :nit, emabar = :emabar, telbar = :telbar, pssbar = :pssbar, dircbar = :dircbar, codubi = :codubi, idper = :idper, idval = :idval, horbar = :hornar, fotbar = :fotbar, nomubi = :nomubi  WHERE idbar = :idbar";
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
        $horbar = $this->getHorbar();
        $result->bindParam(":horbar", $horbar);
        $fotbar = $this->getFotbar();
        $result->bindParam(":fotbar", $fotbar);
        $nomubi = $this->getNomubi();
        $result->bindParam(":nomubi", $nomubi);
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
    
}
?>