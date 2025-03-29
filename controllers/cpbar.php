<?php
ob_start();  // Inicia el buffer de salida

require_once('models/mpbar.php');
require_once('models/conexion.php');

$imageCounter = 0;
$mpbar = new Mpbar();

$idbar = isset($_REQUEST['idbar']) ? $_REQUEST['idbar'] : NULL;
$nombar = isset($_POST['nombar']) ? $_POST['nombar'] : NULL;
$nompropi = isset($_POST['nompropi']) ? $_POST['nompropi'] : NULL;
$nit = isset($_POST['nit']) ? $_POST['nit'] : NULL;
$emabar = isset($_POST['emabar']) ? $_POST['emabar'] : NULL;
$telbar = isset($_POST['telbar']) ? $_POST['telbar'] : NULL;
$pssbar = isset($_POST['pssbar']) ? $_POST['pssbar'] : NULL;
$dircbar = isset($_POST['dircbar']) ? $_POST['dircbar'] : NULL;
$horbar = isset($_POST['horbar']) ? $_POST['horbar'] : NULL;
$codubi = isset($_POST['codubi']) ? $_POST['codubi'] : NULL;
$idper = isset($_POST['idper']) ? $_POST['idper'] : NULL;
$idval = isset($_POST['idval']) ? $_POST['idval'] : NULL;
$fotbar = NULL; // Para la imagen

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$mpbar->setIdbar($idbar);

// Manejo del archivo de imagen si se sube
if (isset($_FILES['fotbar']) && $_FILES['fotbar']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['fotbar']['tmp_name'];
    $fileName = $_FILES['fotbar']['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    
    // Carpeta de destino
    $uploadFileDir = 'img/';
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $dest_path = $uploadFileDir . $newFileName;

    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        $fotbar = $newFileName; // Guarda el nombre del archivo
    }
}

// Guardar o actualizar
if ($ope == "save") {
    $mpbar->setNombar($nombar);
    $mpbar->setNompropi($nompropi);
    $mpbar->setNit($nit);
    $mpbar->setEmabar($emabar);
    $mpbar->setTelbar($telbar);
    $mpbar->setPssbar($pssbar);
    $mpbar->setDircbar($dircbar);
    $mpbar->setHorbar($horbar);
    $mpbar->setCodubi($codubi);
    $mpbar->setIdper($idper);
    $mpbar->setIdval($idval);
    $mpbar->setFotbar($fotbar);

    if ($idbar) {
        $mpbar->edit(); // Si hay ID, edita el registro
    } else {
        $mpbar->save(); // Si no, lo guarda como nuevo
    }
}

// Eliminar
if ($ope == "eli" && $idbar) {
    $mpbar->del();
}

// Obtener datos para edición
if ($ope == "edi" && $idbar) {
    $datOne = $mpbar->getOne();
}

// Obtener todos los bares
$datAll = $mpbar->getAll();
$datAllBar = $mpbar->getAllBar();

