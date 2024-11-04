<?php
require_once('conexion.php');
$usu = isset($_POST['usu']) ? $_POST['usu'] : NULL;
$pas = isset($_POST['pss']) ? $_POST['pss'] : NULL;

if ($usu && $pas) {
    valida($usu, $pas);
} else {
    red();
}

function valida($usu, $pas) {
    $res = ingr($usu, $pas);
    $res = isset($res) ? $res : NULL;
    if ($res) {
        session_start();
        $_SESSION['idusu'] = $res[0]['idusu'];
        $_SESSION['nomusu'] = $res[0]['nomusu'];
        $_SESSION['emausu'] = $res[0]['emausu'];
        $_SESSION['celusu'] = $res[0]['celusu'];
        $_SESSION['numdocu'] = $res[0]['numdocu'];
        $_SESSION['fecnausu'] = $res[0]['fecnausu'];
        $_SESSION['pssusu'] = $res[0]['pssusu'];
        $_SESSION['codubi'] = $res[0]['codubi'];
        $_SESSION['idval'] = $res[0]['idval'];
        
        // Datos de perfil
        $_SESSION['idper'] = $res[0]['idper'];
        $_SESSION['nomper'] = $res[0]['nomper'];
        $_SESSION['pagini'] = $res[0]['pagini'];
        $_SESSION['aut'] = '1011322322#2006'; 
        echo "<script>window.location='../home.php?';</script>";
    } else {
        red();
    }
}

function red() {
    echo "<script>window.location='../index.php?err=oK';</script>";
}

function ingr($usu, $pas) {
    $res = NULL;
    $pas = sha1(md5($pas . 'Jd#'));
    
    $sql = "SELECT u.idusu, u.nomusu, u.emausu, u.celusu, u.fotiden, u.numdocu, u.fecnausu, u.pssusu, u.codubi, u.idper, u.idval, f.nomper, f.pagini 
            FROM usuario AS u 
            INNER JOIN perfiles AS f ON u.idper = f.idper 
            WHERE u.emausu = :emausu AND u.pssusu = :pssusu";
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->bindParam(":emausu", $usu);
    $result->bindParam(":pssusu", $pas);
    $result->execute();
    
    $res = $result->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}
?>
