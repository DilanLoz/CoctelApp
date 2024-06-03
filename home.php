<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/style.css">
    <title>CoctelApp</title>

</head>
<body>
<div class="collapse navbar-collapse" id="menu">
        <?php require_once("vista/menui.php") ?>
    </div>
    <nav class="navbar navbar-expand-lg">
        <a href="#" target="_blank"><img src="img/logo.png" id="logo" alt="logodos" height="50px"></a>
        <div class="barra-busqueda">
            <input type="text" placeholder="Buscar..." onkeydown="if(event.keyCode==13) event.preventDefault();">
        </div>
        <button class="navbar-toggler navbar-toggler-custom" type="button" data-bs-toggle="collapse"
            data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <?PHP require_once("vista/menuh.php") ?>
        </div>
    </nav>

    <section>
        <?PHP require_once("vista/menuh.php");
            $pg = isset($_GET["pg"]) ? $_GET["pg"]:NULL;
            if(!$pg) 
            require_once("home.php");
            if($pg=="101") 
            require_once("vista/vusini.php");
            if($pg=="102") 
            require_once("vista/vuscoct.php");
            if($pg=="103") 
            require_once("vista/vusvino.php");
            if($pg=="104") 
            require_once("vista/vuslicor.php");
            if($pg=="105") 
            require_once("vista/vusbares.php");
            if($pg=="106") 
            require_once("vista/vuscarcomp.php");
            if($pg=="107") 
            require_once("vista/vushipe.php");
            if($pg=="108") 
            require_once("vista/vpusu.php");
            if($pg=="11") 
            require_once("vista/vusprodgrand.php");
            if($pg=="111") 
            require_once("vista/vuscocgrand.php");
            if($pg=="109") 
            require_once("index.php");
            if($pg=="201") 
            require_once("vista/vempedproc.php");
            if($pg=="202") 
            require_once("vista/vemhipe.php");
            if($pg=="203") 
            require_once("vista/vemgan.php");
            if($pg=="204") 
            require_once("vista/vpemp.php");
            if($pg=="2001") 
            require_once("vista/vempedgrand.php");
            if($pg=="205") 
            require_once("index.php");
            if($pg=="301") 
            require_once("vista/vbargan.php");
            if($pg=="302") 
            require_once("vista/vbarxprod.php");
            if($pg=="303") 
            require_once("vista/vbarxem.php");
            if($pg=="304") 
            require_once("vista/vpbar.php");
            if($pg=="305") 
            require_once("index.php");
    ?>

    </section>
    <footer class="bg-black">
        <?php
            require_once("vista/vfooter.php");
        ?>
    </footer>
    <script src="js.carcomp.js"></script>
    <script src="js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
</body>
<!---->
</html>