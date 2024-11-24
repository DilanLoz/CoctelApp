<?php
// Importar los archivos necesarios
require_once('admin/models/mbar.php');
require_once 'models/conexion.php';


// Inicializar el modelo de Bar
$mbar = new Mbar();
// Recoger datos enviados a través de POST o GET
$idbar = isset($_REQUEST['idbar']) ? $_REQUEST['idbar'] : NULL;
//ubi
$codubi = isset($_REQUEST['codubi']) ? $_REQUEST['codubi'] : NULL;
//val
$idval = isset($_REQUEST['idval']) ? $_REQUEST['idval'] : NULL;

$nombar = isset($_POST['nombar']) ? $_POST['nombar'] : NULL;
$nompropi = isset($_POST['nompropi']) ? $_POST['nompropi'] : NULL;
$nit = isset($_POST['nit']) ? $_POST['nit'] : NULL;
$emabar = isset($_POST['emabar']) ? $_POST['emabar'] : NULL;
$telbar = isset($_POST['telbar']) ? $_POST['telbar'] : NULL;
$pssbar = isset($_POST['pssbar']) ? $_POST['pssbar'] : NULL;
$dircbar = isset($_POST['dircbar']) ? $_POST['dircbar'] : NULL;
$idper = isset($_POST['idper']) ? $_POST['idper'] : NULL;
$fotbar = isset($_POST['fotbar']) ? $_POST['fotbar'] : NULL;

//ubi
$nomubi = isset($_POST['nomubi']) ? $_POST['nomubi'] : NULL;
$depubi = isset($_POST['depubi']) ? $_POST['depubi'] : NULL;
//val
$iddom = isset($_POST['iddom']) ? $_POST['iddom'] : NULL;
$nomval = isset($_POST['nomval']) ? $_POST['nomval'] : NULL;


$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$opera = isset($_REQUEST['opera']) ? $_REQUEST['opera'] : NULL;


// Guardar datos del bar
if ($opera == "save") {
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
            $fotbar = $newFileName; // Guarda el nuevo nombre en la variable
        } else {
            $fotbar = NULL; // Si hubo un error, asigna NULL
        }
    } else {
        $fotbar = NULL; // Si no se subió un archivo, asigna NULL
    }
        $mbar->setNombar($nombar);
        $mbar->setNompropi($nompropi);
        $mbar->setNit($nit);
        $mbar->setEmabar($emabar);
        $mbar->setTelbar($telbar);
        $mbar->setPssbar($pssbar);
        $mbar->setDircbar($dircbar);
        $mbar->setCodubi($codubi);
        $mbar->setIdper($idper);
        $mbar->setIdval($idval);
        $mbar->setFotbar($fotbar);
        $mbar->setNomubi($nomubi);
        $mbar->save();  // Método que guarda en la base de datos
        }
// Si la operación es editar, obtener los datos del bar
if ($ope == "edi" && $idbar) {
    $datOne = $mbar->getOne($idbar);
}
// Obtener todos los bares
try {
    $ubi = $mbar->getAllCiu(); // Cargar todas las ciudades
} catch (Exception $e) {
    echo "Error al obtener las ciudades: " . $e->getMessage();
}

$bars=$mbar->getAll();
$vals=$mbar->getAllVal();
?>