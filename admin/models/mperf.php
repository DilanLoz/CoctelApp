
public function getOnePer() {
        try {
            $sql = "SELECT p.idpag, p.idper, pg.nompag, pg.rutpag, pg.mospag, pg.ordpag, pg.icopag, pg.despag, pr.nomper, pr.pagini 
                    FROM pagper AS p 
                    INNER JOIN pagina AS pg ON p.idpag = pg.idpag 
                    INNER JOIN perfiles AS pr ON p.idper = pr.idper 
                    WHERE p.idper = :idper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper(); 
            $result->bindParam(":idper", $idper);
            $result->execute();
            $res = $result->fetch(PDO::FETCH_ASSOC); 
            return $res;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }