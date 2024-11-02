<?php 
class Mpusu{
	//`idusu nomusu emausu celusu fotiden numdocu fecnausu pssusu codubi idper idval
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
	//metodos get
	public function getIdusu(){
		return $this->idusu;
	}
	public function getNomusu(){
		return $this->nomusu;
	}
	public function getEmausu(){
		return $this->emausu;
	}
	public function getCelusu(){
		return $this->celusu;
	}
	public function getFotiden(){
		return $this->fotiden;
	}
    public function getNumdocu(){
		return $this->numdocu;
	}
    public function getFecnausu(){
		return $this->fecnausu;
	}
    public function getPssusu(){
		return $this->pssusu;
	}
    public function getCodubi(){
		return $this->fotiden;
	}
    public function getIdper(){
		return $this->idper;
	}
    public function getIdval(){
		return $this->idval;
	}

	//metodos SET
    public function setIdusu($idusu){
        $this->idusu;
    }
    public function setNomusu($nomusu){
        $this->nomusu;
    }
    public function setEmausu($emausu){
        $this->emausu;
    }
    public function setCelusu($celusu){
        $this->celusu;
    }
    public function setFotiden($fotiden){
        $this->fotiden;
    }
    public function setNumdocu($numdocu){
        $this->numdocu;
    }
    public function setFecnausu($fecnausu){
        $this->fecnausu;
    }
    public function setPssusu($pssusu){
        $this->pssusu;
    }
    public function setCodubi($codubi){
        $this->codubi;
    }
    public function setIdper($idper){
        $this->idper;
    }
    public function setIdval($idval){
        $this->idval;
    }

	//metodos publicos
	public function getAll(){
		$res = NULL;
		$sql = "SELECT * FROM usuario";
		$modelo = new Conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res= $result->fetchall(PDO::FETCH_ASSOC);
		return $res;
	}
	public function getOne(){
		$res = NULL;
		$sql = "SELECT * FROM usuario WHERE idusu=:idusu";
		$modelo = new Conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idusu = $this->getIdusu();
		$result->bindParam(":idusu", $idusu);
		$result->execute();
		$res= $result->fetchall(PDO::FETCH_ASSOC);
		return $res;
	}
	public function save(){
		$sql = "INSERT INTO usuario (nomusu, emausu, celusu, pssusu, codubi, idper, idval) VALUES (:nomusu, :emausu, :celusu, :pssusu, :codubi, :idper, :idval)";
		$modelo = new Conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$nomusu = $this->getNomusu();
		$result->bindParam(":nomusu", $nomusu);
		$emausu = $this->getEmausu();
		$result->bindParam(":emausu", $emausu);
		$celusu = $this->getCelusu();
		$result->bindParam(":celusu", $celusu);
		$pssusu = $this->getPssusu();
		$result->bindParam(":pssusu", $pssusu);
        $codubi = $this->getCodubi();
		$result->bindParam(":codubi", $codubi);
        $idper = $this->getIdper();
		$result->bindParam(":idper", $idper);
        $idval = $this->getIdval();
		$result->bindParam(":idval", $idval);
    	$result->execute();
	}
	public function edit(){
        $sql = "UPDATE usuario SET nomusu=:nomusu, emausu=:emausu, celusu=:celusu, pssusu=:pssusu, codubi=:codubi, idper=:idper, idval=:idval WHERE idusu=:idusu";
		$modelo = new Conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idusu = $this->getIdusu();
		$result->bindParam(":idusu", $idusu);
		$nomusu = $this->getNomusu();
		$result->bindParam(":nomusu", $nomusu);
		$emausu = $this->getEmausu();
		$result->bindParam(":emausu", $emausu);
		$celusu = $this->getCelusu();
		$result->bindParam(":celusu", $celusu);
		$pssusu = $this->getPssusu();
		$result->bindParam(":pssusu", $pssusu);
        $codubi = $this->getCodubi();
		$result->bindParam(":codubi", $codubi);
        $idper = $this->getIdper();
		$result->bindParam(":idper", $idper);
        $idval = $this->getIdval();
		$result->bindParam(":idval", $idval);
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