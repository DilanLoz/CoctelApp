<?php

class Mbarxem{

    //atributos
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
	private $idper;
	private $idval;

    //Metodos get

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
	public function getIdper(){
		return $this->idper;
	}
	public function getIdval(){
		return $this->idval;
	}





    //Metodos Set

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
	public function setNumdocu($numdocu){
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
	public function setIdper($idper){
		$this->idper = $idper;
	}
	public function setIdval($idval){
		$this->idval = $idval;
	}

    //Funciones
    public function getAll() {
		$res = NULL;
		$sql = "SELECT 
					e.idemp, e.nomemp, e.emaemp, e.celemp, e.fecnaemp, e.numdocu, 
					e.fotiden, e.pssemp, e.idserv, e.idbar, e.codubi, e.idper, e.idval,
					v.nomval, b.nombar, s.nomserv, u.nomubi
				FROM empleado e
				LEFT JOIN valor AS v ON e.idval = v.idval
				LEFT JOIN bar AS b ON e.idbar = b.idbar
				LEFT JOIN servicio AS s ON e.idserv = s.idserv
				LEFT JOIN ubicacion AS u ON e.codubi = u.codubi";
		
		$modelo = new Conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res = $result->fetchAll(PDO::FETCH_ASSOC);
		
		return $res;
	}
	

    public function save(){
		$sql = "INSERT INTO empleado (idemp, nomemp, emaemp, celemp, fecnaemp, numdocu, fotiden, pssemp, idserv, idbar, codubi, idper, idval) VALUES (:idemp, :nomemp, :emaemp, :celemp, :fecnaemp, :numdocu, :fotiden, :pssemp, :idserv, :idbar, :codubi, :idper, :idval)";
		$modelo = new Conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idemp = $this->getIdemp();
		$result->bindParam(":idemp", $idemp);
		$nomemp = $this->getNomemp();
		$result->bindParam(":nomemp", $nomemp);
		$emaemp = $this->getEmaemp();
		$result->bindParam(":emaemp", $emaemp);
		$celemp = $this->getCelemp();
		$result->bindParam(":celemp", $celemp);
        $fecnaemp = $this->getFecnaemp();
		$result->bindParam(":fecnaemp", $fecnaemp);
        $numdocu = $this->getNumdocu();
		$result->bindParam(":numdocu", $numdocu);
        $fotiden = $this->getFotiden();
		$result->bindParam(":fotiden", $fotiden);
        $pssemp = $this->getPssemp();
		$result->bindParam(":pssemp", $pssemp);
        $idserv = $this->getIdserv();
		$result->bindParam(":idserv", $idserv);
        $idbar = $this->getIdbar();
		$result->bindParam(":idbar", $idbar);
        $codubi = $this->getCodubi();
		$result->bindParam(":codubi", $codubi);
        $idper = $this->getIdper();
		$result->bindParam(":idper", $idper);
        $idval = $this->getIdval();
		$result->bindParam(": idval", $idval);
		$result->execute();
	}
	public function edit(){
		$sql = "UPDATE empleado SET nomemp=:nomemp, emaemp=:emaemp, celemp=:celemp, fecnaemp=:fecnaemp, numdocu=:numdocu, fotiden=:fotiden, pssemp=:pssemp, idserv=:idserv, idbar=:idbar, codubi=:codubi, idper=:idper, idval=:idval WHERE idemp=:idemp";
		$modelo = new Conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idemp = $this->getIdemp();
		$result->bindParam(":idemp", $idemp);
		$nomemp = $this->getNomemp();
		$result->bindParam(":nomemp", $nomemp);
		$emaemp = $this->getEmaemp();
		$result->bindParam(":emaemp", $emaemp);
		$celemp = $this->getCelemp();
		$result->bindParam(":celemp", $celemp);
        $fecnaemp = $this->getFecnaemp();
		$result->bindParam(":fecnaemp", $fecnaemp);
        $numdocu = $this->getNumdocu();
		$result->bindParam(":numdocu", $numdocu);
        $fotiden = $this->getFotiden();
		$result->bindParam(":fotiden", $fotiden);
        $pssemp = $this->getPssemp();
		$result->bindParam(":pssemp", $pssemp);
        $idserv = $this->getIdserv();
		$result->bindParam(":idserv", $idserv);
        $idbar = $this->getIdbar();
		$result->bindParam(":idbar", $idbar);
        $codubi = $this->getCodubi();
		$result->bindParam(":codubi", $codubi);
        $idper = $this->getIdper();
		$result->bindParam(":idper", $idper);
        $idval = $this->getIdval();
		$result->bindParam(": idval", $idval);
		$result->execute();
	}

	public function del(){
		$sql = "DELETE FROM empleado WHERE idemp=:idemp";
		$modelo = new Conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idemp = $this->getIdemp();
		$result->bindParam(":id", $id);
		$result->execute();
	}
    

}
?>