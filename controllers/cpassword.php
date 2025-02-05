<?php
require_once("models/mpusu.php");

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emausu = trim($_POST['emausu'] ?? '');
    $numdocu = trim($_POST['numdocu'] ?? '');
    $nueva_contrasena = trim($_POST['pssusu'] ?? '');

    if (empty($emausu) || empty($numdocu) || empty($nueva_contrasena)) {
        $message = "Todos los campos son obligatorios.";
        $message_type = "alert-danger";
    } else {
        $mpusu = new Mpusu();

        if ($mpusu->validarUsuario($numdocu, $emausu)) {
            // Hashear la nueva contraseña
            $nueva_contrasena_hashed = sha1(md5($nueva_contrasena . 'Jd#'));

            $resultado = $mpusu->actualizarContrasena($numdocu, $emausu, $nueva_contrasena_hashed);

            if ($resultado === true) {
                $message = ' <i class="fa-solid fa-circle-check"></i> Contraseña actualizada exitosamente.' ;
                $message_type = "alert-success";
            } else {
                $message = '<i class="fa-solid fa-circle-exclamation"></i> Error al actualizar la contraseña.';
                $message_type = "alert-danger";
            }
        } else {
            $message = '<i class="fa-solid fa-circle-exclamation"></i> No se encontró un usuario con esos datos.';
            $message_type = "alert-danger";
        }
    }
}
?>
