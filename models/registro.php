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
    private $idserv;
    private $idbar;
    private $nompropi;
    private $dircbar;
    private $horbar;

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
        return $this->codubi;
    }
    public function getIdper() {
        return $this->idper;
    }
    public function getIdval() {
        return $this->idval;
    }
    public function getIdserv() {
        return $this->idserv;
    }
    public function getIdbar() {
        return $this->idbar;
    }
    public function getNompropi() {
        return $this->nompropi;
    }
    public function getDircbar() {
        return $this->dircbar;
    }
    public function getHorbar() {
        return $this->horbar;
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
    public function setIdserv($idserv) {
        $this->idserv = $idserv;
    }
    public function setIdbar($idbar) {
        $this->idbar = $idbar;
    }
    public function setNompropi($nompropi) {
        $this->nompropi = $nompropi;
    }
    public function setDircbar($dircbar) {
        $this->dircbar = $dircbar;
    }
    public function setHorbar($horbar) {
        $this->horbar = $horbar;
    }

    // Métodos para la base de datos
    public function getAll() {
        $res = NULL;
        $sql = "SELECT 
                    u.idusu, u.nomusu, u.emausu, u.celusu, u.numdocu, u.fotiden, 
                    u.fecnausu, u.pssusu, u.codubi, u.idbar, u.idserv, u.idval, u.idper, 
                    b.nombar, b.nompropi, b.dircbar, b.horbar, 
                    s.nomserv, 
                    v.nomval, 
                    p.nomper, 
                    ub.nomubi 
                FROM usuario AS u
                INNER JOIN ubicacion AS ub ON u.codubi = ub.codubi
                INNER JOIN servicio AS s ON u.idserv = s.idserv
                INNER JOIN bar AS b ON u.idbar = b.idbar
                INNER JOIN valor AS v ON u.idval = v.idval
                INNER JOIN perfiles AS p ON u.idper = p.idper";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getOne() {
        $res = NULL;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['idusu'])) {
            $idusu = $_SESSION['idusu'];
            $sql = "SELECT 
                        u.idusu, u.nomusu, u.emausu, u.celusu, u.numdocu, u.fotiden, 
                        u.fecnausu, u.pssusu, u.codubi, u.idbar, u.idserv, u.idval, u.idper, 
                        b.nombar, b.nompropi, b.dircbar, b.horbar, 
                        s.nomserv, 
                        v.nomval, 
                        p.nomper, 
                        ub.nomubi 
                    FROM usuario AS u
                    INNER JOIN ubicacion AS ub ON u.codubi = ub.codubi
                    INNER JOIN servicio AS s ON u.idserv = s.idserv
                    INNER JOIN bar AS b ON u.idbar = b.idbar
                    INNER JOIN valor AS v ON u.idval = v.idval
                    INNER JOIN perfiles AS p ON u.idper = p.idper
                    WHERE u.idusu = :idusu";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":idusu", $idusu);
            $result->execute();
            $res = $result->fetch(PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function save() {
        $sql = "INSERT INTO usuario 
                    (nomusu, emausu, celusu, fotiden, numdocu, fecnausu, pssusu, codubi, idper, idval, idserv, idbar) 
                VALUES 
                    (:nomusu, :emausu, :celusu, :fotiden, :numdocu, :fecnausu, :pssusu, :codubi, :idper, :idval, :idserv, :idbar)";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":nomusu", $this->nomusu);
        $result->bindParam(":emausu", $this->emausu);
        $result->bindParam(":celusu", $this->celusu);
        $result->bindParam(":fotiden", $this->fotiden);
        $result->bindParam(":numdocu", $this->numdocu);
        $result->bindParam(":fecnausu", $this->fecnausu);
        $result->bindParam(":pssusu", $this->pssusu);
        $result->bindParam(":codubi", $this->codubi);
        $result->bindParam(":idper", $this->idper);
        $result->bindParam(":idval", $this->idval);
        $result->bindParam(":idserv", $this->idserv);
        $result->bindParam(":idbar", $this->idbar);
        $result->execute();
    }

    public function edit() {
        $sql = "UPDATE usuario SET 
                    nomusu=:nomusu, emausu=:emausu, celusu=:celusu, fotiden=:fotiden, 
                    numdocu=:numdocu, fecnausu=:fecnausu, pssusu=:pssusu, codubi=:codubi, 
                    idper=:idper, idval=:idval, idserv=:idserv, idbar=:idbar 
                WHERE idusu=:idusu";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $this->idusu);
        $result->bindParam(":nomusu", $this->nomusu);
        $result->bindParam(":emausu", $this->emausu);
        $result->bindParam(":celusu", $this->celusu);
        $result->bindParam(":fotiden", $this->fotiden);
        $result->bindParam(":numdocu", $this->numdocu);
        $result->bindParam(":fecnausu", $this->fecnausu);
        $result->bindParam(":pssusu", $this->pssusu);
        $result->bindParam(":codubi", $this->codubi);
        $result->bindParam(":idper", $this->idper);
        $result->bindParam(":idval", $this->idval);
        $result->bindParam(":idserv", $this->idserv);
        $result->bindParam(":idbar", $this->idbar);
        $result->execute();
    }

    public function delete() {
        $sql = "DELETE FROM usuario WHERE idusu=:idusu";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $this->idusu);
        $result->execute();
    }
}
?>
