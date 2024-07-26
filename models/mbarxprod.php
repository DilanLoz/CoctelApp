<?php
class Mbarxprod{

	private $idprod;
	private $nomprod;
	private $desprod;
	private $vlrprod;
	private $fotprod;
	private $idval;
	private $idbar;
	private $cantprod;
	private $idserv;
	private $idusu;
	//

	public function getIdprod(){
		return $this->idprod;
	}
	public function getNomprod(){
		return $this->nomprod;
	}
	public function getDesprod(){
		return $this->desprod;
	}
	public function getVlrprod(){
		return $this->vlrprod;
	}
	public function getFotprod(){
		return $this->fotprod;
	}
	public function getIdval(){
		return $this->idval;
	}
	public function getIdbar(){
		return $this->idbar;
	}
	public function getCantprod(){
		return $this->cantprod;
	}
	public function getIdserv(){
		return $this->idserv;
	}
	public function getIdusu(){
		return $this->idusu;
	}

	public function setIdprod($idprod){
		$this->idprod = $idprod;
	}
	public function setNomprod($nomprod){
		$this->nomprod = $nomprod;
	}
	public function setDesprod($desprod){
		$this->desprod = $desprod;
	}
	public function setVlrprod($vlrprod){
		$this->vlrprod = $vlrprod;
	}
	public function setFotprod($fotprod){
		$this->fotprod = $fotprod;
	}
	public function setIdval($idval){
		$this->idval = $idval;
	}
	public function setIdbar($idbar){
		$this->idbar = $idbar;
	}
	public function setCantprod($cantprod){
		$this->cantprod = $cantprod;
	}
	public function setIdserv($idserv){
		$this->idserv = $idserv;
	}
	public function setIdusu($idusu){
		$this->idusu = $idusu;
	}

//Factura
	function getAll(){
		try{
			$sql = "SELECT idprod, nomprod, desprod, vlrprod, fotprod, idval, idbar, cantprod, idserv, idusu FROM producto";
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$result->execute();
			$res = $result->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}catch(Exception $e){
			echo "Error: ".$e;
		}
	}

	function getOne(){
		try{
			$sql = "SELECT idprod, nomprod, desprod, vlrprod, fotprod, idval, idbar, cantprod, idserv, idusu FROM producto WHERE idprod=:idprod";
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$idprod = $this->getIdprod();
			$result->bindParam(":idprod",$idprod);
			$result->execute();
			/*echo $sql." ".$idprod;
			die();*/
			$res = $result->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}catch(Exception $e){
			echo "Error: ".$e;
		}
	}
	function save(){
		try{
			$sql="INSERT INTO producto (nomprod, desprod, vlrprod, fotprod, idval, idbar, cantprod, idserv, idusu) VALUES (:nomprod, :desprod, :vlrprod, :fotprod, :idval, :idbar, :cantprod, :idserv, :idusu)";
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$nomprod = $this->getNomprod();
			$result->bindParam(":nomprod",$nomprod);
			$desprod = $this->getDesprod();
			$result->bindParam(":desprod",$desprod);
			$vlrprod = $this->getVlrprod();
			$result->bindParam(":vlrprod",$vlrprod);
			$fotprod = $this->getFotprod();
			$result->bindParam(":fotprod",$fotprod);
			$idval = $this->getIdval();
			$result->bindParam(":idval",$idval);
			$idbar = $this->getIdbar();
			$result->bindParam(":idbar",$idbar);
			$cantprod = $this->getCantprod();
			$result->bindParam(":cantprod",$cantprod);
			$idserv = $this->getIdserv();
			$result->bindParam(":idserv",$idserv);
			$idusu = $this->getIdusu();
			$result->bindParam(":idusu",$idusu);
			$result->execute();
		}catch(Exception $e){
			echo "Error: ".$e;
		}
	}

	function edit(){
		try{
			$sql="UPDATE producto SET nomprod=:nomprod, desprod=:desprod, vlrprod=:vlrprod, fotprod=:fotprod, idval=:idval, idbar=:idbar, cantprod=:cantprod, idserv=:idserv, idusu=:idusu WHERE idprod=:idprod";
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$idprod = $this->getIdprod();
			$result->bindParam(":idprod",$idprod);
			$nomprod = $this->getNomprod();
			$result->bindParam(":nomprod",$nomprod);
			$desprod = $this->getDesprod();
			$result->bindParam(":desprod",$desprod);
			$vlrprod = $this->getVlrprod();
			$result->bindParam(":vlrprod",$vlrprod);
			$fotprod = $this->getFotprod();
			$result->bindParam(":fotprod",$fotprod);
			$idval = $this->getIdval();
			$result->bindParam(":idval",$idval);
			$idbar = $this->getIdbar();
			$result->bindParam(":idbar",$idbar);
			$cantprod = $this->getCantprod();
			$result->bindParam(":cantprod",$cantprod);
			$idserv = $this->getIdserv();
			$result->bindParam(":idserv",$idserv);
			$idusu = $this->getIdusu();
			$result->bindParam(":idusu",$idusu);
			$result->execute();
		}catch(Exception $e){
			echo "Error: ".$e;
		}
	}

	function del(){
		try{
			$sql="DELETE FROM producto WHERE idprod=:idprod";
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$idprod = $this->getIdprod();
			$result->bindParam(":idprod",$idprod);
			$result->execute();
		}catch(Exception $e){
			echo "Error: ".$e;
		}
	}
}	
?>