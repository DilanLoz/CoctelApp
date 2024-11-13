<?php
require_once('models/mpemp.php');

// Inicializar el objeto de Mpemp
$mpemp = new Mpemp();

$fecnaemp = date("Y-m-d H:i:s");

// Métodos request para empleado y perfil
$idemp = isset($_REQUEST['idemp']) ? $_REQUEST['idemp'] : NULL;
$idper = isset($_REQUEST['idper']) ? $_REQUEST['idper'] : NULL;

// Métodos post para empleado
$nomemp = isset($_POST['nomemp']) ? $_POST['nomemp'] : NULL;
$emaemp = isset($_POST['emaemp']) ? $_POST['emaemp'] : NULL;
$celemp = isset($_POST['celemp']) ? $_POST['celemp'] : NULL;
$fecnaemp = isset($_POST['fecnaemp']) ? $_POST['fecnaemp'] : $fecnaemp;
$numdocu = isset($_POST['numdocu']) ? $_POST['numdocu'] : NULL;
$fotiden = isset($_POST['fotiden']) ? $_POST['fotiden'] : NULL;
$pssemp = isset($_POST['pssemp']) ? $_POST['pssemp'] : NULL;
$idserv = isset($_POST['idserv']) ? $_POST['idserv'] : NULL;
$idbar = isset($_POST['idbar']) ? $_POST['idbar'] : NULL;
$codubi = isset($_POST['codubi']) ? $_POST['codubi'] : NULL;
$idval = isset($_REQUEST['idval']) ? $_REQUEST['idval'] : NULL;

// Métodos post para perfil
$nomper = isset($_POST['nomper']) ? $_POST['nomper'] : NULL;
$pagini = isset($_POST['pagini']) ? $_POST['pagini'] : NULL;

// Operación (opera)
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$opera = isset($_REQUEST['opera']) ? $_REQUEST['opera'] : NULL;

$datOneEmp = NULL;
$datOnePer = NULL;
$datAllEmp = NULL;
$datAllPer = NULL;

// Empleado
$mpemp->setIdemp($idemp);
$mpemp->setIdval($idval);
if ($ope == "editEmp") {
    $mpemp->setNomemp($nomemp);
    $mpemp->setEmaemp($emaemp);
    $mpemp->setCelemp($celemp);
    $mpemp->setFecnaemp($fecnaemp);
    $mpemp->setNumdocu($numdocu);
    $mpemp->setFotiden($fotiden);
    $mpemp->setPssemp($pssemp);
    $mpemp->setIdserv($idserv);
    $mpemp->setIdbar($idbar);
    $mpemp->setCodubi($codubi);
    $mpemp->setIdval($idval);
    $mpemp->editEmp();
}

if ($ope == "eli" && $idemp) {
    $mpemp->delEmp();
}

if ($ope == "edi" && $idemp) {
    $datOneEmp = $mpemp->getOneEmp($idemp);
}

// Perfiles
$mpemp->setIdper($idper);
if ($opera == "save") {
    $mpemp->setNomper($nomper);
    $mpemp->setPagini($pagini);
    $mpemp->save();
}
$mpemp->setIdemp($idemp);
if ($opera == "saveEmp") {
    $mpemp->setNomper($nomper);
    $mpemp->setPagini($pagini);
}
if ($opera == "eli" && $idper) {
    $mpemp->delPer();
}

if ($opera == "edi" && $idper) {
    $datOnePer = $mpemp->getOnePer($idper);
}

// Si el formulario fue enviado para actualizar los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Incluir el archivo de conexión a la base de datos
require_once('models/datos.php'); // Asegúrate de que este archivo exista y sea correcto
}
// Si el formulario fue enviado para actualizar los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $ope == "editEmp") {
    // Si se ha cambiado la foto
    if (!empty($_FILES['fots']['name'])) {
        $fotiden = $_FILES['fots']['name'];
        $fotiden_tmp = $_FILES['fots']['tmp_name'];
        $fotiden_path = 'uploads/' . $fotiden;
        move_uploaded_file($fotiden_tmp, $fotiden_path);
    } else {
        $fotiden = isset($_POST['fotiden_old']) ? $_POST['fotiden_old'] : null;
    }

    // Establecer los datos del empleado
    $mpemp->setNomemp($nomemp);
    $mpemp->setEmaemp($emaemp);
    $mpemp->setCelemp($celemp);
    $mpemp->setFecnaemp($fecnaemp);
    $mpemp->setNumdocu($numdocu);
    $mpemp->setFotiden($fotiden);
    $mpemp->setPssemp($pssemp);
    $mpemp->setIdserv($idserv);
    $mpemp->setIdbar($idbar);
    $mpemp->setCodubi($codubi);
    $mpemp->setIdval($idval);

    // Llamar al método de actualización
    $mpemp->editEmp();

    // Después de actualizar, recargar los datos del empleado
    $datOneEmp = $mpemp->getOneEmp();  // Aquí se recargan los datos del empleado
}

// Eliminar empleado
if ($ope == "eli" && $idemp) {
    $mpemp->delEmp();
}

// Obtener un solo empleado para editar
if ($ope == "edi" && $idemp) {
    $datOneEmp = $mpemp->getOneEmp($idemp);  // Esto asegura que los datos del empleado se carguen para la edición
}

// Guardar perfil
if ($opera == "save" && isset($nomper)) {
    $mpemp->setNomper($nomper);
    $mpemp->setPagini($pagini);
    $mpemp->save();
}

// Obtener todos los empleados y perfiles
$datAllEmp = $mpemp->getAllEmp();
$datAllPer = $mpemp->getAllPer();
?>