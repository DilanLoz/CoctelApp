<?php 
include("models/mpusu.php");

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
$idval = isset($_POST['fotiden']) ? $_POST['fotiden']:NULL;
$ope = isset($_REQUEST['idval']) ? $_REQUEST['idval']:NULL;



$mpusu=new Mpusu();
$mpusu->setidusu($idusu);
if ($ope=="save") {
	$mpusu->setNomusu($nomusu);
	$mpusu->setEmausu($emausu);
	$mpusu->setCelusu($celusu);
	$mpusu->setFotiden($fotiden);
    $mpusu->setNumdocu($numdocu);
    $mpusu->setFecnausu($fecnausu);
    $mpusu->setPssusu($pssusu);
    $mpusu->setCodubi($codubi);
    $mpusu->setIdper($idper);
    $mpusu->setIdval($idval);
	if($idusu) $mpusu->edit();
	else $mpusu->save();
}

$m=2;
if ($ope=="del" && $idusu) $mpusu->del();
if ($ope=="edi" && $idusu){
	$dtOne = $mpusu->getOne();
	$m=1;
}else{ 
	$dtOne=NULL;
}

$dat=$mpusu->getAll();

?>