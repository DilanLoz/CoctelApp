<?php 
include("models/mpusu.php");
require_once("controllers/optimg.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Obtenemos el id del usuario desde la sesión si está autenticado
$idusu = isset($_SESSION['idusu']) ? $_SESSION['idusu'] : NULL;

// Captura de datos enviados por POST
$nomusu = isset($_POST['nomusu']) ? $_POST['nomusu'] : NULL;
$emausu = isset($_POST['emausu']) ? $_POST['emausu'] : NULL;
$celusu = isset($_POST['celusu']) ? $_POST['celusu'] : NULL;
$numdocu = isset($_POST['numdocu']) ? $_POST['numdocu'] : NULL;
$fecnausu = isset($_POST['fecnausu']) ? $_POST['fecnausu'] : NULL;
$pssusu = isset($_POST['pssusu']) ? $_POST['pssusu'] : NULL;
$codubi = isset($_POST['codubi']) ? $_POST['codubi'] : NULL;
$idper = isset($_POST['idper']) ? $_POST['idper'] : NULL;
$idval = isset($_POST['idval']) ? $_POST['idval'] : NULL;
$idbar = isset($_POST['idbar']) ? $_POST['idbar'] : NULL;
$dircbar = isset($_POST['dircbar']) ? $_POST['dircbar'] : NULL;
$horbar = isset($_POST['horbar']) ? $_POST['horbar'] : NULL;
$nompropi = isset($_POST['nompropi']) ? $_POST['nompropi'] : NULL;
$ope = isset($_POST['ope']) ? $_POST['ope'] : NULL;

// **Procesar imagen de usuario**
$fotiden = isset($_POST['fotiden']) ? $_POST['fotiden'] : NULL;
$fots = isset($_FILES['fots']['name']) ? $_FILES['fots']['name'] : NULL;

if ($fots) {
    // Si ya tiene una imagen, eliminar la anterior
    if (file_exists($fotiden)) {
        unlink($fotiden);
    }
    
    // Guardar la nueva imagen en `img/usuarios/`
    $ruta_completa = opti($_FILES['fots'], 'fot', 'img/usuarios/', date('YmdHis')); 
    $fotiden = basename($ruta_completa); // Extraer solo el nombre del archivo
}

// Instancia del modelo
$mpusu = new Mpusu();

if ($ope == "save") {
    // Configuración de datos para guardar o actualizar
    $mpusu->setIdusu($idusu);
    $mpusu->setNomusu($nomusu);
    $mpusu->setEmausu($emausu);
    $mpusu->setCelusu($celusu);
    $mpusu->setFotiden($fotiden);
    $mpusu->setNumdocu($numdocu);
    $mpusu->setFecnausu($fecnausu);
    $mpusu->setPssusu($pssusu);
    $mpusu->setCodubi($codubi);
    $mpusu->setIdper($idper);
    $mpusu->setIdval($idval);
    $mpusu->setIdbar($idbar);
    $mpusu->setDircbar($dircbar);
    $mpusu->setHorbar($horbar);
    $mpusu->setNompropi($nompropi);

    // Guardar o actualizar según el valor de idusu
    if ($idusu) {
        $mpusu->editUsuario();
    } else {
        $mpusu->saveUsuario();
    }
}

// Si la operación es 'edi' y hay un id de usuario, obtener el usuario para editar
if (isset($_GET['ope']) && $_GET['ope'] == "edi" && $idusu) {
    $dtOne = $mpusu->getOneUsuario(); // Obtiene los datos del usuario 
} else {
    $dtOne = NULL;
}

// Obtener todos los usuarios
try {
    $dat = $mpusu->getAll();
} catch (Exception $e) {
    $dat = [];
    $message = "Error al obtener la lista de usuarios: " . $e->getMessage();
}

?>
