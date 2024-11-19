<?php 
class Mmenu {
    private $idpag;
	private $idper;
// Metodos GET devuelven el dato
	function getIdpag(){
		return $this->idpag;
	}
	function getIdper(){
		return $this->idper;
	}
// Metodos SET guardar el dato
	function setIdper($idper){
		$this->idper = $idper;
	}
	function setIdpag($idpag){
		$this->idpag = $idpag;
	}

    public function getMenu() {
        $sql = "SELECT p.idpag, p.nompag, p.rutpag, p.ordpag, p.icopag 
                FROM pagina AS p 
                INNER JOIN pagper AS f ON p.idpag = f.idpag 
                WHERE p.mospag=1 AND f.idper=:idper ORDER BY p.ordpag;";
        $modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idper = $this->getIdper();
		$result->bindParam(':idper',$idper);
		$result->execute();
		$res = $result ->fetchAll(PDO::FETCH_ASSOC);
		return $res;
    }

    public function getVal(){
		$sql = "SELECT p.idpag, p.nompag, p.rutpag, p.icopag, p.mospag FROM pagina AS p INNER JOIN pagper AS g ON p.idpag=g.idpag WHERE p.idpag=:idpag AND g.idper=:idper";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idper = $this->getIdper();
		$idpag = $this->getIdpag();
		$result->bindParam(':idper',$idper);
		$result->bindParam(':idpag',$idpag);
		$result->execute();
		$res = $res = $result ->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}
}
?>
