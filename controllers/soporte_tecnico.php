<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require '../config/database.php'; // Asegúrate de incluir la conexión a la base de datos

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['idusu']) || !isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'bar') {
        header("Location: ../index.php?pg=soporte&error=1&msg=" . urlencode("Solo los bares pueden solicitar soporte."));
        exit();
    }

    $nombre_bar = $_POST['nombre_bar'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'coctelapp.info@gmail.com'; 
        $mail->Password = 'eeqk ijhe kesm qhkq'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remitente (el usuario que llena el formulario)
        $mail->setFrom($email, $nombre_bar);

        // Destinatario (soporte de CoctelApp)
        $mail->addAddress('coctelapp.info@gmail.com');

        // Configurar "Reply-To" para que se pueda responder directamente al usuario
        $mail->addReplyTo($email, $nombre_bar);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Solicitud de Soporte Técnico';
        $mail->Body = "
            <h3>Detalles del problema</h3>
            <p><strong>Nombre del Bar:</strong> $nombre_bar</p>
            <p><strong>Correo:</strong> $email</p>
            <p><strong>Teléfono:</strong> $telefono</p>
            <p><strong>Descripción del Problema:</strong> $mensaje</p>
        ";

        $mail->send();

        // Redirige con éxito
        header("Location: ../home.php?pg=3030&success=1");
        exit();
    } catch (Exception $e) {
        // Redirige con error
        header("Location: ../home.php?pg=3030&error=1&msg=" . urlencode($mail->ErrorInfo));
        exit();
    }
}
?>
