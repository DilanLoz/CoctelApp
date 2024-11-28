<?php
ob_start();  // Inicia el buffer de salida

require_once('models/musdatcom.php');

$musdatcom = new Musdatcom();

// Obtener parámetros de la solicitud
$idmetpago = isset($_REQUEST['idmetpago']) ? $_REQUEST['idmetpago'] : NULL;
$nommetpago = isset($_POST['nommetpago']) ? $_POST['nommetpago'] : NULL;
$nomtitu = isset($_POST['nomtitu']) ? $_POST['nomtitu'] : NULL;
$cvv = isset($_POST['cvv']) ? $_POST['cvv'] : NULL;
$fecvenci = isset($_POST['fecvenci']) ? $_POST['fecvenci'] : NULL;
$numtarj = isset($_POST['numtarj']) ? $_POST['numtarj'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$musdatcom->setIdmetpago($idmetpago);

if ($ope == "save") {
    // Asignar valores a los atributos del modelo
    $musdatcom->setNommetpago($nommetpago);
    $musdatcom->setNomtitu($nomtitu);
    $musdatcom->setCvv($cvv);
    $musdatcom->setFecvenci($fecvenci);
    $musdatcom->setNumtarj($numtarj);

    // Guardar la información en la base de datos
    $musdatcom->save();
}

// Si la operación es 'eli' y hay un id de producto, eliminar el producto
if ($ope == "eli" && $idmetpago) {
    $musdatcom->setIdmetpago($idmetpago);
    $musdatcom->del();
}

// Si la operación es 'edi' y hay un id de producto, obtener el producto para editar
if ($ope == "edi" && $idmetpago) {
    $musdatcom->setIdmetpago($idmetpago);
    $datOne = $musdatcom->getOne();
}

// Obtener todos los registros
$datAll = $musdatcom->getAll();

// Obtener un solo registro para mostrar, si es necesario
$nom = $musdatcom->getOne();

ob_end_flush();  // Envía el contenido al navegador después de la redirección
?>
