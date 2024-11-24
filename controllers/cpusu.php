<?php 
include("models/mpusu.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Obtenemos el id del usuario desde la sesión si está autenticado
$idusu = isset($_SESSION['idusu']) ? $_SESSION['idusu'] : NULL;

// Captura de datos enviados por POST
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
$idserv = isset($_POST['idserv']) ? $_POST['idserv'] : NULL;
$idbar = isset($_POST['idbar']) ? $_POST['idbar'] : NULL;
$dircbar = isset($_POST['dircbar']) ? $_POST['dircbar'] : NULL;
$horbar = isset($_POST['horbar']) ? $_POST['horbar'] : NULL;
$nompropi = isset($_POST['nompropi']) ? $_POST['nompropi'] : NULL;
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
    $mpusu->setIdserv($idserv);
    $mpusu->setIdbar($idbar);
    $mpusu->setDircbar($dircbar);
    $mpusu->setHorbar($horbar);
    $mpusu->setNompropi($nompropi);

    // Guardar o actualizar según el valor de idusu
    if ($idusu) {
        try {
            $mpusu->edit();
            $message = "Usuario actualizado correctamente.";
        } catch (Exception $e) {
            $message = "Error al actualizar usuario: " . $e->getMessage();
        }
    } else {
        try {
            $mpusu->save();
            $message = "Usuario creado correctamente.";
        } catch (Exception $e) {
            $message = "Error al crear usuario: " . $e->getMessage();
        }
    }
}

// Modo de operación y obtención de datos de usuario
$m = 2; // Indica modo de consulta general
$dtOne = NULL;

if (isset($_GET['ope']) && $_GET['ope'] == "edi" && $idusu) {
    try {
        $mpusu->setIdusu($idusu);
        $dtOne = $mpusu->getOne(); // Obtiene los datos del usuario específico
        $m = 1; // Modo de edición
    } catch (Exception $e) {
        $message = "Error al obtener datos del usuario: " . $e->getMessage();
    }
}

// Obtiene todos los usuarios
try {
    $dat = $mpusu->getAll();
} catch (Exception $e) {
    $dat = [];
    $message = "Error al obtener la lista de usuarios: " . $e->getMessage();
}

// Información del usuario autenticado (si se requiere en la vista)
// $datus = $mpusu->datusu();

?>
