<?php
require_once ('models/mpemp.php');

$mpemp = new Mpemp();

$fecnaemp = date("Y-m-d H:i:s");
//metodos request empleado
$idemp = isset($_REQUEST['idemp']) ? $_REQUEST['idemp']:NULL;
//metodos request perfiles
$idper = isset($_REQUEST['idper']) ? $_REQUEST['idper']:NULL;

// metodos post empleado
$nomemp = isset($_POST['nomemp']) ? $_POST['nomemp']:NULL;
$emaemp = isset($_POST['emaemp']) ? $_POST['emaemp']:NULL;
$celemp = isset($_POST['celemp']) ? $_POST['celemp']:NULL;
$fecnaemp = isset($_POST['fecnaemp']) ? $_POST['fecnaemp']:$fecnaemp;
$numdocu = isset($_POST['numdocu']) ? $_POST['numdocu']:NULL;
$fotiden = isset($_POST['fotiden']) ? $_POST['fotiden']:NULL;
$pssemp = isset($_POST['pssemp']) ? $_POST['pssemp']:NULL;
$idserv = isset($_POST['idserv']) ? $_POST['idserv']:NULL;
$idbar = isset($_POST['idbar']) ? $_POST['idbar']:NULL;
$codubi = isset($_POST['codubi']) ? $_POST['codubi']:NULL;
$idper = isset($_POST['idper']) ? $_POST['idper']:NULL;
$idval = isset($_POST['idval']) ? $_POST['idval']:NULL;
//metodos post perfiles
$nomper = isset($_POST['nomper']) ? $_POST['nomper']:NULL;
$pagini = isset($_POST['pagini']) ? $_POST['pagini']:NULL;
//ope = opera
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$opera = isset($_REQUEST['opera']) ? $_REQUEST['opera']:NULL;
$datOneEmp = NULL;
$datOnePer = NULL;

//Empleado
$mpemp->setIdemp($idemp);
if($ope=="save"){
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
	$mpemp->setIdper($idper);
	$mpemp->setIdval($idval);
	$mpemp->save();
}

if($ope=="eli" && $idemp) $mpemp->delEmp();
if($ope=="edi" && $idemp)$datOneEmp = $mpemp->getOneEmp($idemp);

//Perfiles
$mpemp->setIdper($idper);
if($opera=="save"){
	$mpemp->setNomper($nomper);
	$mpemp->setPagini($pagini);
	$mpemp->save();
}

if($opera=="eli" && $idper) $mpemp->delPer();
if($opera=="edi" && $idper)$datOnePer = $mpemp->getOnePer($idper);



$datAllEmp = $mpemp->getAllEmp();
$datAllPer = $mpemp->¨getAllPer();

?>