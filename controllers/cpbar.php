<?php
ob_start();  // Inicia el buffer de salida

require_once ('models/mpbar.php');
require_once 'models/conexion.php';

$imageCounter = 0;
$mpbar = new Mpbar();

//$fecdia = date("Y-m-d H:i:s");

$idbar = isset($_REQUEST['idbar']) ? $_REQUEST['idbar'] : NULL;
$nompbar = isset($_POST['nompbar']) ? $_POST['nompbar'] : NULL;
$nompropi = isset($_POST['nompropi']) ? $_POST['nompropi'] : NULL;
$nit = isset($_POST['nit']) ? $_POST['nit'] : NULL;
$emabar = isset($_POST['emabar']) ? $_POST['emabar'] : NULL;
$telbar = isset($_POST['telbar']) ? $_POST['telbar'] : NULL;
$pssbar = isset($_POST['pssbar']) ? $_POST['pssbar'] : NULL;
$dircbar = isset($_POST['dircbar']) ? $_POST['dircbar'] : NULL;
$codubi = isset($_POST['codubi']) ? $_POST['codubi'] : NULL;
$idper = isset($_POST['idper']) ? $_POST['idper'] : NULL;
$idval = isset($_POST['idval']) ? $_POST['idval'] : NULL;
$fotbar = isset($_POST['fotbar']) ? $_POST['fotbar'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$mpbar->setIdbar($idbar);

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
            $emabar = $newFileName; // Guarda el nuevo nombre en la variable
        } else {
            $emabar = NULL; // Si hubo un error, asigna NULL
        }
    } else {
        $emabar = NULL; // Si no se subió un archivo, asigna NULL
    }

    // Ahora guarda el resto de los datos
    $mpbar->setNompbar($nompbar);
    $mpbar->setNompropi($nompropi);
    $mpbar->setNit ($nit );
    $mpbar->setEmabar($emabar); // Usa la variable que contiene el nombre de la imagen
    $mpbar->setTelbar($telbar);
    $mpbar->setPssbar($pssbar);
    $mpbar->setDircbar($dircbar);
    $mpbar->setCodubi($codubi);
    $mpbar->setIdper($idper);
    $mpbar->setIdval($idval);
    $mpbar->setFotbar($fotbar); // Aquí se guarda el tipo de producto
    $mpbar->save();
}

// Si la operación es 'eli' y hay un id de producto, eliminar el producto
if ($ope == "eli" && $idbar) {
    $mpbar->del();
}

// Si la operación es 'edi' y hay un id de producto, obtener el producto para editar
if ($ope == "edi" && $idbar) {
    $datOne = $mpbar->getOne($idbar);
}

// Obtener todos los productos
$datAll = $mpbar->getAll();