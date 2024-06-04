<?php
require_once('conexion.php');

$ema = isset($_POST['ema']) ? $_POST['ema'] : NULL;
$pss = isset($_POST['pss']) ? $_POST['pss'] : NULL;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL; // Tipo de usuario seleccionado

if ($ema && $pss && $tipo) {
    valida($ema, $pss, $tipo);
} else {
    red();
}

function valida($ema, $pss, $tipo)
{
    switch ($tipo) {
        case 'usuario':
            ingrUsuario($ema, $pss);
            break;
        case 'empleado':
            ingrEmpleado($ema, $pss);
            break;
        case 'bar':
            ingrBar($ema, $pss);
            break;
        default:
            red();
    }
}

function red()
{
    echo "<script>window.location='../index.php?err=oK';</script>";
}

function ingrUsuario($ema, $pss)
{
    $res = NULL;
    $pss = sha1(md5($pss . 'dlHagO#')); // Aplicar hashing a la contraseña
    
    $sql = "SELECT idusu, nomusu, tipdocu FROM usuario WHERE emausu = :emausu AND pssusu = :pssusu";
    
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->bindParam(":emausu", $ema);
    $result->bindParam(":pssusu", $pss);
    $result->execute();
    $res = $result->fetch(PDO::FETCH_ASSOC);

    if ($res) {
        iniciarSesion($res['idusu'], $res['nomusu'], $res['tipdocu']);
    } else {
        red();
    }
}

function ingrEmpleado($ema, $pss)
{
    $res = NULL;
    $pss = sha1(md5($pss . 'dlHagO#')); // Aplicar hashing a la contraseña
    
    $sql = "SELECT idemp, nomemp, tipdocu FROM empleado WHERE emaemp = :emaemp AND pssemp = :pssemp";
    
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->bindParam(":emaemp", $ema);
    $result->bindParam(":pssemp", $pss);
    $result->execute();
    $res = $result->fetch(PDO::FETCH_ASSOC);

    if ($res) {
        iniciarSesion($res['idemp'], $res['nomemp'], $res['tipdocu']);
    } else {
        red();
    }
}

function ingrBar($ema, $pss)
{
    $res = NULL;
    $pss = sha1(md5($pss . 'dlHagO#')); // Aplicar hashing a la contraseña
    
    $sql = "SELECT idbar, nombar FROM bar WHERE emabar = :emabar AND pssbar = :pssbar";
    
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->bindParam(":emabar", $ema);
    $result->bindParam(":pssbar", $pss);
    $result->execute();
    $res = $result->fetch(PDO::FETCH_ASSOC);

    if ($res) {
        iniciarSesion($res['idbar'], $res['nombar'], 'bar');
    } else {
        red();
    }
}

function iniciarSesion($id, $nombre, $tipo)
{
    session_start();
    $_SESSION['id'] = $id;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['tipo'] = $tipo;
    echo "<script>window.location='../home.php';</script>";
}
?>
