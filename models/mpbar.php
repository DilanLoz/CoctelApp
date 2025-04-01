<?php
require_once 'models/conexion.php';

class Mpbar {
    private $idbar;
    private $nombar;
    private $nompropi;
    private $nit;
    private $emabar;
    private $telbar;
    private $pssbar;
    private $dircbar;
    private $horbar;
    private $fotbar;
    private $codubi;
    private $idper;
    private $idval;

    // Métodos GET
    public function getIdbar() { return $this->idbar; }
    public function getNombar() { return $this->nombar; }
    public function getNompropi() { return $this->nompropi; }
    public function getNit() { return $this->nit; }
    public function getEmabar() { return $this->emabar; }
    public function getTelbar() { return $this->telbar; }
    public function getPssbar() { return $this->pssbar; }
    public function getDircbar() { return $this->dircbar; }
    public function getHorbar() { return $this->horbar; }
    public function getFotbar() { return $this->fotbar; }
    public function getCodubi() { return $this->codubi; }
    public function getIdper() { return $this->idper; }
    public function getIdval() { return $this->idval; }

    // Métodos SET
    public function setIdbar($idbar) { $this->idbar = $idbar; }
    public function setNombar($nombar) { $this->nombar = $nombar; }
    public function setNompropi($nompropi) { $this->nompropi = $nompropi; }
    public function setNit($nit) { $this->nit = $nit; }
    public function setEmabar($emabar) { $this->emabar = $emabar; }
    public function setTelbar($telbar) { $this->telbar = $telbar; }
    public function setPssbar($pssbar) { $this->pssbar = $pssbar; }
    public function setDircbar($dircbar) { $this->dircbar = $dircbar; }
    public function setHorbar($horbar) { $this->horbar = $horbar; }
    public function setFotbar($fotbar) { $this->fotbar = $fotbar; }
    public function setCodubi($codubi) { $this->codubi = $codubi; }
    public function setIdper($idper) { $this->idper = $idper; }
    public function setIdval($idval) { $this->idval = $idval; }

    // Obtener todos los bares
    public function getAll() {
        try {
            $sql = "SELECT idbar, nombar, nompropi, nit, emabar, telbar, pssbar, dircbar, horbar, fotbar, codubi, idper, idval 
                    FROM bar 
                    WHERE estado = 1"; // Filtra solo los bares con estado = 1
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }    

    // Obtener un solo bar por id
    public function getOne() {
        try {
            $sql = "SELECT idbar, nombar, nompropi, nit, emabar, telbar, pssbar, dircbar, horbar, fotbar, codubi, idper, idval 
                FROM bar WHERE idbar = :idbar";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idbar = $this->getIdbar();
            $result->bindParam(":idbar", $idbar);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Guardar nuevo bar
    public function save() {
        try {
            $sql = "INSERT INTO bar (nombar, nompropi, nit, emabar, telbar, pssbar, dircbar, horbar, fotbar, codubi, idper, idval) 
                    VALUES (:nombar, :nompropi, :nit, :emabar, :telbar, :pssbar, :dircbar, :horbar, :fotbar, :codubi, :idper, :idval)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);

            $result->bindParam(":nombar", $this->nombar);
            $result->bindParam(":nompropi", $this->nompropi);
            $result->bindParam(":nit", $this->nit);
            $result->bindParam(":emabar", $this->emabar);
            $result->bindParam(":telbar", $this->telbar);
            $result->bindParam(":pssbar", $this->pssbar);
            $result->bindParam(":dircbar", $this->dircbar);
            $result->bindParam(":horbar", $this->horbar);
            $result->bindParam(":fotbar", $this->fotbar);
            $result->bindParam(":codubi", $this->codubi);
            $result->bindParam(":idper", $this->idper);
            $result->bindParam(":idval", $this->idval);

            $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Editar bar
    // Editar bar con manejo de imagen
public function edit() {
    try {
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();

        // Obtener la imagen actual si no se sube una nueva
        $sqlImg = "SELECT fotbar FROM bar WHERE idbar = :idbar";
        $resultImg = $conexion->prepare($sqlImg);
        $resultImg->bindParam(":idbar", $this->idbar, PDO::PARAM_INT);
        $resultImg->execute();
        $barData = $resultImg->fetch(PDO::FETCH_ASSOC);
        $currentImage = $barData ? $barData['fotbar'] : null;

        // Si no hay nueva imagen, mantener la actual
        if (empty($this->fotbar)) {
            $this->fotbar = $currentImage;
        }

        // Query de actualización
        $sql = "UPDATE bar SET nombar=:nombar, nompropi=:nompropi, nit=:nit, emabar=:emabar, telbar=:telbar, 
                pssbar=:pssbar, dircbar=:dircbar, horbar=:horbar, fotbar=:fotbar, codubi=:codubi, idper=:idper, idval=:idval
                WHERE idbar=:idbar";
        $result = $conexion->prepare($sql);

        $result->bindParam(":idbar", $this->idbar, PDO::PARAM_INT);
        $result->bindParam(":nombar", $this->nombar);
        $result->bindParam(":nompropi", $this->nompropi);
        $result->bindParam(":nit", $this->nit);
        $result->bindParam(":emabar", $this->emabar);
        $result->bindParam(":telbar", $this->telbar);
        $result->bindParam(":pssbar", $this->pssbar);
        $result->bindParam(":dircbar", $this->dircbar);
        $result->bindParam(":horbar", $this->horbar);
        $result->bindParam(":fotbar", $this->fotbar);
        $result->bindParam(":codubi", $this->codubi);
        $result->bindParam(":idper", $this->idper);
        $result->bindParam(":idval", $this->idval);

        $result->execute();

        return [
            "status" => "success",
            "message" => "Registro actualizado correctamente"
        ];
    } catch (PDOException $e) {
        return [
            "status" => "error",
            "message" => "Error al actualizar: " . $e->getMessage()
        ];
    }
}


    // Eliminar bar
    public function del() {
        try {
            $sql = "DELETE FROM bar WHERE idbar=:idbar";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idbar = $this->getIdbar();
            $result->bindParam(":idbar", $idbar);
            $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getAllBar() {
        try {
            $sql = "SELECT 
                        b.idbar, 
                        b.nombar, 
                        b.nompropi, 
                        b.nit, 
                        b.emabar, 
                        b.telbar, 
                        b.pssbar, 
                        b.dircbar, 
                        b.horbar, 
                        b.fotbar, 
                        b.codubi, 
                        u.nomubi, 
                        b.idper, 
                        b.idval 
                    FROM bar b
                    INNER JOIN ubicacion u ON b.codubi = u.codubi  -- Relación con la tabla ubicacion
                    WHERE b.estado = 1
                    ORDER BY RAND()";
    
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    
    

}
?>
