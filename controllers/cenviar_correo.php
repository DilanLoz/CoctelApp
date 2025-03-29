<?php
require_once '../models/conexion.php'; // Incluir la conexión a la base de datos
require '../vendor/autoload.php'; // Cargar PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$pdo = (new Conexion())->get_conexion(); // Obtener conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emausu = trim($_POST['emausu']);

    // Verificar si el correo existe y obtener nombre y apellido
    $stmt = $pdo->prepare("SELECT nomusu FROM usuario WHERE emausu = ?");
    $stmt->execute([$emausu]);
    $user = $stmt->fetch();

    if ($user) {
        $nombre = htmlspecialchars($user['nomusu']);
        // Generar token único
        $token = bin2hex(random_bytes(32));

        // Insertar token con expiración de 15 minutos
        $stmt = $pdo->prepare("INSERT INTO token (emausu, token, expiracion) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 15 MINUTE))");
        $stmt->execute([$emausu, $token]);

        // Configurar PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'coctelapp.info@gmail.com';
            $mail->Password = 'nqme fzom dbic opmq'; // Usa una contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('coctelapp.info@gmail.com', 'CoctelApp');
            $mail->addAddress($emausu);

            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';

            // Enlace con el token
            $enlace = "https://coctelapp.shop/index.php?pg=1004&token=" . $token;

            // Cuerpo del correo en HTML
            $mail->Body = "
            <div style='max-width: 600px; margin: auto; padding: 20px; font-family: Arial, sans-serif; border: 1px solid #ddd; border-radius: 10px; background-color: #ffffff;'>
                <div style='text-align: center; margin-bottom: 20px;'>
                    <img src='img/coctelapp/logo.png' alt='CoctelApp' style='width: 120px;'>
                </div>
                <h2 style='color: #333; text-align: center;'>Hola, {$nombre}</h2>
                <p style='text-align: center; color: #555; font-size: 16px;'>
                    Recibimos una solicitud para restablecer tu contraseña. Haz clic en el botón de abajo para continuar:
                </p>
                <div style='text-align: center; margin: 20px 0;'>
                    <a href='{$enlace}' 
                        style='display: inline-block; padding: 12px 20px; background-color: rgb(255, 196, 0); color: white; 
                        text-decoration: none; font-size: 16px; font-weight: bold; border-radius: 5px;'>
                        Restablecer Contraseña
                    </a>
                </div>
                <div style='margin-top: 30px; background-color: #f8d7da; color: #721c24; border-radius: 5px; padding: 15px;'>
                    <strong>Advertencia:</strong> Si no realizaste esta solicitud, ignora este mensaje. Para más información, contáctanos.
                </div>
                <p style='color: #888; font-size: 14px; text-align: center; margin-top: 20px;'>Este enlace es válido por 15 minutos.</p>
                <div style='text-align: center; margin-top: 30px;'>
                    <img src='img/coctelapp/logocompra.png' alt='CoctelApp' style='width: 150px;'>
                    <p style='color: #777; font-size: 13px;'>Si necesitas ayuda, contáctanos en <a href='mailto:soporte@coctelapp.com' style='color: #007bff; text-decoration: none;'>soporte@coctelapp.com</a></p>
                </div>
            </div>
        ";

            $mail->send();
            echo "<script>alert('Correo enviado con éxito a {$emausu}. Revisa tu bandeja de entrada.'); window.location.href='../index.php?pg=1002';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Error al enviar el correo: {$mail->ErrorInfo}'); window.location.href='../index.php?pg=1002';</script>";
        }
    } else {
        echo "<script>alert('El correo {$emausu} no está registrado.'); window.location.href='../index.php?pg=1002';</script>";
    }
}
?>
