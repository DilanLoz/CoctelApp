<?php
// Importar los archivos necesarios
require_once('admin/models/mgan.php');
require_once('models/conexion.php');

// Inicializar el modelo
$mgan = new Mgan();

// Recoger datos enviados a través de POST o GET
$iddetfact = isset($_REQUEST['iddetfact']) ? $_REQUEST['iddetfact'] : NULL;
$idfact = isset($_POST['idfact']) ? $_POST['idfact'] : NULL;
$idprod = isset($_POST['idprod']) ? $_POST['idprod'] : NULL;
$cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : NULL;
$precio_unitario = isset($_POST['precio_unitario']) ? $_POST['precio_unitario'] : NULL;
$subtotal = isset($_POST['subtotal']) ? $_POST['subtotal'] : NULL;
$idemp = isset($_POST['idemp']) ? $_POST['idemp'] : NULL;
$idbar = isset($_POST['idbar']) ? $_POST['idbar'] : NULL; // Cambié idgan a idbar para que coincida con el modelo

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;

// Configurar el modelo con los datos
$mgan->setIddetfact($iddetfact);
$mgan->setIdfact($idfact);
$mgan->setIdprod($idprod);
$mgan->setCantidad($cantidad);
$mgan->setPrecio_unitario($precio_unitario);
$mgan->setSubtotal($subtotal);
$mgan->setIdemp($idemp);
$mgan->setIdbar($idbar);

// Operación para guardar datos
if ($ope == "save") {
    try {
        $mgan->save();
        echo "Datos guardados correctamente.";
    } catch (Exception $e) {
        echo "Error al guardar: " . $e->getMessage();
    }
}

// Operación para editar datos
if ($ope == "edit" && $iddetfact) {
    try {
        $mgan->edit();
        echo "Datos editados correctamente.";
    } catch (Exception $e) {
        echo "Error al editar: " . $e->getMessage();
    }
}

// Operación para eliminar datos
if ($ope == "delete" && $iddetfact) {
    try {
        $mgan->del();
        echo "Datos eliminados correctamente.";
    } catch (Exception $e) {
        echo "Error al eliminar: " . $e->getMessage();
    }
}

// Obtener un registro específico si es necesario
$datOne = NULL;
if ($iddetfact) {
    try {
        $datOne = $mgan->getOne();
    } catch (Exception $e) {
        echo "Error al obtener el registro: " . $e->getMessage();
    }
}

// Obtener todos los registros
try {
    $gans = $mgan->getAll();
} catch (Exception $e) {
    echo "Error al obtener los registros: " . $e->getMessage();
}

?>