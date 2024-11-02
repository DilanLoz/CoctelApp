<?php require_once('models/seg.php')?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/inho.css">
    <link rel="icon" href="img/favicon.png">
    <title>CoctelApp</title>
</head>

<body>
    <?php include ("models/conexion.php");
	date_default_timezone_set('America/Bogota');
	$pg= isset($_REQUEST["pg"]) ? $_REQUEST["pg"]:NULL;
    if(!$pg AND $_SESSION['pagini']) $pg=$_SESSION['pagini'];
    ?>
    <div class="navs">
    <a href="#" target="_blank">
        <img src="img/logo.png" id="logo" alt="logodos" height="50px">
    </a>
    <div class="barra-busqueda">
        <input type="text" placeholder="Buscar..." onkeydown="if(event.keyCode==13) event.preventDefault();">
    </div>
    <nav class="navbar navbar-expand-md">
        <div class="collapse navbar-collapse" id="menu">
            <?php require_once("views/menuh.php"); ?>
        </div>
    </nav>
</div>

    
    
    <section style="text-align: center; padding: 50px; color: #333; font-family: Arial, sans-serif;">
    <?php
        $rut = validar($pg);
        if($rut) {
            include ($rut[0]['rutpag']);
        } else {
            echo "
            <div style='max-width: 600px; margin: auto; padding: 40px; border: 1px solid #e0e0e0; border-radius: 10px; background-color: #f9f9f9; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);'>
                <h1 style='color: #FF6347;'>Error 404: Página No Encontrada</h1>
                <p style='font-size: 18px; color: #666;'>Lo sentimos, pero la página que estás buscando no está disponible o no tienes permisos para acceder.</p>
                <p style='font-size: 16px; color: #888; line-height: 1.6;'>
                    Puedes intentar lo siguiente:
                    <br>Revisar la URL: Asegúrate de que la dirección está escrita correctamente.
                    <br>Volver al inicio: <a href='home.php' style='color: #FF6347; text-decoration: none;'>Haz clic aquí</a> para regresar a nuestra página principal.
                    <br>Contactarnos: Si necesitas ayuda, puedes escribirnos a <a href='mailto:coctelapp.info@gmail.com' style='color: #FF6347; text-decoration: none;'>coctelapp.info@gmail.com</a>.
                </p>
            </div>";
        }
    ?>
</section>

    

    <footer class="bg-black">
        <?php require_once("views/vfooter.php"); ?>
    </footer>
    
    <script src="js/carcomp.js"></script>
    <script src="js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
</body>
</html>
