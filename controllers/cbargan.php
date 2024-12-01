<?php
require_once('models/mbargan.php');

// Crear una instancia del modelo Mbargan
$mbargan = new Mbargan();

// Obtener el idusu de la sesión

$idusu = isset($_SESSION['idusu']) ? $_SESSION['idusu'] : NULL;

// Validar operación
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;

if (isset($_SESSION['idusu'])) {
    $idusu = $_SESSION['idusu'];
    $mbargan = new Mbargan();
    $datAll = $mbargan->getBySessionId($idusu);  // Obtener todas las facturas del usuario
} else {
    die('El usuario no está autenticado.');
}

// Cargar datos según la operación
if ($ope == "save") {
    $idfact = isset($_POST['idfact']) ? $_POST['idfact'] : NULL;
    $idpedido = isset($_POST['idpedido']) ? $_POST['idpedido'] : NULL;
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : NULL;
    $idbar = isset($_POST['idbar']) ? $_POST['idbar'] : NULL;
    $total = isset($_POST['total']) ? $_POST['total'] : NULL;

    $mbargan->setIdfact($idfact);
    $mbargan->setIdpedido($idpedido);
    $mbargan->setFecha($fecha);
    $mbargan->setIdbar($idbar);
    $mbargan->setTotal($total);
    $mbargan->setIdusu($idusu);

    $mbargan->save();
}
?>
