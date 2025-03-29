<?php
include("admin/models/mbar.php");
include("controllers/optimg.php");
$mbar = new Mbar();

$idusu = isset($_REQUEST['idusu']) ? ($_REQUEST['idusu']): NULL;
$nomusu = isset($_POST['nomusu']) ? ($_POST['nomusu']): NULL;
$nompropi = isset($_POST['nompropi']) ? ($_POST['nompropi']): NULL;
$celusu = isset($_POST['celusu']) ? ($_POST['celusu']): NULL;
$fotiden = isset($_POST['fotiden']) ? ($_POST['fotiden']): NULL;
$dircbar = isset($_POST['dircbar']) ? ($_POST['dircbar']): NULL;
$pssusu = isset($_POST['pssusu']) ? ($_POST['pssusu']): NULL;
$codubi = isset($_POST['codubi']) ? ($_POST['codubi']): NULL;
$emausu = isset($_POST['emausu']) ? ($_POST['emausu']): NULL;
$idper = isset($_POST['idper']) ? ($_POST['idper']): NULL;
$idbar = isset($_POST['idbar']) ? ($_POST['idbar']): NULL;
$dircbar = isset($_POST['dircbar']) ? ($_POST['dircbar']): NULL;
$horbar = isset($_POST['horbar']) ? ($_POST['horbar']): NULL;

$ope = isset($_REQUEST['ope']) ? ($_REQUEST['ope']): NULL;

$mbar->setIdusu($idusu);

//CONTROL DE REGISTRO DE USUARIOS ADMIN
if ($ope == "save") {
    $mbar->setNomusu($nomusu);
    $mbar->setNompropi($nompropi);
    $mbar->setCelusu($celusu);
    $mbar->setFotiden($fotiden);
    $mbar->setDircbar($dircbar);
    $mbar->setPssusu($pssusu);
    $mbar->setCodubi($codubi);
    $mbar->setIdper($idper);
    $mbar->setIdbar($idbar);
    $mbar->setDircbar($dircbar);
    $mbar->setHorbar($horbar);
    $mbar->setEmausu($emausu);
    

    $dtOne = $mbar->getOne();
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
            $fotiden = $newFileName; // Guarda el nuevo nombre en la variable
        } else {
            $fotiden = NULL; // Si hubo un error, asigna NULL
        }
    } else {
        $fotiden = NULL; // Si no se subió un archivo, asigna NULL
    }
}

//CONTROL DE ELIMINACION DE USUARIOS

if ($ope == "del" && $idusu) {
    $mbar->del();
}
//CONTROL DE EDICION DE USUARIOS
if ($ope == "edit" && $idusu) {
    $dtOne = $mbar->getOne();
} else {
    $dtOne = NULL;
}

//LLAMADA DE FUNCIONES
$dat = $mbar->getAll();
?>