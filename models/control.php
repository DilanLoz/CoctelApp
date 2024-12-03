<?php
require_once('conexion.php');

// Captura los datos enviados desde el formulario
$usu = isset($_POST['usu']) ? $_POST['usu'] : NULL;
$pas = isset($_POST['pss']) ? $_POST['pss'] : NULL;

// Validación inicial
if ($usu && $pas) {
    valida($usu, $pas);
} else {
    redirigirError();
}

// Función para validar el usuario
function valida($usu, $pas) {
    $res = ingr($usu, $pas);
    if ($res) {
        // Inicio de sesión y almacenamiento de datos en $_SESSION
        session_start();
        $_SESSION['idusu'] = $res[0]['idusu'];
        $_SESSION['nomusu'] = $res[0]['nomusu'];
        $_SESSION['emausu'] = $res[0]['emausu'];
        $_SESSION['celusu'] = $res[0]['celusu'];
        $_SESSION['idper'] = $res[0]['idper'];
        $_SESSION['nomper'] = $res[0]['nomper'];
        $_SESSION['pagini'] = $res[0]['pagini'];
        $_SESSION['aut'] = '1011322322#2006'; 
        // Redirigir al área principal
        header("Location: ../home.php");
        exit;
    } else {
        // Datos inválidos
        redirigirError();
    }
}

// Función para redirigir con error
function redirigirError() {
    header("Location: ../index.php?pg=1002&err=invalid");
    exit;
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
