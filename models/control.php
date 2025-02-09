<?php
require_once('conexion.php');
session_start();

// Captura los datos del formulario
$usu = isset($_POST['usu']) ? $_POST['usu'] : NULL;
$pas = isset($_POST['pss']) ? $_POST['pss'] : NULL;
$recaptchaResponse = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : NULL;

// Clave secreta de reCAPTCHA (reemplázala con la tuya)
$recaptchaSecret = '6Lcz88sqAAAAAEGboig9RlktV2F4ZcHWXZldgXAM';

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
        $message = "Error: No se pudo validar el reCAPTCHA.";
        header("Location: ../index.php?pg=1002&err=recaptcha&msg=" . urlencode($message));
        exit;
    } else {
        // Si reCAPTCHA es válido, proceder con la validación del usuario
        valida($usu, $pas);
    }
} else {
    $message = "Error: Debes completar el formulario correctamente.";
    header("Location: ../index.php?pg=1002&err=form&msg=" . urlencode($message));
    exit;
}

// Función para validar el usuario y redirigirlo según su perfil
function valida($usu, $pas) {
    $res = ingr($usu, $pas);
    if ($res) {
        // Verificar si la cuenta está desactivada
        if ($res[0]['estado'] == 2) {
            $message = "Error: Tu cuenta ha sido desactivada por inactividad. Contacta al administrador.";
            header("Location: ../index.php?pg=1002&err=inactive&msg=" . urlencode($message));
            exit;
        }

        // Actualizar la fecha de último inicio de sesión
        actualizarUltimoAcceso($res[0]['idusu']);

        // Guardar datos en la sesión
        $_SESSION['idusu'] = $res[0]['idusu'];
        $_SESSION['nomusu'] = $res[0]['nomusu'];
        $_SESSION['emausu'] = $res[0]['emausu'];
        $_SESSION['celusu'] = $res[0]['celusu'];
        $_SESSION['idper'] = $res[0]['idper'];
        $_SESSION['nomper'] = $res[0]['nomper'];
        $_SESSION['pagini'] = $res[0]['pagini'];
        $_SESSION['aut'] = '1011322322#2006';

        // Redirigir al home.php según el perfil del usuario
        $redirectPages = [
            10 => "home.php?pg=1002",
            20 => "home.php?pg=2001",
            30 => "home.php?pg=3001",
            40 => "home.php?pg=4100"
        ];

        $redirectUrl = isset($redirectPages[$res[0]['idper']]) ? $redirectPages[$res[0]['idper']] : "home.php";
        
        header("Location: ../" . $redirectUrl);
        exit;
    } else {
        $message = "Error: Credenciales incorrectas.";
        header("Location: ../index.php?pg=1002&err=invalid&msg=" . urlencode($message));
        exit;
    }
}

// Función para verificar los datos en la base de datos
function ingr($usu, $pas) {
    $pas = sha1(md5($pas . 'Jd#')); // Encriptación de la contraseña
    $sql = "SELECT 
                u.idusu, u.nomusu, u.emausu, u.celusu, 
                u.idper, f.nomper, f.pagini, u.estado
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

// Función para actualizar la fecha de último acceso
function actualizarUltimoAcceso($idusu) {
    try {
        $sql = "UPDATE usuario SET ultimo_acceso = NOW() WHERE idusu = :idusu";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $idusu);
        $result->execute();
    } catch (Exception $e) {
        error_log("Error al actualizar último acceso: " . $e->getMessage());
    }
}

// Desactivar usuarios inactivos por más de 4 meses
function desactivarUsuariosInactivos() {
    try {
        $sql = "UPDATE usuario 
                SET estado = 2 
                WHERE ultimo_acceso <= NOW() - INTERVAL 4 MONTH 
                AND estado = 1";
                
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
    } catch (Exception $e) {
        error_log("Error al desactivar usuarios inactivos: " . $e->getMessage());
    }
}

// Ejecutar la función de desactivación al cargar este script
desactivarUsuariosInactivos();
?>
