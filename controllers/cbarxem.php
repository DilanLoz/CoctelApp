<?php 
include("models/mbarxem.php");
include("controllers/optimg.php");

$idemp = isset($_REQUEST['idemp']) ? $_REQUEST['idemp']:NULL;
$nomemp = isset($_POST['nomemp']) ? $_POST['nomemp']:NULL;
$emaemp = isset($_POST['emaemp']) ? $_POST['emaemp']:NULL;
$celemp = isset($_POST['celemp']) ? $_POST['celemp']:NULL;
$fotiden = isset($_POST['fotiden']) ? $_POST['fotiden']:NULL;
$fecnaemp = isset($_POST['fecnaemp']) ? $_POST['fecnaemp']:NULL;
$numdocu = isset($_POST['numdocu']) ? $_POST['numdocu']:NULL;
$pssemp = isset($_POST['pssemp']) ? $_POST['pssemp']:NULL;
$idserv = isset($_POST['idserv']) ? $_POST['idserv']:NULL;
$idbar = isset($_POST['idbar']) ? $_POST['idbar']:NULL;
$codubi = isset($_POST['codubi']) ? $_POST['codubi']:NULL;
$idper = isset($_POST['idper']) ? $_POST['idper']:NULL;
$idval = isset($_POST['idval']) ? $_POST['idval']:NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$fots = isset($_FILES['fots']['name']) ? $_FILES['fots']['name']:NULL;

if ($fots){
	if(file_exists($fotiden)) unlink($fotiden);
	$fotiden = opti($_FILES['fots'], 'fot','jotos',date('YmdHis'));
}


$mbarxem=new Mbarxem();
$mbarxem->setIdemp($idemp);
if ($ope=="save") {
	$mbarxem->setNomemp($nomemp);
	$mbarxem->setEmaemp($emaemp);
	$mbarxem->setCelemp($celemp);
	$mbarxem->setFotiden($fotiden);
    $mbarxem->setFecnaemp($fecnaemp);
    $mbarxem->setNumdocu($numdocu);
	$mbarxem->setPssemp($pssemp);
	$mbarxem->setIdserv($idserv);
	$mbarxem->setIdbar($idbar);
    $mbarxem->setCodubi($codubi);
	$mbarxem->setIdper($idper);
	$mbarxem->setIdval($idval);

	if($idemp) $mbarxem->edit();
	else $mbarxem->save();
}

$m=2;
if ($ope=="del" && $idemp) $mbarxem->del();
if ($ope=="edi" && $idemp){
	$dtOne = $mbarxem->getOne();
	$m=1;
}else{ 
	$dtOne=NULL;
}

$dat=$mbarxem->getAll();

?>