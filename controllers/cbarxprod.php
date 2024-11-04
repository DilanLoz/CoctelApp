<?php
require_once ('models/mbarxprod.php');
require_once 'models/conexion.php';

$imageCounter = 0;
$mbarxprod = new Mbarxprod();

//$fecdia = date("Y-m-d H:i:s");

$idprod = isset($_REQUEST['idprod']) ? $_REQUEST['idprod']:NULL;
$nomprod = isset($_POST['nomprod']) ? $_POST['nomprod']:NULL;
$desprod = isset($_POST['desprod']) ? $_POST['desprod']:NULL;
$vlrprod = isset($_POST['vlrprod']) ? $_POST['vlrprod']:NULL;
$fotprod = isset($_POST['fotprod']) ? $_POST['fotprod']:NULL;
$idval = isset($_POST['idval']) ? $_POST['idval']:NULL;
$idbar = isset($_POST['idbar']) ? $_POST['idbar']:NULL;
$cantprod = isset($_POST['cantprod']) ? $_POST['cantprod']:NULL;
$idserv = isset($_POST['idserv']) ? $_POST['idserv']:NULL;
$idusu = isset($_POST['idusu']) ? $_POST['idusu']:NULL;


$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;

$mbarxprod->setIdprod($idprod);
if ($ope == "save") {
    // Manejo del archivo
    if (isset($_FILES['fots']) && $_FILES['fots']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['fots']['tmp_name'];
        $fileName = $_FILES['fots']['name'];
        $fileSize = $_FILES['fots']['size'];
        $fileType = $_FILES['fots']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Define la carpeta de destino
        $uploadFileDir = 'img/productos/';
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension; // Genera un nuevo nombre para la imagen
        $dest_path = $uploadFileDir . $newFileName;

        // Mueve el archivo a la carpeta deseada
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $fotprod = $newFileName; // Guarda el nuevo nombre en la variable
        } else {
            $fotprod = NULL; // Si hubo un error, asigna NULL
        }
    } else {
        $fotprod = NULL; // Si no se subió un archivo, asigna NULL
    }

    // Ahora guarda el resto de los datos
    $mbarxprod->setNomprod($nomprod);
    $mbarxprod->setDesprod($desprod);
    $mbarxprod->setVlrprod($vlrprod);
    $mbarxprod->setFotprod($fotprod); // Usa la variable que contiene el nombre de la imagen
    $mbarxprod->setIdval($idval);
    $mbarxprod->setIdbar($idbar);
    $mbarxprod->setCantprod($cantprod);
    $mbarxprod->setIdserv($idserv);
    $mbarxprod->setIdusu($idusu);
    $mbarxprod->save();
}

if($ope=="eli" && $idprod) $mbarxprod->del();
if($ope=="edi" && $idprod)$datOne = $mbarxprod->getOne($idprod);

$datAll = $mbarxprod->getAll();

?>