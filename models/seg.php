<?php
session_start();
if(session_status()!=2 or $_SESSION['aut']!='1011322322#2006'){
    session_destroy();
    header("Location: index.php");
    exit();
}

function validara($pg) {
    $resultado = NULL;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    
    // Obtener el perfil del usuario
    $idper = isset($_SESSION['idper']) ? $_SESSION['idper'] : 0;
    
    // Consultar la página permitida para este perfil
    $sql = "SELECT p.rutpag FROM pagina AS p
            INNER JOIN perxpag AS pp ON p.idpag = pp.idpag
            WHERE pp.idper = :idper AND p.idpag = :pg";
    
    $result = $conexion->prepare($sql);
    $result->bindParam(":idper", $idper);
    $result->bindParam(":pg", $pg);
    $result->execute();
    
    $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
    
    return $resultado;
}
?>
