<?php
require_once ('models/mbarxprod.php');
include("controllers/optimg.php");

$mbarxprod = new Mbarxprod();


//$fecdia = date("Y-m-d H:i:s");

$idprod = isset($_REQUEST['idprod']) ? $_REQUEST['idprod'] : NULL;
$nomprod = isset($_POST['nomprod']) ? $_POST['nomprod'] : NULL;
$desprod = isset($_POST['desprod']) ? $_POST['desprod'] : NULL;
$vlrprod = isset($_POST['vlrprod']) ? $_POST['vlrprod'] : NULL;
$fotprod = isset($_POST['fotprod']) ? $_POST['fotprod']:NULL;
$idbar = isset($_SESSION['idbar']) ? $_SESSION['idbar'] : NULL;
$cantprod = isset($_POST['cantprod']) ? $_POST['cantprod'] : NULL;
$idusu = isset($_POST['idusu']) ? $_POST['idusu'] : NULL;
$tipoprod = isset($_POST['tipoprod']) ? $_POST['tipoprod'] : NULL;
$mililitros = isset($_POST['mililitros']) && $_POST['mililitros'] !== '' ? (int)$_POST['mililitros'] : 0;

$fots = isset($_FILES['fots']['name']) ? $_FILES['fots']['name']:NULL;

if ($fots){
	if(file_exists($fotprod)) unlink($fotprod);
	$ruta_completa = opti($_FILES['fots'], 'fot', 'img/', date('YmdHis')); 
    $fotprod = basename($ruta_completa); // Extrae solo el nombre del archivo
}



$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$mbarxprod->setIdbar($idbar);

if ($ope == "save") {
    // Configuración de datos para guardar o actualizar
    $mbarxprod->setIdprod($idprod);
    $mbarxprod->setNomprod($nomprod);
    $mbarxprod->setDesprod($desprod);
    $mbarxprod->setVlrprod($vlrprod);
    $mbarxprod->setFotprod($fotprod);
    $mbarxprod->setIdbar($idbar);
    $mbarxprod->setCantprod($cantprod);
    $mbarxprod->setTipoprod($tipoprod);
    $mbarxprod->setMililitros($mililitros);

    // Aquí está el error: solo está llamando a saveprod() sin verificar si se debe actualizar
    if ($idprod) {
        $mbarxprod->editprod(); // Si existe un id, edita el producto
    } else {
        $mbarxprod->saveprod(); // Si no existe un id, crea un nuevo producto
    }
}

// Si la operación es 'eli' y hay un id de producto, eliminar el producto
if ($ope == "eli" && $idprod) {
    $mbarxprod->del($idprod);
    echo "<script>window.location.href = 'home.php?pg=3003';</script>";
    exit();
}

// Si la operación es 'edi' y hay un id de producto, obtener el producto para editar
if ($ope == "edi" && $idprod) {
    $datOne = $mbarxprod->getOne($idprod);
}

// Obtener todos los productos
$dattab = $mbarxprod->gettabla();

?>