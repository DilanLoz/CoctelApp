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
    
        <a href="#" target="_blank"><img src="img/logo.png" id="logo" alt="logodos" height="50px"></a>
        <div class="barra-busqueda">
            <input type="text" placeholder="Buscar..." onkeydown="if(event.keyCode==13) event.preventDefault();">
        </div>
        <button class="navbar-toggler navbar-toggler-custom" type="button" data-bs-toggle="collapse"
            data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <nav class="navbar navbar-expand-lg">
        <div class="collapse navbar-collapse" id="menu">
            <?PHP require_once("views/menuh.php") ?>
        </div>
    </nav>hola
    <section>
        <?PHP require_once("views/menuh.php");
            $pg = isset($_GET["pg"]) ? $_GET["pg"]:NULL;
            if(!$pg) 
            require_once("home.php");
            if($pg=="102") 
            require_once("views/vusbares.php");
            if($pg=="104") 
            require_once("views/vuscoct.php");
            if($pg=="105") 
            require_once("views/vusvino.php");
            if($pg=="106") 
            require_once("views/vuslicor.php");
            if($pg=="107") 
            require_once("views/vushipe.php");
            if($pg=="108") 
            require_once("views/vpusu.php");
            if($pg=="11") 
            require_once("views/vusprodgrand.php");
            if($pg=="111") 
            require_once("views/vuscocgrand.php");
            if($pg=="109") 
            require_once("index.php");
            if($pg=="201") 
            require_once("views/vexbpedproc.php");
            if($pg=="202") 
            require_once("views/vemhipe.php");
            if($pg=="203") 
            require_once("views/vemgan.php");
            if($pg=="204") 
            require_once("views/vpemp.php");
            if($pg=="2001") 
            require_once("views/vexbpedgrand.php");
            if($pg=="205") 
            require_once("index.php");
            if($pg=="301") 
            require_once("views/vbargan.php");
            if($pg=="302") 
            require_once("views/vbarxprod.php");
            if($pg=="303") 
            require_once("views/vbarxem.php");
            if($pg=="304") 
            require_once("views/vpbar.php");
            if($pg=="305") 
            require_once("index.php");
    ?>

    </section>
    <footer class="bg-black">
        <?php
            require_once("views/vfooter.php");
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