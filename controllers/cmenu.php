<?php
include "models/mmenu.php";

$mmenu = new Mmenu();
$dtAll = $mmenu->getMenu();
$menuFiltrado = array_filter($dtAll, function($menu) {
    return $menu['mospag'] == 1;
});
function validar($idpag){
$mmenu = new Mmenu();
$mmenu->setIdpag($idpag);
$dat = $mmenu->getVal();
return $dat;
}
?>