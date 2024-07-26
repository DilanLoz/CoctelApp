<?php
class Mpbar {
    private $idbar;
    private $nombar;
    private $nit;
    private $telbar;
    private $pssbar;
    private $dircbar;
    private $nompro;

    public function getIdbar() {
        return $this->idbar;
    }
    public function getNombar() {
        return $this->nombar;
    }
    public function getNit() {
        return $this->nit;
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
    public function getNompro() {
        return $this->nompro;
    }

    public function setIdbar($idbar) {
        $this->idbar = $idbar;
    }
    public function setNombar($nombar) {
        $this->nombar = $nombar;
    }
    public function setNit($nit) {
        $this->nit = $nit;
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
    public function setNompro($nompro) {
        $this->nompro = $nompro;
    }

    public function getAll() {
        $res = NULL;
        $sql = "SELECT * FROM bares";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getOne() {
        $res = NULL;
        $sql = "SELECT * FROM bares WHERE idbar = :idbar";
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
        $sql = "INSERT INTO bares (nombar, nit, telbar, pssbar, dircbar, nompro) VALUES (:nombar, :nit, :telbar, :pssbar, :dircbar, :nompro)";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $nombar = $this->getNombar();
        $result->bindParam(":nombar", $nombar);
        $nit = $this->getNit();
        $result->bindParam(":nit", $nit);
        $telbar = $this->getTelbar();
        $result->bindParam(":telbar", $telbar);
        $pssbar = $this->getPssbar();
        $result->bindParam(":pssbar", $pssbar);
        $dircbar = $this->getDircbar();
        $result->bindParam(":dircbar", $dircbar);
        $nompro = $this->getNompro();
        $result->bindParam(":nompro", $nompro);
        $result->execute();
    }

    public function edit() {
        $sql = "UPDATE bares SET nombar = :nombar, nit = :nit, telbar = :telbar, pssbar = :pssbar, dircbar = :dircbar, nompro = :nompro WHERE idbar = :idbar";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idbar = $this->getIdbar();
        $result->bindParam(":idbar", $idbar);
        $nombar = $this->getNombar();
        $result->bindParam(":nombar", $nombar);
        $nit = $this->getNit();
        $result->bindParam(":nit", $nit);
        $telbar = $this->getTelbar();
        $result->bindParam(":telbar", $telbar);
        $pssbar = $this->getPssbar();
        $result->bindParam(":pssbar", $pssbar);
        $dircbar = $this->getDircbar();
        $result->bindParam(":dircbar", $dircbar);
        $nompro = $this->getNompro();
        $result->bindParam(":nompro", $nompro);
        $result->execute();
    }

    public function del() {
        $sql = "DELETE FROM bares WHERE idbar = :idbar";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idbar = $this->getIdbar();
        $result->bindParam(":idbar", $idbar);
        $result->execute();
    }
}
?>
