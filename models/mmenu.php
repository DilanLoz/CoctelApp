<?php 
    class Mmenu{
        private $idpag;
        function getIdpag(){
            return $this->idpag;
        }
        function setIdpag($idpag){
            $this->idpag = $idpag;
        }
    public function getMenu(){
        $resultado = NULL;
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $sql="SELECT p.idpag, p.nompag, p.rutpag, p.mospag, p.ordpag, p.icopag FROM pagina AS p INNER JOIN pagper AS f ON p.idpag=f.idpag WHERE f.idper=:idper";
        $result = $conexion->prepare($sql);
        $idper = isset($_SESSION['idper']) ? $_SESSION['idper']:0;
        $result->bindParam(":idper",$idper);
        $result->execute();
        $resultado=$result->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
        }
    
        public function getVal(){
            $resultado = NULL;
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $sql="SELECT p.idpag, p.nompag, p.rutpag, p.mospag, p.ordpag, p.icopag FROM pagina AS p INNER JOIN pagper AS f ON p.idpag=f.idpag WHERE f.idper=:idper AND p.idpag=:idpag";
            $result = $conexion->prepare($sql);
            $idper = isset($_SESSION['idper']) ? $_SESSION['idper']:0; 
            $result->bindParam(":idper",$idper);
            $idpag = $this->getIdpag();
            $result->bindParam(":idpag",$idpag);
            $result->execute();
            $resultado=$result->fetchall(PDO::FETCH_ASSOC);
            return $resultado;
        }
}
?>