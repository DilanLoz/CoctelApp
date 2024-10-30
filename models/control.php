<?php
    require_once('conexion.php');
    date_default_timezone_set('America/Bogota');
    
    // Recoger datos de POST
    $usu = isset($_POST['usu']) ? $_POST['usu'] : NULL;
    $pss = isset($_POST['pss']) ? $_POST['pss'] : NULL;
    
    // Si se reciben los datos de usuario y contraseña, se valida
    if ($usu && $pss) {
        validar($usu, $pss);
    } else {
        echo '<script>window.location="../index.php?error=ok";</script>';
    }
    
    // Función que valida el usuario
    function validar($usu, $pss) {
        // Obtener resultado de la validación
        $res = verdat($usu, $pss);
        $res = isset($res) ? $res : NULL;

        if ($res) {
            session_start(); // Iniciar la sesión
            
            // Dependiendo del tipo de actor, se configuran las variables de sesión
            if (isset($res[0]["idusu"])) {
                // Si es un usuario
                $_SESSION["idusu"] = $res[0]["idusu"];
                $_SESSION["nomusu"] = $res[0]["nomusu"];
                $_SESSION["idper"] = $res[0]["idper"]; // Perfil del usuario
                $_SESSION["actor"] = 'usuario';  // Definir el tipo de actor para futuras referencias

            } elseif (isset($res[0]["idbar"])) {
                // Si es un bar
                $_SESSION["idbar"] = $res[0]["idbar"];
                $_SESSION["nombar"] = $res[0]["nombar"];
                $_SESSION["idper"] = $res[0]["idper"]; // Perfil del bar
                $_SESSION["actor"] = 'bar';  // Definir el tipo de actor para futuras referencias

            } elseif (isset($res[0]["idemp"])) {
                // Si es un empleado
                $_SESSION["idemp"] = $res[0]["idemp"];
                $_SESSION["nomemp"] = $res[0]["nomemp"];
                $_SESSION["idper"] = $res[0]["idper"]; // Perfil del empleado
                $_SESSION["actor"] = 'empleado';  // Definir el tipo de actor para futuras referencias
            }

            // Variable de autorización (podrías cambiarla si es un token de seguridad)
            $_SESSION["aut"] = "jY238Jn&5Hhass.??44aa@@fg(80)";
            
            // Redirección a la página de inicio
            echo '<script>window.location="../home.php";</script>';

        } else {
            // Si no se valida correctamente, redirigir al login con error
            echo '<script>window.location="../index.php?error=invalid_credentials";</script>';
        }
    }

    // Función que realiza la consulta en la base de datos
    function verdat($usu, $pss) {
        // Encriptar la contraseña con sha1(md5())
        $pas = sha1(md5($pss));
        
        // Consulta SQL para los tres tipos de actores, usando nombres únicos para los parámetros
        $sql = "SELECT idusu, nomusu, pssusu, idper 
                FROM usuario 
                WHERE emausu = :usu1 AND pssusu = :pss1
                UNION
                SELECT idbar, nombar, pssbar, idper 
                FROM bar 
                WHERE emabar = :usu2 AND pssbar = :pss2
                UNION
                SELECT idemp, nomemp, pssemp, idper 
                FROM empleado 
                WHERE emaemp = :usu3 AND pssemp = :pss3";

        // Crear la conexión
        $modelo = new conexion();
        $pssexion = $modelo->get_conexion();
        
        // Preparar y ejecutar la consulta
        $result = $pssexion->prepare($sql);
        
        // Vincular los parámetros con nombres únicos
        $result->bindParam(':usu1', $usu);
        $result->bindParam(':pss1', $pas);
        $result->bindParam(':usu2', $usu);
        $result->bindParam(':pss2', $pas);
        $result->bindParam(':usu3', $usu);
        $result->bindParam(':pss3', $pas);

        // Ejecutar la consulta
        $result->execute();
        
        // Obtener los resultados
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $res;
    }
?>
