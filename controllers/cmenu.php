<?php 
session_start(); // Make sure the session is started
include "models/mmenu.php";

$mmenu = new Mmenu();
$dtAll = $mmenu->getMenu();

function validar($idpag){
    $mmenu = new Mmenu();
    $mmenu->setIdpag($idpag);
    $dat = $mmenu->getVal();
    return $dat;
}
?>