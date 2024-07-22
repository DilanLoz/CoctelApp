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
    $pss = sha1(md5($pss . 'dlHagO#'));
    echo $pss;
    die; // Aplicar hashing a la contraseña
    
    $sql = "SELECT u.idusu, u.nomusu, u.docusu, f.idper, f.nomper, f.pagini FROM usuario AS p INNER JOIN perfil AS f ON u.idper=f.idper AND u.emausu = :emausu AND u.pssusu = :pssusu";
    
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->bindParam(":emausu", $ema);
    $result->bindParam(":pssusu", $pss);
    $result->execute();
    $res = $result->fetch(PDO::FETCH_ASSOC);

    if ($res) {
        iniciarSesion($res['idusu'], $res['nomusu'], $res['nomper'], $res['idper'], $res['pagini']);
    } else {
        red();
    }
}

function ingrEmpleado($ema, $pss)
{
    $res = NULL;
    $pss = sha1(md5($pss . 'dlHagO#')); // Aplicar hashing a la contraseña
    
    $sql = "SELECT e.idemp, e.nomemp, e.numdocu, f.idper, f.nomper, f.pagini FROM empleado AS e INNER JOIN perfil AS f ON e.idper=f.idper AND e.emaemp = :emaemp AND e.pssemp = :pssemp";
    
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->bindParam(":emaemp", $ema);
    $result->bindParam(":pssemp", $pss);
    $result->execute();
    $res = $result->fetch(PDO::FETCH_ASSOC);

    if ($res) {
        iniciarSesion($res['idemp'], $res['nomemp'], $res['nomper'], $res['idper'], $res['pagini']);
    } else {
        red();
    }
}

function ingrBar($ema, $pss)
{
    $res = NULL;
    $pss = sha1(md5($pss . 'dlHagO#')); // Aplicar hashing a la contraseña
    
    $sql = "SELECT b.idbar, b.nombar, b.nit, f.idper, f.nomper, f.pagini FROM bar AS b INNER JOIN perfil AS f ON b.idper=f.idper AND b.emabar = :emabar AND b.pssbar = :pssbar";
    
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->bindParam(":emabar", $ema);
    $result->bindParam(":pssbar", $pss);
    $result->execute();
    $res = $result->fetch(PDO::FETCH_ASSOC);

    if ($res) {
        iniciarSesion($res['idbar'], $res['nombar'], $res['nomper'], $res['idper'], $res['pagini']);
    } else {
        red();
    }
}

function iniciarSesion($id, $nombre, $perfil, $idper, $pagini)
{
    session_start();
    $_SESSION['idper'] = $idper;
    $_SESSION['pagini'] = $pagini;
    echo "<script>window.location='../home.php';</script>";
}
?>
