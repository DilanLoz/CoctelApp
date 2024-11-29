<?php require_once ('admin/models/mdom.php');

$mdom = new Mdom();

$iddom =isset($_REQUEST['iddom']) ? $_REQUEST['iddom']:NULL;
$nomdom=isset($_POST['nomdom']) ? $_POST['nomdom']:NULL;
$opera =isset($_REQUEST['opera']) ? $_REQUEST['opera']:NULL;

$datOne = NULL;
//GUARDAR
$mdom->setIddom($iddom);
if($opera=="save"){
    if($nomdom){
		$mdom->setNomdom($nomdom);
		if(!$iddom) $mdom->save();else $mdom->edit();
	}else echo '<script>err("Todos los datos son obligatorios.");</script>';
}

if($opera=="eli" && $iddom) $mdom->del();
if($opera=="edi" && $iddom) $datOne = $mdom->getOne();

//MOSTRAR TODOS LOS datos
$dat = $mdom->getAll();
?>