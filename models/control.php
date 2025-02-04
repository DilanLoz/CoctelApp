<?php
require_once('conexion.php');
session_start();

// Captura los datos del formulario
$usu = isset($_POST['usu']) ? $_POST['usu'] : NULL;
$pas = isset($_POST['pss']) ? $_POST['pss'] : NULL;
$recaptchaResponse = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : NULL;

// Clave secreta de reCAPTCHA (reemplázala con la tuya)
$recaptchaSecret = '6Lcz88sqAAAAAEGboig9RlktV2F4ZcHWXZldgXAM';

// Validación inicial
if ($usu && $pas && $recaptchaResponse) {
    $verifyUrl = "https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse";
    
    // Validación de reCAPTCHA con cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $verifyUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        header("Location: ../index.php?pg=1002&err=recaptcha");
        exit;
    } else {
        // Si reCAPTCHA es válido, proceder con la validación del usuario
        valida($usu, $pas);
    }
} else {
    header("Location: ../index.php?pg=1002&err=recaptcha");
    exit;
}

// Función para validar el usuario
function valida($usu, $pas) {
    $res = ingr($usu, $pas);
    if ($res) {
        // Guardar datos en la sesión
        $_SESSION['idusu'] = $res[0]['idusu'];
        $_SESSION['nomusu'] = $res[0]['nomusu'];
        $_SESSION['emausu'] = $res[0]['emausu'];
        $_SESSION['celusu'] = $res[0]['celusu'];
        $_SESSION['idper'] = $res[0]['idper'];
        $_SESSION['nomper'] = $res[0]['nomper'];
        $_SESSION['pagini'] = $res[0]['pagini'];
        $_SESSION['aut'] = '1011322322#2006'; 

        // Redirigir a home.php tras un inicio de sesión exitoso
        header("Location: ../home.php");
        exit;
    } else {
        header("Location: ../index.php?pg=1002&err=invalid");
        exit;
    }
}

// Función para verificar los datos en la base de datos
function ingr($usu, $pas) {
    $pas = sha1(md5($pas . 'Jd#')); // Encriptación de la contraseña
    $sql = "SELECT 
                u.idusu, u.nomusu, u.emausu, u.celusu, 
                u.idper, f.nomper, f.pagini
            FROM usuario AS u
            INNER JOIN perfiles AS f ON u.idper = f.idper
            WHERE u.emausu = :emausu AND u.pssusu = :pssusu";
            
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->bindParam(":emausu", $usu);
    $result->bindParam(":pssusu", $pas);
    $result->execute();
    
    return $result->fetchAll(PDO::FETCH_ASSOC);
}
?>
