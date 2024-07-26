<?php
include("models/mpbar.php"); // Incluir el modelo de productos

$idbar = isset($_REQUEST['idbar']) ? $_REQUEST['idbar'] : NULL;
$nombar = isset($_POST['nombar']) ? $_POST['nombar'] : NULL;
$nompro = isset($_POST['nompro']) ? $_POST['nompro'] : NULL;
$nit = isset($_POST['nit']) ? $_POST['nit'] : NULL;
$telbar = isset($_POST['telbar']) ? $_POST['telbar'] : NULL;
$dircbar = isset($_POST['dircbar']) ? $_POST['dircbar'] : NULL;
$dircbar = isset($_POST['pssbar']) ? $_POST['pssbar'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;

$mproducto = new Mprod();
$mproducto->setidbar($idbar);

// Operaciones CRUD de productos
if ($ope == "save") {
    $mproducto->setnombar($nombar);
    $mproducto->setnompro($nompro);
    $mproducto->setnit($nit);
    $mproducto->settelbar($telbar);
    $mproducto->setdircbar($dircbar);
    
    if ($idbar) {
        $mproducto->edit(); // Editar producto existente
    } else {
        $mproducto->save(); // Guardar nuevo producto
    }
}

if ($ope == "del" && $idbar) {
    $mproducto->setidbar($idbar);
    $mproducto->del(); // Eliminar producto
}

if ($ope == "edi" && $idbar) {
    $mproducto->setidbar($idbar); // Asegurar que idbar esté correctamente configurado
    $prodOne = $mproducto->getOne(); // Obtener los datos del producto específico
    $m = 1;
} else {
    $prodOne = NULL;
}

$products = $mproducto->getAll(); // Obtener todos los productos

$m = 2; // Variable de control para la interfaz

?>
