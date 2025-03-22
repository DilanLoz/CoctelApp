<?php 
include("models/mbarxem.php");
include("controllers/optimg.php");

$mbarxem = new Mbarxem();


$idusu = isset($_REQUEST['idusu']) ? $_REQUEST['idusu'] : NULL;
$nomusu = isset($_POST['nomusu']) ? $_POST['nomusu'] : NULL;
$emausu = isset($_POST['emausu']) ? $_POST['emausu'] : NULL;
$celusu = isset($_POST['celusu']) ? $_POST['celusu'] : NULL;
$fecnausu = isset($_POST['fecnausu']) ? $_POST['fecnausu']:NULL;
$pssusu = isset($_POST['pssusu']) ? $_POST['pssusu']:NULL;
$idbar = isset($_POST['idbar']) ? $_POST['idbar'] : NULL;
$idemp = isset($_POST['idemp']) ? $_POST['idemp'] : NULL;
$fotiden = isset($_POST['fotiden']) ? $_POST['fotiden'] : NULL;
$numdocu = isset($_POST['numdocu']) ? $_POST['numdocu'] : NULL;
$codubi = isset($_POST['codubi']) ? $_POST['codubi'] : NULL;
$idper = isset($_POST['idper']) ? $_POST['idper'] : NULL;
$idval = isset($_POST['idval']) ? $_POST['idval'] : NULL;
$estado = isset($_REQUEST['estado']) ? $_REQUEST['estado'] : NULL;

$fots = isset($_FILES['fots']['name']) ? $_FILES['fots']['name']:NULL;

if ($fots){
	if(file_exists($fotiden)) unlink($fotiden);
	$ruta_completa = opti($_FILES['fots'], 'fot', 'img/empleados/', date('YmdHis')); 
    $fotiden = basename($ruta_completa); // Extrae solo el nombre del archivo
}



$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$mbarxem->setIdusu($idusu);

if ($ope == "save") {
    // Configuración de datos para guardar o actualizar
    $mbarxem->setIdusu($idusu);
    $mbarxem->setNomusu($nomusu);
    $mbarxem->setEmausu($emausu);
    $mbarxem->setCelusu($celusu);
    $mbarxem->setFotiden($fotiden);
    $mbarxem->setNumdocu($numdocu);
    $mbarxem->setIdper($idper = 20);
    $mbarxem->setFecnausu($fecnausu);
    $mbarxem->setCodubi($codubi);
    $mbarxem->setIdval($idval);
    $mbarxem->setFotiden($fotiden);
    $mbarxem->setIdbar($idbar = $_SESSION['idbar']);
    $mbarxem->setEstado($estado = 1);

    // Validar y encriptar contraseña solo si se proporciona una nueva
    if (!empty($pssusu)) {
        $mbarxem->setPssusu(password_hash($pssusu, PASSWORD_DEFAULT));
    }

    // Si el ID existe y no está vacío, se actualiza. Si no, se crea un nuevo registro.
    if (!empty($idusu)) {
        $result = $mbarxem->editUsuario();
    } else {
        $result = $mbarxem->saveUsuario();
    }

    // Verificación del resultado y manejo de errores
    if ($result) {
        echo "Operación exitosa";
    } else {
        echo "Error al procesar la solicitud";
    }
}

// Si la operación es 'eli' y hay un id de producto, eliminar el producto
if ($ope == "eli" && $idusu) {
    $mbarxem->del($idusu);
    echo "<script>window.location.href = 'home.php?pg=3004';</script>";
    exit();
}

if($idusu && $ope=="acti"){
    $mbarxem->setEstado($estado);
    $mbarxem->editEstado();
}

// Si la operación es 'edi' y hay un id de producto, obtener el producto para editar
if ($ope == "edi" && $idusu) {
    $datOne = $mbarxem->getOne($idusu);
}

// Obtener todos los productos
$dattab = $mbarxem->gettabla();
$datbar = $mbarxem->getbar();

?>