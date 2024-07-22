<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/inho.css">
    <title>CoctelApp</title>
    <link rel="icon" href="img/favicon.png">
</head>
<body>
<?php include ("models/conexion.php");
	date_default_timezone_set('America/Bogota');
	$pg= isset($_REQUEST["pg"]) ? $_REQUEST["pg"]:NULL; ?>
<nav class="navbar navbar-expand-lg">
    <a href="#" target="_blank"><img src="img/logo.png" id="logo" alt="logo" height="50px"></a>
    <div class="barra-busqueda">
        <input type="text" placeholder="Buscar..." onkeydown="if(event.keyCode==13) event.preventDefault();">
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
        <?php include("views/menui.php") ?>
    </div>
</nav>
    <section>
        <?PHP require_once("views/menui.php");
            $pg = isset($_GET["pg"]) ? $_GET["pg"]:NULL;
            if(!$pg) 
            require_once("index.php");
            if(!$pg=="1001") 
            require_once("views/carrusel.php");
            if($pg=="1007") 
            require_once("views/vlogreg.php");
            ?>
    </section>
    <footer class="bg-black">
        <?php
            require_once("views/vfooter.php");
        ?>
    </footer>
    <script src="js/carcomp.js"></script>
    <script src="js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
</body>

</html>