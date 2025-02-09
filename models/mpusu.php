<?php
require_once 'models/conexion.php';
class Mpusu {
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
    private $idserv;
    private $idbar;
    private $nompropi;
    private $dircbar;
    private $horbar;

    // Métodos GET
    public function getIdusu() {
        return $this->idusu;
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
    public function getNumdocu() {
        return $this->numdocu;
    }
    public function getFecnausu() {
        return $this->fecnausu;
    }
    public function getPssusu() {
        return $this->pssusu;
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
    public function getIdserv() {
        return $this->idserv;
    }
    public function getIdbar() {
        return $this->idbar;
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

    // Métodos SET
    public function setIdusu($idusu) {
        $this->idusu = $idusu;
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
    public function setNumdocu($numdocu) {
        $this->numdocu = $numdocu;
    }
    public function setFecnausu($fecnausu) {
        $this->fecnausu = $fecnausu;
    }
    public function setPssusu($pssusu) {
        $this->pssusu = $pssusu;
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
    public function setIdserv($idserv) {
        $this->idserv = $idserv;
    }
    public function setIdbar($idbar) {
        $this->idbar = $idbar;
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

    // Métodos para la base de datos
    public function getAll() {
        $res = NULL;
        $sql = "SELECT 
                    u.idusu, u.nomusu, u.emausu, u.celusu, u.numdocu, u.fotiden, 
                    u.fecnausu, u.pssusu, u.codubi, u.idbar, u.idserv, u.idval, u.idper, 
                    b.nombar, b.nompropi, b.dircbar, b.horbar, 
                    s.nomserv, 
                    v.nomval, 
                    p.nomper, 
                    ub.nomubi 
                FROM usuario AS u
                INNER JOIN ubicacion AS ub ON u.codubi = ub.codubi
                INNER JOIN servicio AS s ON u.idserv = s.idserv
                INNER JOIN bar AS b ON u.idbar = b.idbar
                INNER JOIN valor AS v ON u.idval = v.idval
                INNER JOIN perfiles AS p ON u.idper = p.idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    //-----------------------USUARIOS-------------------------------------
    public function getOneUsuario() {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_SESSION['idusu'])) {
                return "Error: No hay usuario en sesión.";
            }
    
            $idusu = $_SESSION['idusu'];
            $sql = "SELECT 
                        idusu, nomusu, emausu, celusu, numdocu, fotiden, 
                        fecnausu, pssusu, codubi, idper, idval
                    FROM usuario 
                    WHERE idusu = :idusu";
            
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
    
            if (!$conexion) {
                return "Error: No se pudo conectar a la base de datos.";
            }
    
            $result = $conexion->prepare($sql);
            $result->bindParam(":idusu", $idusu, PDO::PARAM_INT);
            $result->execute();
    
            $res = $result->fetch(PDO::FETCH_ASSOC);
            return $res ?: "Error: Usuario no encontrado.";
        } catch (PDOException $e) {
            return "Error en la consulta: " . $e->getMessage();
        }
    }
    public function editUsuario() {
        try {
            $sql = "UPDATE usuario SET 
                        nomusu = :nomusu, emausu = :emausu, celusu = :celusu, fotiden = :fotiden, 
                        numdocu = :numdocu, fecnausu = :fecnausu, pssusu = :pssusu, 
                        codubi = :codubi, idper = :idper, idval = :idval
                    WHERE idusu = :idusu";
            
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
    
            if (!$conexion) {
                return "Error: No se pudo conectar a la base de datos.";
            }
    
            $result = $conexion->prepare($sql);
    
            // Obtener los valores con los métodos get
            $idusu = $this->getIdusu();
            $nomusu = $this->getNomusu();
            $emausu = $this->getEmausu();
            $celusu = $this->getCelusu();
            $fotiden = $this->getFotiden();
            $numdocu = $this->getNumdocu();
            $fecnausu = $this->getFecnausu();
            $pssusu = $this->getPssusu();
            $codubi = $this->getCodubi();
            $idper = $this->getIdper();
            $idval = $this->getIdval();
    
            // Verificar que idval no sea NULL
            if ($idval === null) {
                return "Error: idval no puede ser NULL.";
            }
    
            // Pasar los valores a la consulta
            $result->bindParam(":idusu", $idusu, PDO::PARAM_INT);
            $result->bindParam(":nomusu", $nomusu);
            $result->bindParam(":emausu", $emausu);
            $result->bindParam(":celusu", $celusu);
            $result->bindParam(":fotiden", $fotiden);
            $result->bindParam(":numdocu", $numdocu);
            $result->bindParam(":fecnausu", $fecnausu);
            $result->bindParam(":pssusu", $pssusu);
            $result->bindParam(":codubi", $codubi);
            $result->bindParam(":idper", $idper);
            $result->bindParam(":idval", $idval);
    
            if ($result->execute()) {
                return true;
            } else {
                $errorInfo = $result->errorInfo();
                return "Error al actualizar usuario: " . $errorInfo[2];
            }
        } catch (PDOException $e) {
            return "Error en la conexión o consulta: " . $e->getMessage();
        }
    }
    public function saveUsuario() {
        try {
            $sql = "INSERT INTO usuario 
                        (nomusu, emausu, numdocu, fecnausu, pssusu, codubi, idper, idval, celusu ) 
                    VALUES 
                        (:nomusu, :emausu, :numdocu, :fecnausu, :pssusu, :codubi, :idper, :idval, :celusu)";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
    
            if (!$conexion) {
                return "Error: No se pudo conectar a la base de datos.";
            }
    
            $result = $conexion->prepare($sql);
    
            // Obtener valores
            $nomusu = $this->getNomusu();
            $emausu = $this->getEmausu();
            $numdocu = $this->getNumdocu();
            $fecnausu = $this->getFecnausu();
            $pssusu = $this->getPssusu();
            $codubi = $this->getCodubi();
            $idper = $this->getIdper();
            $idval = $this->getIdval();
            $celusu = $this->getCelusu();
    
            // Asegurar que idval no sea NULL
            if ($idval === null) {
                return "Error: idval no puede ser NULL.";
            }
    
            // Pasar valores a la consulta
            $result->bindParam(":nomusu", $nomusu);
            $result->bindParam(":emausu", $emausu);
            $result->bindParam(":numdocu", $numdocu);
            $result->bindParam(":fecnausu", $fecnausu);
            $result->bindParam(":pssusu", $pssusu);
            $result->bindParam(":codubi", $codubi);
            $result->bindParam(":idper", $idper);
            $result->bindParam(":idval", $idval);
            $result->bindParam(":celusu", $celusu);
    
            if ($result->execute()) {
                return true;
            } else {
                $errorInfo = $result->errorInfo();
                return "Error al ejecutar la consulta: " . $errorInfo[2];
            }
        } catch (PDOException $e) {
            return "Error en la conexión o consulta: " . $e->getMessage();
        }
    }
    //----------------------USUARIOS--------------------------------------
    //------------------REGISTROS-----------------------------------------------
    public function buscarPerfil($numdocu, $emausu) {
        try {
            $sql = "SELECT COUNT(*) as count FROM usuario WHERE numdocu = :numdocu OR emausu = :emausu";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            
            $result->bindParam(":numdocu", $numdocu);
            $result->bindParam(":emausu", $emausu);
            
            $result->execute();
            $data = $result->fetch(PDO::FETCH_ASSOC);
            
            return $data['count'] > 0; // Retorna true si el usuario ya existe, false si no
        } catch (PDOException $e) {
            return "Error al verificar usuario: " . $e->getMessage();
        }
    }
    
    public function saveRegistro() {
        try {
            $sql = "INSERT INTO usuario 
                        (nomusu, emausu, numdocu, fecnausu, pssusu, codubi, idper, idval) 
                    VALUES 
                        (:nomusu, :emausu, :numdocu, :fecnausu, :pssusu, :codubi, :idper, :idval)";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
    
            if (!$conexion) {
                return "Error: No se pudo conectar a la base de datos.";
            }
    
            $result = $conexion->prepare($sql);
    
            // Obtener valores
            $nomusu = $this->getNomusu();
            $emausu = $this->getEmausu();
            $numdocu = $this->getNumdocu();
            $fecnausu = $this->getFecnausu();
            $pssusu = $this->getPssusu();
            $codubi = $this->getCodubi();
            $idper = $this->getIdper();
            $idval = $this->getIdval();
    
            // Asegurar que idval no sea NULL
            if ($idval === null) {
                return "Error: idval no puede ser NULL.";
            }
    
            // Pasar valores a la consulta
            $result->bindParam(":nomusu", $nomusu);
            $result->bindParam(":emausu", $emausu);
            $result->bindParam(":numdocu", $numdocu);
            $result->bindParam(":fecnausu", $fecnausu);
            $result->bindParam(":pssusu", $pssusu);
            $result->bindParam(":codubi", $codubi);
            $result->bindParam(":idper", $idper);
            $result->bindParam(":idval", $idval);
    
            if ($result->execute()) {
                return true;
            } else {
                $errorInfo = $result->errorInfo();
                return "Error al ejecutar la consulta: " . $errorInfo[2];
            }
        } catch (PDOException $e) {
            return "Error en la conexión o consulta: " . $e->getMessage();
        }
    }
    public function validarUsuario($numdocu, $emausu) {
        try {
            $sql = "SELECT COUNT(*) as count FROM usuario WHERE numdocu = :numdocu AND emausu = :emausu";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            
            $result->bindParam(":numdocu", $numdocu, PDO::PARAM_STR);
            $result->bindParam(":emausu", $emausu, PDO::PARAM_STR);
            
            $result->execute();
            $data = $result->fetch(PDO::FETCH_ASSOC);
            
            return $data['count'] > 0; // Retorna true si el usuario existe, false si no
        } catch (PDOException $e) {
            return "Error al verificar usuario: " . $e->getMessage();
        }
    }
    public function actualizarContrasena($numdocu, $emausu, $nueva_contrasena) {
        try {
            $sql = "UPDATE usuario SET pssusu = :pssusu WHERE numdocu = :numdocu AND emausu = :emausu";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
    
            $result->bindParam(":pssusu", $nueva_contrasena, PDO::PARAM_STR);
            $result->bindParam(":numdocu", $numdocu, PDO::PARAM_STR);
            $result->bindParam(":emausu", $emausu, PDO::PARAM_STR);
    
            if ($result->execute()) {
                return true;
            } else {
                return "Error al actualizar la contraseña.";
            }
        } catch (PDOException $e) {
            return "Error en la conexión o consulta: " . $e->getMessage();
        }
    }
        

    
}
?>
