<?php
require_once ('admin/models/mubi.php');
$mubi = new Mubi();

$codubi = isset($_REQUEST['codubi']) ? $_REQUEST['codubi']:NULL;
$nomubi = isset($_POST['nomubi']) ? $_POST['nomubi']:NULL;
$depubi = isset($_POST['depubi']) ? $_POST['depubi']:NULL;

$opera = isset($_REQUEST['opera']) ? $_REQUEST['opera']:NULL;
$datOne = NULL;
$mubi->setcodubi($codubi);
if($opera=="save"){
    $mubi->setcodubi($codubi);
    $mubi->setNomubi($nomubi);
    $mubi->setdepubi($depubi);
    if(!$codubi) $mubi->save();else $mubi->edit();
}
if($opera=="eli" && $codubi) $mubi->del();
if($opera=="edi" && $codubi) $datOne = $mubi->getOne($codubi);

$dataAll = $mubi->getAll();
?>