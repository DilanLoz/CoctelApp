<?php require_once('models/seg.php') ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/af-2.7.0/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.4/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-2.1.0/sr-1.4.1/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- Highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="admin/graficos/graficos.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" href="img/coctelapp/favicon.png">
    <style>
        body {
            background-color: rgb(255, 255, 255) !important;
            /* Un gris claro */
        }
    </style>
    <title>CoctelApp</title>
</head>

<body>
    <?php include("models/conexion.php");
    date_default_timezone_set('America/Bogota');
    $pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"] : NULL;
    if (!$pg && $_SESSION['pagini']) $pg = $_SESSION['pagini'];
    ?>

    <!-- Navbar -->
    <nav id="barra-navegacion">
        <?php require_once("views/menuh.php"); ?>
    </nav>

    <!-- Contenido principal -->
    <section style="text-align: center; padding: 50px; color: #333; font-family: Arial, sans-serif;">
        <?php
        $rut = validar($pg);
        if ($rut) {
            include($rut[0]['rutpag']);
        } else {
            echo "
            <br><br><br>
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

    <!-- Footer -->
    <footer class="bg-black">
        <?php require_once("views/vfooter.php"); ?>
    </footer>


    <!-- Scripts -->
    <script src="js/carcomp.js"></script>
    <script src="js/index.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/datatable.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/af-2.7.0/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.4/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-2.1.0/sr-1.4.1/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json"
                }
            });
        });
    </script>
    <script src="admin/graficos/graficos.js"></script>
</body>

</html>