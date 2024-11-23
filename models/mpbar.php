<?php
class Mpbar {
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
    private $horbar; // Nueva propiedad para la hora de apertura

    // Métodos getter y setter
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
    public function getHorbar() {
        return $this->horbar; // Getter para hora de apertura
    }

    // Métodos setter
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
    public function setHorbar($horbar) {
        $this->horbar = $horbar; // Setter para hora de apertura
    }

    // Obtener todos los bares
    public function getAll() {
        $res = NULL;
        $sql = "SELECT idbar, nombar, nompropi, nit, emabar, telbar, pssbar, dircbar, codubi, idper, idval, horbar 
                FROM bar";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    // Obtener un solo bar
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

    // Guardar un bar
    public function save() {
        $sql = "INSERT INTO bar (nombar, nompropi, nit, emabar, telbar, pssbar, dircbar, codubi, idper, idval, horbar) 
                VALUES (:nombar, :nompropi, :nit, :emabar, :telbar, :pssbar, :dircbar, :codubi, :idper, :idval, :horbar)";
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
        $horbar = $this->getHorbar(); // Hora de apertura
        $result->bindParam(":horbar", $horbar);
        $result->execute();
    }

    // Editar un bar
    public function edit() {
        $sql = "UPDATE bar SET nombar = :nombar, nompropi = :nompropi, nit = :nit, emabar = :emabar, telbar = :telbar, 
                pssbar = :pssbar, dircbar = :dircbar, codubi = :codubi, idper = :idper, idval = :idval, horbar = :horbar 
                WHERE idbar = :idbar";
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
        $horbar = $this->getHorbar(); // Hora de apertura
        $result->bindParam(":horbar", $horbar);
        $result->execute();
    }

    // Eliminar un bar
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
