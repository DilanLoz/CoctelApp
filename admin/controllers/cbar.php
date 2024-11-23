<?php
// Importar los archivos necesarios
require_once('admin/models/mbar.php');
require_once 'models/conexion.php';


// Inicializar el modelo de Bar
$mbar = new Mbar();
// Recoger datos enviados a través de POST o GET
$idbar = isset($_REQUEST['idbar']) ? $_REQUEST['idbar'] : NULL;
$nombar = isset($_POST['nombar']) ? $_POST['nombar'] : NULL;
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

// Configurar el modelo con el ID del bar
$mbar->setIdbar($idbar);

// Guardar datos del bar
if ($ope == "save") {
    // Manejo de archivo de imagen
    if (isset($_FILES['fots']) && $_FILES['fots']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['fots']['tmp_name'];
        $fileName = $_FILES['fots']['name'];
        $fileSize = $_FILES['fots']['size'];
        $fileType = $_FILES['fots']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $mbar->setNombar($nombar);
        $mbar->setNompropi($nompropi);
        $mbar->setNit($nit);
        $mbar->setEmabar($emabar); // Usa la variable que contiene el nombre de la imagen
        $mbar->setTelbar($telbar);
        $mbar->setPssbar($pssbar);
        $mbar->setDircbar($dircbar);
        $mbar->setCodubi($codubi);
        $mbar->setIdper($idper);
        $mbar->setIdval($idval);
        $mbar->save();  // Método que guarda en la base de datos
        }

        // Validar si el archivo es una imagen
        $validExtensions = array("jpg", "jpeg", "png", "gif");
        if (in_array($fileExtension, $validExtensions)) {
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
            $emabar = NULL; // Si la extensión no es válida, asigna NULL
        }
    } else {
        $emabar = NULL; // Si no se subió un archivo, asigna NULL
    }

    // Ahora guarda el resto de los datos
    

// Si la operación es editar, obtener los datos del bar
if ($ope == 'edit' && $idbar) {
    // Asegúrate de que el ID del bar no sea NULL antes de intentar obtener datos

}
// Obtener todos los bares
try {
    $bars = $mbar->getAll();
} catch (Exception $e) {
    echo "Error al obtener los registros: " . $e->getMessage();
}

?>