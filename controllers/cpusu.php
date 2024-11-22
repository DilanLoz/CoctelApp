<?php 
include("models/mpusu.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Obtenemos el id del usuario desde la sesión si está autenticado
$idusu = isset($_SESSION['idusu']) ? $_SESSION['idusu'] : NULL;

$nomusu = isset($_POST['nomusu']) ? $_POST['nomusu'] : NULL;
$emausu = isset($_POST['emausu']) ? $_POST['emausu'] : NULL;
$celusu = isset($_POST['celusu']) ? $_POST['celusu'] : NULL;
$fotiden = isset($_POST['fotiden']) ? $_POST['fotiden'] : NULL;
$numdocu = isset($_POST['numdocu']) ? $_POST['numdocu'] : NULL;
$fecnausu = isset($_POST['fecnausu']) ? $_POST['fecnausu'] : NULL;
$pssusu = isset($_POST['pssusu']) ? $_POST['pssusu'] : NULL;
$codubi = isset($_POST['codubi']) ? $_POST['codubi'] : NULL;
$idper = isset($_POST['idper']) ? $_POST['idper'] : NULL;
$idval = isset($_POST['idval']) ? $_POST['idval'] : NULL;
$ope = isset($_POST['ope']) ? $_POST['ope'] : NULL;

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

    // Guardar o actualizar según el valor de idusu
    if ($idusu) {
        $mpusu->edit();
    } else {
        $mpusu->save();
    }
}

// Determina el modo de la operación y obtiene los datos de usuario
$m = 2;
if (isset($_GET['ope']) && $_GET['ope'] == "edi" && $idusu) {
    $dtOne = $mpusu->getOne(); // Obtiene los datos del usuario específico
    $m = 1;
} else {
    $dtOne = NULL;
}

// Obtiene todos los usuarios
$dat = $mpusu->getAll();

// Obtiene los datos del usuario autenticado para la vista
$datus = $mpusu->datusu();

?>

