<?php
require_once ('admin/models/musu.php');
require_once("controllers/optimg.php");
$musu = new Musu();

$idusu = isset($_REQUEST['idusu']) ? $_REQUEST['idusu']:NULL;
$nomusu = isset($_POST['nomusu']) ? $_POST['nomusu']:NULL;
$emausu = isset($_POST['emausu']) ? $_POST['emausu']:NULL;
$celusu = isset($_POST['celusu']) ? $_POST['celusu']:NULL;
$fotiden = isset($_POST['fotiden']) ? $_POST['fotiden']:NULL;
$numdocu = isset($_POST['numdocu']) ? $_POST['numdocu']:NULL;
$fecnausu = isset($_POST['fecnausu']) ? $_POST['fecnausu']:NULL;
$pssusu = isset($_POST['pssusu']) ? $_POST['pssusu']:NULL;
$codubi = isset($_POST['codubi']) ? $_POST['codubi']:NULL;
$idper = isset($_POST['idper']) ? $_POST['idper']:NULL;
$idval = isset($_POST['idval']) ? $_POST['idval']:NULL;
$fotid = isset($_FILES['fotid']['name']) ? $_FILES['fotid']['name']:NULL;

$opera = isset($_REQUEST['opera']) ? $_REQUEST['opera']:NULL;
$datOne = NULL;

$m=2;
if ($opera=="del" && $idusu) $musu->del();
if ($opera=="edit" && $idusu){
	$dtOne = $musu->getOne();
	$m=1;
}else{ 
	$dtOne=NULL;
}

if ($fotid){
    if(file_exists($fotiden)) unlink($fotiden);
 	$imgpro = opti($_FILES['fotid'], 'fot','jotos',date('YmdHis'));
}


if($opera=="del" && $idusu) $musu->del();
if($opera=="edit" && $idusu) $datOne = $musu->getOne($idusu);

$datAll = $musu->getAll();
?>