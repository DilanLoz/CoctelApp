<?php 
include("admin/models/mbar.php");
include("controllers/optimg.php");

$mbar = new Mbar();

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
$nompropi = isset($_POST['nompropi']) ? $_POST['nompropi'] : NULL;
$dircbar = isset($_POST['dircbar']) ? $_POST['dircbar'] : NULL;
$horbar = isset($_POST['horbar']) ? $_POST['horbar'] : NULL;
$estado = isset($_REQUEST['estado']) ? $_REQUEST['estado'] : NULL;

$fots = isset($_FILES['fots']['name']) ? $_FILES['fots']['name']:NULL;

if ($fots){
	if(file_exists($fotiden)) unlink($fotiden);
	$ruta_completa = opti($_FILES['fots'], 'fot', 'img/bares/', date('YmdHis')); 
    $fotiden = basename($ruta_completa); // Extrae solo el nombre del archivo
}

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$mbar->setIdusu($idusu);

if ($ope == "save") {
    // Configuración de datos para guardar o actualizar
    $mbar->setIdusu($idusu);
    $mbar->setNomusu($nomusu);
    $mbar->setEmausu($emausu);
    $mbar->setCelusu($celusu);
    $mbar->setFotiden($fotiden);
    $mbar->setNumdocu($numdocu);
    $mbar->setIdper($idper = 30);
    $mbar->setCodubi($codubi);
    $mbar->setIdval($idval = 104);
    $mbar->setFotiden($fotiden);
    $mbar->setNompropi($nompropi);
    $mbar->setDircbar($dircbar);
    $mbar->setHorbar($horbar);
    $mbar->setEstado($estado = 1);

    // Validar y encriptar contraseña solo si se proporciona una nueva
    if (!empty($pssusu)) {
        $pssusuHashed = sha1(md5($pssusu . 'Jd#')); // Aplica el mismo hash
        $mbar->setPssusu($pssusuHashed);
    }

    // Si el ID existe y no está vacío, se actualiza. Si no, se crea un nuevo registro.
    if (!empty($idusu)) {
        $result = $mbar->editUsuario();
    } else {
        $result = $mbar->saveUsuario();
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
    $mbar->del($idusu);
    echo "<script>window.location.href = 'home.php?pg=3004';</script>";
    exit();
}

if($idusu && $ope=="acti"){
    $mbar->setEstado($estado);
    $mbar->editEstado();
}

// Si la operación es 'edi' y hay un id de producto, obtener el producto para editar
if ($ope == "edi" && $idusu) {
    $datOne = $mbar->getOne($idusu);
}

// Obtener todos los productos
$dattab = $mbar->gettabla();

?>
