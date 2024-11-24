<?php
ob_start();  // Inicia el buffer de salida

require_once ('models/mbarxprod.php');
include ('admin/models/mbar.php');
require_once 'models/conexion.php';

$imageCounter = 0;
$mbarxprod = new Mbarxprod();
$mbar = new Mbar();


//$fecdia = date("Y-m-d H:i:s");

$idprod = isset($_REQUEST['idprod']) ? $_REQUEST['idprod'] : NULL;
$nomprod = isset($_POST['nomprod']) ? $_POST['nomprod'] : NULL;
$desprod = isset($_POST['desprod']) ? $_POST['desprod'] : NULL;
$vlrprod = isset($_POST['vlrprod']) ? $_POST['vlrprod'] : NULL;
$fotprod = isset($_POST['fotprod']) ? $_POST['fotprod'] : NULL;
$idval = isset($_POST['idval']) ? $_POST['idval'] : NULL;
$idbar = isset($_POST['idbar']) ? $_POST['idbar'] : NULL;
$cantprod = isset($_POST['cantprod']) ? $_POST['cantprod'] : NULL;
$idserv = isset($_POST['idserv']) ? $_POST['idserv'] : NULL;
$idusu = isset($_POST['idusu']) ? $_POST['idusu'] : NULL;
$tipoprod = isset($_POST['tipoprod']) ? $_POST['tipoprod'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$mbarxprod->setIdprod($idprod);

if ($ope == "save") {
    // Manejo del archivo de imagen
    if (isset($_FILES['fots']) && $_FILES['fots']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['fots']['tmp_name'];
        $fileName = $_FILES['fots']['name'];
        $fileSize = $_FILES['fots']['size'];
        $fileType = $_FILES['fots']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define la carpeta de destino
        $uploadFileDir = 'img/';
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
    $mbarxprod->setTipoprod($tipoprod); // Aquí se guarda el tipo de producto
    $mbarxprod->save();

    // Redirigir según el tipo de producto
    if ($tipoprod == "licor") {
        header("Location: home.php?pg=3003");
        exit; // Termina la ejecución del script después de redirigir
    } elseif ($tipoprod == "vino") {
        header("Location: home.php?pg=3003");
        exit; // Termina la ejecución del script después de redirigir
    } elseif ($tipoprod == "coctel") {
        header("Location: home.php?pg=3003");
        exit; // Termina la ejecución del script después de redirigir
    } else {
        // Si no es ninguno de esos tipos, redirige a una página general
        header("Location: home.php?pg=productos");
        exit; // Termina la ejecución del script después de redirigir
    }
}

// Si la operación es 'eli' y hay un id de producto, eliminar el producto
if ($ope == "eli" && $idprod) {
    $mbarxprod->del();
}

// Si la operación es 'edi' y hay un id de producto, obtener el producto para editar
if ($ope == "edi" && $idprod) {
    $datOne = $mbarxprod->getOne($idprod);
}

// Obtener todos los productos
$datAll = $mbarxprod->getAll();
$bars=$mbar->getAll();
ob_end_flush();  // Envía el contenido al navegador después de la redirección
?>