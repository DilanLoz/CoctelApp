<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['emausu'];
    $nombre_bar = $_POST['nombre_bar'];
    $nit = $_POST['nit'];
    $direccion = $_POST['direccion'];
    $propietario = $_POST['propietario'];
    $ciudad = $_POST['ciudad'];
    $hora_apertura = $_POST['hora_apertura'];
    $hora_cierre = $_POST['hora_cierre'];
    $plan = $_POST['plan'];
    $mensaje = $_POST['mensaje'];

    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'xxxxxx'; // El correo que envía
        $mail->Password = 'xxxxxx'; // Usa una clave de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remitente (el mismo que envía el correo)
        $mail->setFrom('coctelapp.info@gmail.com', 'CoctelApp - Planes de Bares');

        // Destinatario (donde se recibirán los mensajes)
        $mail->addAddress('coctelapp.info@gmail.com');

        // Configurar "Reply-To" para que puedas responder al usuario
        $mail->addReplyTo($correo, 'Usuario del Formulario');

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nueva Solicitud de Plan';
        $mail->Body = "
            <h3>Detalles de la solicitud</h3>
            <p><strong>Correo:</strong> $correo</p>
            <p><strong>Nombre del Bar:</strong> $nombre_bar</p>
            <p><strong>NIT:</strong> $nit</p>
            <p><strong>Dirección:</strong> $direccion</p>
            <p><strong>Propietario:</strong> $propietario</p>
            <p><strong>Ciudad:</strong> $ciudad</p>
            <p><strong>Hora de Apertura:</strong> $hora_apertura</p>
            <p><strong>Hora de Cierre:</strong> $hora_cierre</p>
            <p><strong>Plan Seleccionado:</strong> $plan</p>
            <p><strong>Mensaje:</strong> $mensaje</p>
        ";

        $mail->send();
        
        // Redirige con éxito
        header("Location: ../index.php?pg=2001&success=1");
        exit();
    } catch (Exception $e) {
        // Redirige con error
        header("Location: ../index.php?pg=2001&error=1&msg=" . urlencode($mail->ErrorInfo));
        exit();
    }
}

?>
