<?php
require_once('models/mbargan.php');

// Crear una instancia del objeto Mbargan
$mbargan = new Mbargan();

// Aquí puedes cargar la información necesaria o realizar alguna operación
// Por ejemplo, si deseas obtener todas las facturas
$datAll = $mbargan->getAll();


$idfact = isset($_REQUEST['idfact']) ? $_REQUEST['idfact'] : NULL;
$idpedido = isset($_POST['idpedido']) ? $_POST['idpedido'] : NULL;
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : NULL;
$idbar = isset($_POST['idbar']) ? $_POST['idbar'] : NULL;
$total = isset($_POST['total']) ? $_POST['total'] : NULL;
$idusu = isset($_POST['idusu']) ? $_POST['idusu'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$mbargan->setIdfact($idfact);

if ($ope == "save") {

    // Ahora guarda el resto de los datos
    $mbargan->setIdfact($idfact);
    $mbargan->setIdpedido($idpedido);
    $mbargan->setFecha ($fecha );
    $mbargan->setIdbar($idbar); // Usa la variable que contiene el nombre de la imagen
    $mbargan->setTotal($total);
    $mbargan->setIdusu($idusu);
    $mbargan->save();
}

// Obtener todos los productos
$datAll = $mbargan->getAll();
