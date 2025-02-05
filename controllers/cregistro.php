<?php
// Incluir el modelo
include("models/mpusu.php");

// Obtener los valores de idval filtrados
$mpusu = new Mpusu();

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $numdocu = isset($_POST['numdocu']) ? $_POST['numdocu'] : NULL;
    $nomusu = isset($_POST['nomusu']) ? $_POST['nomusu'] : NULL;
    $fecnausu = isset($_POST['fecnausu']) ? $_POST['fecnausu'] : NULL;
    $codubi = isset($_POST['codubi']) ? $_POST['codubi'] : NULL;
    $idval = isset($_POST['idval']) ? $_POST['idval'] : NULL;
    $emausu = isset($_POST['emausu']) ? $_POST['emausu'] : NULL;
    $pssusu = isset($_POST['pssusu']) ? $_POST['pssusu'] : NULL;

    // Verificar si el perfil ya existe
    $perfilExistente = $mpusu->buscarPerfil($numdocu, $emausu);

    if ($perfilExistente) {
        // Si el perfil ya existe, mostrar mensaje
        $message = "Perfil ya creado anteriormente.";
    } else {
        // Realizar el hash de la contraseña antes de guardarla
        $pssusuHashed = sha1(md5($pssusu . 'Jd#')); // El mismo hash que en control.php

        // Configurar los datos para guardar
        $mpusu->setNumdocu($numdocu);
        $mpusu->setNomusu($nomusu);
        $mpusu->setFecnausu($fecnausu);
        $mpusu->setCodubi($codubi);
        $mpusu->setEmausu($emausu);
        $mpusu->setPssusu($pssusuHashed); // Usar la contraseña hasheada
        $mpusu->setIdper(10); // Siempre será 10 para usuarios
        $mpusu->setIdval($idval); // Asignar el idval seleccionado

        try {
            // Guardar el perfil
            $resultado = $mpusu->save();
            if ($resultado === true) {
                $message = "Perfil creado exitosamente.";
            } else {
                $message = "Error al crear el perfil: " . $resultado;
            }
        } catch (Exception $e) {
            $message = "Error al crear el perfil: " . $e->getMessage();
        }
    }
}
?>
