<?php
class Mgan {
    private $iddetfact;
    private $idfact;
    private $idprod;
    private $cantidad;
    private $precio_unitario;
    private $subtotal;
    private $idemp;
    private $idbar;

    // Getters
    public function getIddetfact() {
        return $this->iddetfact;
    }

    public function getIdfact() {
        return $this->idfact;
    }

    public function getIdprod() {
        return $this->idprod;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getPrecio_unitario() {
        return $this->precio_unitario;
    }

    public function getSubtotal() {
        return $this->subtotal;
    }

    public function getIdemp() {
        return $this->idemp;
    }

    public function getIdbar() {
        return $this->idbar;
    }

    // Setters
    public function setIddetfact($iddetfact) {
        $this->iddetfact = $iddetfact;
    }

    public function setIdfact($idfact) {
        $this->idfact = $idfact;
    }

    public function setIdprod($idprod) {
        $this->idprod = $idprod;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function setPrecio_unitario($precio_unitario) {
        $this->precio_unitario = $precio_unitario;
    }

    public function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }

    public function setIdemp($idemp) {
        $this->idemp = $idemp;
    }

    public function setIdbar($idbar) {
        $this->idbar = $idbar;
    }

    // Métodos
    public function getAll() {
        try {
            $sql = "SELECT iddetfact, idfact, idprod, cantidad, precio_unitario, subtotal, idemp, idbar FROM detfact";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getOne() {
        try {
            $sql = "SELECT * FROM detfact WHERE iddetfact = :iddetfact";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $iddetfact = $this->getIddetfact();
            $result->bindParam(":iddetfact", $iddetfact);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function save() {
        try {
            $sql = "INSERT INTO detfact (idfact, idprod, cantidad, precio_unitario, subtotal, idemp, idbar) 
                    VALUES (:idfact, :idprod, :cantidad, :precio_unitario, :subtotal, :idemp, :idbar)";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);

            $idfact = $this->getIdfact();
            $result->bindParam(":idfact", $idfact);
            $idprod = $this->getIdprod();
            $result->bindParam(":idprod", $idprod);
            $cantidad = $this->getCantidad();
            $result->bindParam(":cantidad", $cantidad);
            $precio_unitario = $this->getPrecio_unitario();
            $result->bindParam(":precio_unitario", $precio_unitario);
            $subtotal = $this->getSubtotal();
            $result->bindParam(":subtotal", $subtotal);
            $idemp = $this->getIdemp();
            $result->bindParam(":idemp", $idemp);
            $idbar = $this->getIdbar();
            $result->bindParam(":idbar", $idbar);

            $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function edit() {
        try {
            $sql = "UPDATE detfact SET idfact = :idfact, idprod = :idprod, cantidad = :cantidad, precio_unitario = :precio_unitario, subtotal = :subtotal, idemp = :idemp, idbar = :idbar 
                    WHERE iddetfact = :iddetfact";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);

            $iddetfact = $this->getIddetfact();
            $result->bindParam(":iddetfact", $iddetfact);
            $idfact = $this->getIdfact();
            $result->bindParam(":idfact", $idfact);
            $idprod = $this->getIdprod();
            $result->bindParam(":idprod", $idprod);
            $cantidad = $this->getCantidad();
            $result->bindParam(":cantidad", $cantidad);
            $precio_unitario = $this->getPrecio_unitario();
            $result->bindParam(":precio_unitario", $precio_unitario);
            $subtotal = $this->getSubtotal();
            $result->bindParam(":subtotal", $subtotal);
            $idemp = $this->getIdemp();
            $result->bindParam(":idemp", $idemp);
            $idbar = $this->getIdbar();
            $result->bindParam(":idbar", $idbar);

            $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function del() {
        try {
            $sql = "DELETE FROM detfact WHERE iddetfact = :iddetfact";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $iddetfact = $this->getIddetfact();
            $result->bindParam(":iddetfact", $iddetfact);
            $result->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
