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

        // Guardar todos los datos en la sesión
        $_SESSION['idusu'] = $res[0]['idusu'];
        $_SESSION['nomusu'] = $res[0]['nomusu'];
        $_SESSION['emausu'] = $res[0]['emausu'];
        $_SESSION['celusu'] = $res[0]['celusu'];
        $_SESSION['fotiden'] = $res[0]['fotiden'];
        $_SESSION['numdocu'] = $res[0]['numdocu'];
        $_SESSION['fecnausu'] = $res[0]['fecnausu'];
        $_SESSION['pssusu'] = $res[0]['pssusu'];
        $_SESSION['codubi'] = $res[0]['codubi'];
        $_SESSION['idper'] = $res[0]['idper'];
        $_SESSION['idval'] = $res[0]['idval'];
        $_SESSION['idbar'] = $res[0]['idbar'];
        $_SESSION['nompropi'] = $res[0]['nompropi'];
        $_SESSION['dircbar'] = $res[0]['dircbar'];
        $_SESSION['horbar'] = $res[0]['horbar'];
        $_SESSION['estado'] = $res[0]['estado'];
        $_SESSION['nomubi'] = $res[0]['nomubi'];
        $_SESSION['nomper'] = $res[0]['nomper'];
        $_SESSION['pagini'] = $res[0]['pagini'];
        $_SESSION['aut'] = '1011322322#2006';

        // Redirigir al home.php según el perfil del usuario
        $redirectPages = [
            10 => "home.php?pg=1015",
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
                u.idusu, u.nomusu, u.emausu, u.celusu, u.fotiden, u.numdocu, u.fecnausu, u.pssusu, u.codubi, 
                u.idper, f.nomper, f.pagini, u.estado, u.idval, u.idbar, u.nompropi, u.dircbar, u.horbar
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


// 🔴 FUNCIÓN PARA PROCESAR LA RECUPERACIÓN DE CONTRASEÑA
function restablecerContrasena($email) {
    $pdo = (new Conexion())->get_conexion();
    
    // 🔹 Verificar si el usuario existe
    $stmt = $pdo->prepare("SELECT idusu FROM usuario WHERE emausu = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        echo "<script>alert('Este correo no está registrado.'); window.location.href='../views/vpassword.php';</script>";
        exit();
    }

    // 🔹 Generar token único
    $token = bin2hex(random_bytes(32));
    $expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // 🔹 Guardar token en la base de datos
    $stmt = $pdo->prepare("INSERT INTO token (emausu, token, expiracion) VALUES (?, ?, ?)");
    $stmt->execute([$email, $token, $expiracion]);

    // 🔹 Enviar correo con el enlace de recuperación
    $link = "http://localhost/CoctelApp-main/views/vpassword.php?token=$token";
    $asunto = "Recuperación de contraseña";
    $mensaje = "Haz clic en el siguiente enlace para restablecer tu contraseña: $link";
    $cabeceras = "From: coctelapp.info@gmail.com\r\n";

    mail($email, $asunto, $mensaje, $cabeceras);

    echo "<script>alert('Se ha enviado un enlace a tu correo electrónico.'); window.location.href='../index.php';</script>";
}

// 🔴 FUNCIÓN PARA CAMBIAR LA CONTRASEÑA USANDO EL TOKEN
function cambiarContrasena($token, $nueva_contraseña) {
    $pdo = (new Conexion())->get_conexion();

    // 🔹 Verificar si el token es válido y no ha expirado
    $stmt = $pdo->prepare("SELECT emausu FROM token WHERE token = ? AND expiracion > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        $emausu = $user['emausu'];
        $hashed_password = sha1(md5($nueva_contraseña . 'Jd#'));

        // 🔹 Actualizar la contraseña
        $stmt = $pdo->prepare("UPDATE usuario SET passusu = ? WHERE emausu = ?");
        $stmt->execute([$hashed_password, $emausu]);

        // 🔹 Eliminar el token usado
        $stmt = $pdo->prepare("DELETE FROM token WHERE token = ?");
        $stmt->execute([$token]);

        echo "<script>alert('Contraseña actualizada con éxito.'); window.location.href='../index.php';</script>";
    } else {
        echo "<script>alert('El token no es válido o ha expirado.'); window.location.href='../index.php';</script>";
    }

}
// Ejecutar la función de desactivación al cargar este script
desactivarUsuariosInactivos();
?>
