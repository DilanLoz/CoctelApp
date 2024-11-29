<?php
require_once ('admin/models/mval.php');
require_once ('admin/models/mdom.php');

$mval = new Mval();
$mdom = new Mdom();

$idval =isset($_REQUEST['idval']) ? $_REQUEST['idval']:NULL;
$nomval=isset($_POST['nomval']) ? $_POST['nomval']:NULL;
$iddom=isset($_POST['iddom']) ? $_POST['iddom']:NULL;
$act=isset($_REQUEST['act']) ? $_REQUEST['act']:NULL;

$opera =isset($_REQUEST['opera']) ? $_REQUEST['opera']:NULL;
$datOne = NULL;

$mval->setIdval($idval);
if($opera=="save"){
    $mval->setIddom($iddom);
    $mval->setNomval($nomval);
    $mval->setAct($act);
    if(!$idval) $mval->save();else $mval->edit();
}

if($opera=="acti" && $idval && $act){
    $mval->setAct($act);
    $mval->editAct();
}

if($opera=="eli" && $idval) $mval->del();
if($opera=="edi" && $idval) $datOne = $mval->getOne();

//MOSTRAR TODOS LOS datos
$datAll = $mval->getAll();
$datDom = $mdom-> getALL();
?>