<?php

class Mbar{

    private $idusu;
	private $idemp;
	private $nomusu;
    private $emausu;
    private $celusu;
    private $fotiden;
    private $pssusu;
	private $numdocu;
	private $idbar;
    private $codubi;
	private $idper;
	private $idval;
    private $nompropi;
    private $dircbar;
    private $horbar;
    private $estado;


    public function getIdusu() {
        return $this->idusu;
    }

    public function getIdemp() {
        return $this->idemp;
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

    public function getPssusu() {
        return $this->pssusu;
    }

    public function getNumdocu() {
        return $this->numdocu;
    }
    public function getIdbar() {
        return $this->idbar;
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
    public function getNompropi() {
        return $this->nompropi;
    }
    public function getDircbar() {
        return $this->dircbar;
    }
    public function getHorbar() {
        return $this->horbar;
    }
    public function getEstado() {
        return $this->estado;
    }


    public function setIdusu($idusu) {
        $this->idusu = $idusu;
    }
    
    public function setIdemp($idemp) {
        $this->idemp = $idemp;
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

    public function setPssusu($pssusu) {
        $this->pssusu = $pssusu;
    }
    
    public function setNumdocu($numdocu) {
        $this->numdocu = $numdocu;
    }
    public function setIdbar($idbar) {
        $this->idbar = $idbar;
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
    public function setNompropi($nompropi) {
        $this->nompropi = $nompropi;
    }
    public function setDircbar($dircbar) {
        $this->dircbar = $dircbar;
    }
    public function setHorbar($horbar) {
        $this->horbar = $horbar;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }

    // Methods (getAll, getOne, save, edit, del) should be closed with }

    public function getAll() {
		$res = NULL;
		$sql = "SELECT * FROM usuario";
		
		$modelo = new Conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res = $result->fetchAll(PDO::FETCH_ASSOC);
		
		return $res;
	}

    public function getOne($idusu) {
        $res = NULL;
        $sql = "SELECT
                    us.fotiden,
                    us.idusu,
                    us.nompropi,
                    us.dircbar,
                    us.horbar,
                    us.nomusu,
                    us.numdocu,
                    v.nomval,
                    us.pssusu,
                    b.nombar,
                    u.nomubi,
                    us.emausu,
                    us.celusu,
                    b.idbar,
                    v.idval, 
                    u.codubi,
                    us.estado
                FROM usuario AS us
                INNER JOIN bar AS b ON us.idbar = b.idbar
                INNER JOIN ubicacion AS u ON us.codubi = u.codubi
                INNER JOIN valor AS v ON us.idval = v.idval
                WHERE us.idusu = :idusu";  // Corrección aquí: falta prefijo en idusu
    
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $idusu, PDO::PARAM_INT); // Se recomienda definir tipo de dato
        $result->execute();
        $res = $result->fetch(PDO::FETCH_ASSOC); // fetch en lugar de fetchAll, ya que esperas un solo resultado
    
        return $res;
    }
    

    public function gettabla() {
		$res = NULL;
	
		$sql = "SELECT
				us.fotiden,
				us.idusu,
				us.nomusu,
                us.nompropi,
                us.dircbar,
                us.horbar,
				us.numdocu,
				v.nomval,
				b.nombar,
				u.nomubi,
				us.emausu,
				us.celusu,
				b.idbar,
				v.idval, 
				u.codubi,
				us.estado
				FROM usuario AS us
				INNER JOIN bar AS b ON us.idbar = b.idbar
				INNER JOIN ubicacion AS u ON us.codubi = u.codubi
				INNER JOIN valor AS v ON us.idval = v.idval
				WHERE us.idper = 30";
	
		$modelo = new Conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res = $result->fetchAll(PDO::FETCH_ASSOC);
	
		return $res;
	}
   
    

    public function del($idusu) {
        try {
            $sql = "UPDATE usuario SET estado = :estado WHERE idusu = :idusu";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $estado = 2; // Nuevo valor del estado
            $result->bindParam(":estado", $estado, PDO::PARAM_INT);
            $result->bindParam(":idusu", $idusu, PDO::PARAM_INT);
            return $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function saveUsuario(){

        $sql = "INSERT INTO usuario (nomusu, emausu, celusu, fotiden, numdocu, pssusu, codubi, idper, idval, nompropi, dircbar, horbar, estado) 
                VALUES (:nomusu, :emausu, :celusu, :fotiden, :numdocu, :pssusu, :codubi, :idper, :idval, :nompropi, :dircbar, :horbar, :estado)";

        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);

        $result->bindParam(":nomusu", $this->nomusu);
        $result->bindParam(":emausu", $this->emausu);
        $result->bindParam(":celusu", $this->celusu);
        $result->bindParam(":fotiden", $this->fotiden);
        $result->bindParam(":numdocu", $this->numdocu);
        $result->bindParam(":pssusu", $this->pssusu);
        $result->bindParam(":codubi", $this->codubi);
        $result->bindParam(":idper", $this->idper);
        $result->bindParam(":idval", $this->idval);
        $result->bindParam(":nompropi", $this->nompropi);
        $result->bindParam(":dircbar", $this->dircbar);
        $result->bindParam(":horbar", $this->horbar);
        $result->bindParam(":estado", $this->estado);
        
        return $result->execute();
    }

    

    public function editUsuario(){

    try {
        $sql = "UPDATE usuario SET 
                    nomusu=:nomusu, 
                    emausu=:emausu, 
                    celusu=:celusu, 
                    numdocu=:numdocu, 
                    fecnausu=:fecnausu,
                    fotiden=:fotiden,
                    pssusu=:pssusu, 
                    codubi=:codubi, 
                    idper=:idper,
                    idval=:idval,
                    nompropi=:nompropi,
                    dircbar=:dircbar,
                    horbar=:horbar 
                WHERE idusu=:idusu";

        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();

        if (!$conexion) {
            throw new Exception("Error en la conexión a la base de datos");
        }

        $result = $conexion->prepare($sql);

        $result->bindParam(":idusu", $this->idusu, PDO::PARAM_INT);
        $result->bindParam(":nomusu", $this->nomusu, PDO::PARAM_STR);
        $result->bindParam(":emausu", $this->emausu, PDO::PARAM_STR);
        $result->bindParam(":celusu", $this->celusu, PDO::PARAM_STR);
        $result->bindParam(":numdocu", $this->numdocu, PDO::PARAM_STR);
        $result->bindParam(":fecnausu", $this->fecnausu, PDO::PARAM_STR);
        $result->bindParam(":fotiden", $this->fotiden, PDO::PARAM_STR);
        $result->bindParam(":pssusu", $this->pssusu, PDO::PARAM_STR);
        $result->bindParam(":codubi", $this->codubi, PDO::PARAM_INT);
        $result->bindParam(":idper", $this->idper, PDO::PARAM_INT);
        $result->bindParam(":idval", $this->idval, PDO::PARAM_INT);
        $result->bindParam(":nompropi", $this->nompropi, PDO::PARAM_STR);
        $result->bindParam(":dircbar", $this->dircbar, PDO::PARAM_STR);
        $result->bindParam(":horbar", $this->horbar, PDO::PARAM_INT);

        if ($result->execute()) {
            return ["status" => "success", "message" => "Usuario actualizado correctamente"];
        } else {
            throw new Exception("Error al actualizar el usuario");
        }
    } catch (Exception $e) {
        return ["status" => "error", "message" => $e->getMessage()];
    }
}


public function editEstado() {
    try {
        $sql = "UPDATE usuario SET estado = :estado WHERE idusu = :idusu";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        
        $result->bindParam(":idusu", $this->idusu);
        $result->bindParam(":estado", $this->estado);
        
        return $result->execute();
    } catch (Exception $e) {
        throw new Exception("Error al actualizar estado: " . $e->getMessage());
    }
}

} 

?>