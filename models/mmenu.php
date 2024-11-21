<?php 
class Mmenu {
    private $idpag;
    private $idper;

    // Métodos GET
    public function getIdpag() {
        return $this->idpag;
    }

    public function getIdper() {
        return $this->idper;
    }

    // Métodos SET
    public function setIdpag($idpag) {
        $this->idpag = $idpag;
    }

    public function setIdper($idper) {
        $this->idper = $idper;
    }

    // Obtiene el menú ordenado por `ordpag`
    public function getMenu() {
        $sql = "SELECT p.idpag, p.nompag, p.rutpag, p.ordpag, p.icopag, p.titupag
                FROM pagina AS p
                INNER JOIN pagper AS f ON p.idpag = f.idpag
                WHERE p.mospag = 1 AND f.idper = :idper
                ORDER BY p.ordpag ASC;"; // Orden ascendente por `ordpag`

        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idper = $this->getIdper();
        $result->bindParam(':idper', $idper);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Valida datos de una página específica
    public function getVal() {
        $sql = "SELECT p.idpag, p.nompag, p.rutpag, p.icopag, p.mospag, p.titupag
                FROM pagina AS p
                INNER JOIN pagper AS g ON p.idpag = g.idpag
                WHERE p.idpag = :idpag AND g.idper = :idper;";
        
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idper = $this->getIdper();
        $idpag = $this->getIdpag();
        $result->bindParam(':idper', $idper);
        $result->bindParam(':idpag', $idpag);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
