<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'xxxxxx'; // Cambiar por el correo real
        $mail->Password = 'xxxxxx'; // Cambiar por una clave de aplicación segura
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remitente (el usuario que llena el formulario)
        $mail->setFrom($email, $nombre);

        // Destinatario (soporte de CoctelApp)
        $mail->addAddress('coctelapp.info@gmail.com');

        // Configurar "Reply-To" para que se pueda responder directamente al usuario
        $mail->addReplyTo($email, $nombre);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo Mensaje de Contacto / Queja';
        $mail->Body = "
            <h3>Detalles del mensaje</h3>
            <p><strong>Nombre:</strong> $nombre</p>
            <p><strong>Correo:</strong> $email</p>
            <p><strong>Teléfono:</strong> $telefono</p>
            <p><strong>Asunto:</strong> $asunto</p>
            <p><strong>Mensaje:</strong> $mensaje</p>
        ";

        $mail->send();

        // Redirige con éxito
        header("Location: ../index.php?pg=2002&success=1");
        exit();
    } catch (Exception $e) {
        // Redirige con error
        header("Location: ../index.php?pg=2002&error=1&msg=" . urlencode($mail->ErrorInfo));
        exit();
    }
}
?>
