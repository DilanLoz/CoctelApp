<?php
class Mperf {

    private $idper;
    private $nomper;
    private $pagini;
    private $idpag;
    public function getIdper() {
        return $this->idper;
    }

    public function getNomper() {
        return $this->nomper;
    }
    
    public function getIdpag() {
        return $this->idpag;
    }
    public function getPagini() {
        return $this->pagini;
    }
    
    //metodos set
    public function setNomper($nomper) {
        $this->nomper = $nomper;
    }
    public function setIdper($idper) {
        $this->idper = $idper;
    }
    public function setPagini($pagini) {
        $this->pagini = $pagini;
    }
    public function setIdpag($idpag) {
        $this->idpag = $idpag;
    }
    // Consultas
    function getAll() {
        $sql = "SELECT p.idper, p.nomper, p.pagini, g.idpag, g.titupag 
                FROM perfiles AS p 
                LEFT JOIN pagina AS g ON p.idpag = g.idpag 
                ORDER BY p.idper ASC";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getOne() {
        $sql = "SELECT p.idper, p.nomper, p.idpag, g.titupag 
                FROM perfiles AS p 
                INNER JOIN pagina AS g ON g.idpag = p.idpag 
                WHERE p.idper = :idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idper = $this->getIdper();
        $result->bindParam(":idper", $idper);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
    function save(){
        $sql = "INSERT INTO perfiles (nomper,  idpag) VALUES (:nomper, :idpag)";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $nomper= $this->getNomper();
        $result->bindParam(":nomper",$nomper);
        $idpag= $this->getIdpag();
        $result->bindParam(":idpag",$idpag);
        $result->execute();                        
    }
    function edit(){
        $sql = "UPDATE perfiles SET nomper=:nomper, idpag=:idpag WHERE idper=:idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idper= $this->getIdper();
        $result->bindParam(":idper",$idper);
        $nomper= $this->getNomper();
        $result->bindParam(":nomper",$nomper);
        $idpag= $this->getIdpag();
        $result->bindParam(":idpag",$idpag);
        $result->execute();
    }
    function del(){
        $sql = "DELETE FROM perfiles WHERE idper=:idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idper= $this->getIdper();
        $result->bindParam(":idper",$idper);
        $result->execute();
    }
    function getPag(){
        $sql = "SELECT idpag, titupag, icopag FROM pagina";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);            
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
    
    function getPxP(){
        $sql = "SELECT idpag FROM pagper WHERE idper=:idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idper= $this->getIdper();
        $result->bindParam(":idper",$idper);            
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
        
    } 
    function delPxP(){
        $sql = "DELETE FROM pagper WHERE idper=:idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idper= $this->getIdper();
        $result->bindParam(":idper",$idper);
        $result->execute();
    }
    function savePxP(){
        $sql = "INSERT INTO pagper (idpag,idper) VALUES (:idpag,:idper);";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idper= $this->getIdper();
        $result->bindParam(":idper",$idper);
        $idpag= $this->getIdpag();
        $result->bindParam(":idpag",$idpag);
        $result->execute();
    }
    }
?>