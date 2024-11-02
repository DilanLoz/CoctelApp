<?php
require_once ('models/mbarxprod.php');
require_once 'models/conexion.php';

$mbarxprod = new Mbarxprod();

//$fecdia = date("Y-m-d H:i:s");

$idprod = isset($_REQUEST['idprod']) ? $_REQUEST['idprod']:NULL;
$nomprod = isset($_POST['nomprod']) ? $_POST['nomprod']:NULL;
$desprod = isset($_POST['desprod']) ? $_POST['desprod']:NULL;
$vlrprod = isset($_POST['vlrprod']) ? $_POST['vlrprod']:NULL;
$fotprod = isset($_POST['fotprod']) ? $_POST['fotprod']:NULL;
$idval = isset($_POST['idval']) ? $_POST['idval']:NULL;
$idbar = isset($_POST['idbar']) ? $_POST['idbar']:NULL;
$cantprod = isset($_POST['cantprod']) ? $_POST['cantprod']:NULL;
$idserv = isset($_POST['idserv']) ? $_POST['idserv']:NULL;
$idusu = isset($_POST['idusu']) ? $_POST['idusu']:NULL;


$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;

$mbarxprod->setIdprod($idprod);
if($ope=="save"){
	$mbarxprod->setNomprod($nomprod);
	$mbarxprod->setDesprod($desprod);
	$mbarxprod->setVlrprod($vlrprod);
	$mbarxprod->setFotprod($fotprod);
	$mbarxprod->setIdval($idval);
	$mbarxprod->setIdbar($idbar);
	$mbarxprod->setCantprod($cantprod);
	$mbarxprod->setIdserv($idserv);
	$mbarxprod->setIdusu($idusu);
	$mbarxprod->save();
}

if($ope=="eli" && $idprod) $mbarxprod->del();
if($ope=="edi" && $idprod)$datOne = $mbarxprod->getOne($idprod);

$datAll = $mbarxprod->getAll();

?>