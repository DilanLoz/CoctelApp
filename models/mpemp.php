<?php
class Mpemp{

	//Tabla perfiles
	private $idper;
	private $nomper;
	private $pagini;
	//Tabla empleado
	private $idemp;
	private $nomemp;
	private $emaemp;
	private $celemp;
	private $fecnaemp;
	private $numdocu;
	private $fotiden;
	private $pssemp;
	private $idserv;
	private $idbar;
	private $codubi;
	private $idval;

	//metodos get perfiles
	public function getIdper(){
		return $this->idper;
	}
	public function getNomper(){
		return $this->nomper;
	}
	public function getPagini(){
		return $this->pagini;
	}

	//metodos get empleado
	public function getIdemp(){
		return $this->idemp;
	}
	public function getNomemp(){
		return $this->nomemp;
	}
	public function getEmaemp(){
		return $this->emaemp;
	}
	public function getCelemp(){
		return $this->celemp;
	}
	public function getFecnaemp(){
		return $this->fecnaemp;
	}
	public function getNumdocu(){
		return $this->numdocu;
	}
	public function getFotiden(){
		return $this->fotiden;
	}
	public function getPssemp(){
		return $this->pssemp;
	}
	public function getIdserv(){
		return $this->idserv;
	}
	public function getIdbar(){
		return $this->idbar;
	}
	public function getCodubi(){
		return $this->codubi;
	}
	public function getIdval(){
		return $this->idval;
	}

	//metodo set perfiles
	public function setIdper($idper){
		$this->idper = $idper;
	}
	public function setNomper($nomper){
		$this->nomper = $nomper;
	}
	public function setPagini($pagini){
		$this->pagini = $pagini;
	}

	//metodos set empleado
	public function setIdemp($idemp){
		$this->idemp = $idemp;
	}
	public function setNomemp($nomemp){
		$this->nomemp = $nomemp;
	}
	public function setEmaemp($emaemp){
		$this->emaemp = $emaemp;
	}
	public function setCelemp($celemp){
		$this->celemp = $celemp;
	}
	public function setFecnaemp($fecnaemp){
		$this->fecnaemp = $fecnaemp;
	}
	public function setNumdocu($numdocu{
		$this->numdocu = $numdocu;
	}
	public function setFotiden($fotiden){
		$this->fotiden = $fotiden;
	}
	public function setPssemp($pssemp){
		$this->pssemp = $pssemp;
	}
	public function setIdserv($idserv){
		$this->idserv = $idserv;
	}
	public function setIdbar($idbar){
		$this->idbar = $idbar;
	}
	public function setCodubi($codubi){
		$this->codubi = $codubi;
	}
	public function setIdval($idval){
		$this->idval = $idval;
	}

	//Funciones empleado
	function getAllEmp(){
		try{
			$sql = "SELECT idemp, nomemp, emaemp, celemp, fecnaemp, numdocu, fotiden, pssemp, idserv, idbar, codubi, idval FROM empleado";
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
	function getOneEmp(){
		try{
			$sql = "SELECT idemp, nomemp, emaemp, celemp, fecnaemp, numdocu, fotiden, pssemp, idserv, idbar, codubi, idval FROM empleado WHERE idemp=:idemp";
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$idemp = $this->getIdemp();
			$result->bindParam(":idemp",$idemp);
			$result->execute();
			/*echo $sql." ".$idemp;
			die();*/
			$res = $result->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}catch(Exception $e){
			echo "Error: ".$e;
		}
	}
	function saveEmp(){
		try{
			$sql="INSERT INTO empleado (nomemp, emaemp, celemp, fecnaemp, numdocu, fotiden, pssemp, idserv, idbar, codubi, idval) VALUES (:nomemp, :emaemp, :celemp, :fecnaemp, :numdocu, :fotiden, :pssemp, :idserv, :idbar, :codubi, :idval)";
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$nomemp = $this->getNomemp();
			$result->bindParam(":nomemp",$nomemp);
			$emaemp = $this->getEmaemp();
			$result->bindParam(":emaemp",$emaemp);
			$celemp = $this->getCelemp();
			$result->bindParam(":celemp",$celemp);
			$fecnaemp = $this->getFecnaemp();
			$result->bindParam(":fecnaemp",$fecnaemp);
			$numdocu = $this->getnumdocu();
			$result->bindParam(":numdocu",$numdocu);
			$fotiden = $this->getFotiden();
			$result->bindParam(":fotiden",$fotiden);
			$pssemp = $this->getPssemp();
			$result->bindParam(":pssemp",$pssemp);
			$idserv = $this->getIdserv();
			$result->bindParam(":idserv",$idserv);
			$idbar = $this->getIdbar();
			$result->bindParam(":idbar",$idbar);
			$codubi = $this->getCodubi();
			$result->bindParam(":codubi",$codubi);
			$idval = $this->getIdval();
			$result->bindParam(":idval",$idval);
			$result->execute();
		}catch(Exception $e){
			echo "Error: ".$e;
		}
	}

	function editEmp(){
		try{
			$sql="UPDATE empleado SET nomemp=:nomemp, emaemp=:emaemp, celemp=:celemp, fecnaemp=:fecnaemp, pssemp=:pssemp, numdocu=:numdocu, fotiden=:fotiden, idserv=:idserv, idbar=:idbar, codubi=:codubi, idval=:idval; WHERE idemp=:idemp";
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$idemp = $this->getIdemp();
			$result->bindParam(":idemp",$idemp);
			$nomemp = $this->getNomemp();
			$result->bindParam(":nomemp",$nomemp);
			$emaemp = $this->getEmaemp();
			$result->bindParam(":emaemp",$emaemp);
			$celemp = $this->getCelemp();
			$result->bindParam(":celemp",$celemp);
			$fecnaemp = $this->getFecnaemp();
			$result->bindParam(":fecnaemp",$fecnaemp);
			$numdocu = $this->getnumdocu();
			$result->bindParam(":numdocu",$numdocu);
			$fotiden = $this->getFotiden();
			$result->bindParam(":fotiden",$fotiden);
			$pssemp = $this->getPssemp();
			$result->bindParam(":pssemp",$pssemp);
			$idserv = $this->getIdserv();
			$result->bindParam(":idserv",$idserv);
			$idbar = $this->getIdbar();
			$result->bindParam(":idbar",$idbar);
			$codubi = $this->getCodubi();
			$result->bindParam(":codubi",$codubi);
			$idval = $this->getIdval();
			$result->bindParam(":idval",$idval);
			$result->execute();
		}catch(Exception $e){
			echo "Error: ".$e;
		}
	}

	function delEmp(){
		try{
			$sql="DELETE FROM empleado WHERE idemp=:idemp";
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$idemp = $this->getIdemp();
			$result->bindParam(":idemp",$idemp);
			$result->execute();
		}catch(Exception $e){
			echo "Error: ".$e;
		}
	}

	//Funciones perfiles
	function getAllPer(){
		try{
			$sql = "SELECT idper, nomper, pagini FROM perfiles";
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
	function getOnePer(){
		try{
			$sql = "SELECT idper, nomper, pagini FROM perfiles WHERE idper=:idper";
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$idper = $this->getIdper();
			$result->bindParam(":idper",$idper);
			$result->execute();
			/*echo $sql." ".$idemp;
			die();*/
			$res = $result->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		}catch(Exception $e){
			echo "Error: ".$e;
		}
	}
	function savePer(){
		try{
			$sql="INSERT INTO perfiles (nomper, pagini) VALUES (:nomper, :pagini)";
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$nomper = $this->getNomper();
			$result->bindParam(":nomper",$nomper);
			$pagini = $this->getPagini();
			$result->bindParam(":pagini",$pagini);
			$result->execute();
		}catch(Exception $e){
			echo "Error: ".$e;
		}
	}
	function editPer(){
		try{
			$sql="UPDATE perfiles SET nomper=:nomper, pagini=:pagini WHERE idper=:idper";
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$idper = $this->getIdper();
			$result->bindParam(":idper",$idper);
			$nomper = $this->getNomper();
			$result->bindParam(":nomper",$nomper);
			$pagini = $this->getPagini();
			$result->bindParam(":pagini",$pagini);
			$result->execute();
		}catch(Exception $e){
			echo "Error: ".$e;
		}
	}
	function delPer(){
		try{
			$sql="DELETE FROM perfiles WHERE idper=:idper";
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$idper = $this->getIdper();
			$result->bindParam(":idper",$idper);
			$result->execute();
		}catch(Exception $e){
			echo "Error: ".$e;
		}
	}

}	
?>