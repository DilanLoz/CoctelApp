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
    <link rel="icon" href="img/coctelapp/favicon.png">
</head>
<body>

<div class="navs">
    <a href="#" target="_blank">
        <img src="img/coctelapp/logo.png" id="logo" alt="logodos" height="50px">
    </a>
    <div class="barra-busqueda">
        <input type="text" placeholder="Buscar..." onkeydown="if(event.keyCode==13) event.preventDefault();">
    </div>
    <nav class="navbar navbar-expand-md">
        <div class="collapse navbar-collapse" id="menu">
            <?php require_once("views/menui.php") ?>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
</div>
    <section>
        <?PHP require_once("views/menui.php");
            $pg = isset($_GET["pg"]) ? $_GET["pg"]:NULL;
            if(!$pg) 
            require_once("index.php");
            if(!$pg=="1001") 
            require_once("views/carrusel.php");
            if($pg=="1002") 
            require_once("views/vlogreg.php");
            else{
                echo "
                <br>
                <div style='max-width: 600px; margin: auto; padding: 40px; border: 1px solid #e0e0e0; border-radius: 10px; background-color: #f9f9f9; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);'>
                    <h1 style='color: #FF6347;'>Error 404: Página No Encontrada</h1>
                    <p style='font-size: 18px; color: #666;'>Lo sentimos, pero la página que estás buscando no está disponible o no tienes permisos para acceder.</p>
                    <p style='font-size: 16px; color: #888; line-height: 1.6;'>
                        Puedes intentar lo siguiente:
                        <br>Revisar la URL: Asegúrate de que la dirección está escrita correctamente.
                        <br>Volver al inicio: <a href='index.php' style='color: #FF6347; text-decoration: none;'>Haz clic aquí</a> para regresar a nuestra página principal.
                        <br>Contactarnos: Si necesitas ayuda, puedes escribirnos a <a href='mailto:coctelapp.info@gmail.com' style='color: #FF6347; text-decoration: none;'>coctelapp.info@gmail.com</a>.
                    </p>
                    <br><br>
                </div>";
            }
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