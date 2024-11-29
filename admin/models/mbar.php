<?php
    class Mbar{
        //Atributos
        private $idusu;
        private $nomusu;    
        private $nompropi; 
        private $celusu;
        private $fotiden;
        private $emausu;
        private $pssusu;
        private $codubi;
        private $idper;
        private $idbar;
        private $dircbar;
        private $horbar;

        //Metodos get
        public function getIdusu(){
            return $this->idusu;
        }
        public function getNomusu(){
            return $this->nomusu;
        }
        public function getNompropi(){
            return $this->nompropi;
        }
        public function getCelusu(){
            return $this->celusu;
        }
        public function getFotiden(){
            return $this->fotiden;
        }
        public function getEmausu(){
            return $this->emausu;
        }
        public function getPssusu(){
            return $this->pssusu;
        }
        public function getCodubi(){
            return $this->codubi;
        }
        public function getIdper(){
            return $this->idper;
        }
        public function getIdbar(){
            return $this->idbar;
        }
        public function getDircbar(){
            return $this->dircbar;
        }
        public function getHorbar(){
            return $this->horbar;
        }

        //Metodo set
        public function setIdusu($idusu){
            $this->idusu = $idusu;
        }
        public function setNomusu($nomusu){
            $this->nomusu = $nomusu;
        }
        public function setNompropi($nompropi){
            $this->nompropi = $nompropi;
        }
        public function setCelusu($celusu){
            $this->celusu = $celusu;
        }
        public function setFotiden($fotiden){
            $this->fotiden = $fotiden;
        }
        public function setEmausu($emausu){
            $this->emausu = $emausu;
        }
        public function setPssusu($pssusu){
            $this->pssusu = $pssusu;
        }
        public function setCodubi($codubi){
            $this->codubi = $codubi;
        }
        public function setIdper($idper){
            $this->idper = $idper;
        }
        public function setIdbar($idbar){
            $this->idbar = $idbar;
        } 
        public function setDircbar($dircbar){
            $this->dircbar = $dircbar;
        }
        public function setHorbar($horbar){ 
            $this->horbar = $horbar;
        }

        //Metodo publicos
        public function getAll(){
            $sql="SELECT idusu, nomusu, emausu, celusu, fotiden, numdocu, pssusu, codubi, idper, idbar, nompropi, dircbar, horbar FROM usuario WHERE idper=30";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res=$result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function getOne(){
            $sql="SELECT idusu, nomusu, emausu, celusu, fotiden, numdocu, pssusu, codubi, idper, idbar, nompropi, dircbar, horbar FROM usuario WHERE idusu=:idusu ";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idusu = $this->getIdusu();
            $result->bindParam(":idusu", $idusu);
            $result->execute();
            $res=$result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function save(){
            $sql = "INSERT INTO usuario (nomusu, nompropi, celusu, fotiden, emausu, pssusu, codubi, idper, idbar, nompropi, dircbar, horbar) VALUES (:nomusu, :nompropi,:celusu, :fotiden, :emausu, :pssusu, :codubi, :idper, :idbar, :nompropi, :dircbar, :horbar)";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nomusu = $this->getNomusu();
            $result->bindParam(":nomusu", $nomusu);
            $nompropi = $this->getNompropi();
            $result->bindParam(":nompropi", $nompropi);
            $celusu = $this->getCelusu();
            $result->bindParam(":celusu", $celusu);
            $fotiden = $this->getFotiden();
            $result->bindParam(":fotiden", $fotiden);
            $emausu = $this->getEmausu();
            $result->bindParam(":emausu", $emausu);
            $pssusu = $this->getPssusu();
            $result->bindParam(":pssusu", $pssusu);
            $codubi = $this->getCodubi();
            $result->bindParam(":codubi", $codubi);
            $idper = $this->getIdper();
            $result->bindParam(":idper", $idper);
            $idbar = $this->getIdbar();
            $result->bindParam(":idbar", $idbar);
            $nompropi = $this->getNompropi();
            $result->bindParam(":nompropi", $nompropi);
            $dircbar = $this->getDircbar();
            $result->bindParam(":dircbar", $dircbar);
            $horbar = $this->getHorbar();
            $result->bindParam(":horbar", $horbar);
            $result->execute();
        }
        
        public function edit(){
            $sql = "UPDATE usuario SET nomusu=:nomusu, nompropi=:nompropi, celusu=:celusu, fotiden=:fotiden, emausu=:emausu, pssusu=:pssusu, codubi=:codubi, idbar=:idbar, nompropi=:nompropi, dircbar=:dircbar, horbar=:horbar WHERE idusu=:idusu";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idusu = $this->getIdusu();
            $result->bindParam(":idusu", $idusu);
            $nomusu = $this->getNomusu();
            $result->bindParam(":nomusu", $nomusu);
            $nompropi = $this->getNompropi();
            $result->bindParam(":nompropi", $nompropi);
            $celusu = $this->getCelusu();
            $result->bindParam(":celusu", $celusu);
            $fotiden = $this->getFotiden();
            $result->bindParam(":fotiden", $fotiden);
            $emausu = $this->getEmausu();
            $result->bindParam(":emausu", $emausu);
            $pssusu = $this->getPssusu();
            $result->bindParam(":pssusu", $pssusu);
            $codubi = $this->getCodubi();
            $result->bindParam(":codubi", $codubi);
            $idbar = $this->getIdbar();
            $result->bindParam(":idbar", $idbar);
            $nompropi = $this->getNompropi();
            $result->bindParam(":nompropi", $nompropi);
            $dircbar = $this->getDircbar();
            $result->bindParam(":dircbar", $dircbar);
            $horbar = $this->getHorbar();
            $result->bindParam(":horbar", $horbar);
            $result->execute();
        }

        public function del(){
            $sql = "DELETE FROM usuario WHERE idusu=:idusu";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idusu = $this->getIdusu();
            $result->bindParam(":idusu", $idusu);
            $result->execute();
        }
    }

?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert@1.1.3/dist/sweetalert.min.js"></script>