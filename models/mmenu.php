<?php
include_once 'conexion.php';
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
    $modelo = new conexion();
    $conexion = $modelo->get_conexion();
    $sql = "SELECT p.idpag, p.nompag, p.rutpag, p.mospag, p.ordpag, p.icopag 
            FROM pagina AS p 
            INNER JOIN pagper AS f ON p.idpag=f.idpag ";
    $result = $conexion->prepare($sql);
    $result->execute();
    $resultado = $result->fetchall(PDO::FETCH_ASSOC);
    return $resultado;
}

	public function getVal(){
		$resultado = NULL;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql="SELECT p.idpag, p.nompag, p.rutpag, p.mospag, p.ordpag, p.icopag FROM pagina AS p INNER JOIN pagper AS f ON p.idpag=f.idpag AND p.idpag=:idpag";
		$result = $conexion->prepare($sql);
		$idpag = $this->getIdpag();
		$result->bindParam(":idpag",$idpag);
		$result->execute();
		$resultado=$result->fetchall(PDO::FETCH_ASSOC);
		return $resultado;
	}
}
?>