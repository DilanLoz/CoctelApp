<?php
include "models/mmenu.php";

// Crear instancia del modelo
$mmenu = new Mmenu();
$mmenu->setIdper($_SESSION['idper']); // Configura el perfil del usuario actual

// Obtén el menú en el orden especificado por `ordpag`
$dat = $mmenu->getMenu();

// Función para validar una página específica
function validar($idpag) {
    $mmenu = new Mmenu();
    $mmenu->setIdpag($idpag);
    $mmenu->setIdper($_SESSION['idper']);
    return $mmenu->getVal();
}
?>
