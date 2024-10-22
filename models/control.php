<?php
require_once('conexion.php');

// Obtener los datos del formulario de inicio de sesión
$usu = isset($_POST['usu']) ? $_POST['usu'] : NULL;
$pas = isset($_POST['pss']) ? $_POST['pss'] : NULL;

if (!$usu || !$pas) {
    red('empty');  // Si faltan datos
}

// Verificar que el email tenga el formato @gmail.com
if (!validaActor($usu)) {
    red('invalid_email');  // Si el formato del email es incorrecto
}

// Verificar credenciales
$userData = valida($usu, $pas);
if ($userData) {
    // Si las credenciales son correctas, iniciar sesión
    session_start();
    $_SESSION['id'] = $userData['id'];        // Guardar ID del actor
    $_SESSION['nombre'] = $userData['nombre'];  // Guardar nombre del actor
    $_SESSION['idper'] = $userData['idper'];      // Guardar el idper del actor

    // Redirigir a la página de inicio correspondiente
    header('Location: home.php');  // Cambia a la página que corresponda
} else {
    red('wrong_credentials');  // Si las credenciales son incorrectas
}

// Función para determinar el perfil basado en el formato del email
function validaActor($usu) {
    // Verificar que el email tenga el formato @gmail.com
    if (strpos($usu, '@gmail.com') !== false) {
        return true; // Puede ser un actor válido
    }
    return NULL; // Email no válido
}

// Función para validar credenciales del usuario, bar o empleado
function valida($email, $password) {
    global $conn;

    // Preparar la consulta para verificar credenciales
    $sql = "SELECT idusu AS id, nomusu AS nombre, pssusu AS password, idper 
            FROM usuario WHERE emausu = ? AND pssusu = ?
            UNION
            SELECT idbar AS id, nombar AS nombre, pssbar AS password, idper 
            FROM bar WHERE emabar = ? AND pssbar = ?
            UNION
            SELECT idemp AS id, nomemp AS nombre, pssemp AS password, idper 
            FROM empleado WHERE emaemp = ? AND pssemp = ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $email, $password, $email, $password, $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();  // Retornar los datos del actor
    }
    return false;  // Retornar falso si no coincide el email o la contraseña
}

// Función para redirigir en caso de error
function red($error) {
    header('Location: ../index.php?err=' . $error);
    exit();
}
?>
