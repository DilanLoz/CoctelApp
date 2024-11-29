<?php
require_once(__DIR__ . '/../controllers/cprod.php');

$mprod = new Mprod();

// Obtén todos los productos
$datAll = $mprod->getAll(); // Asegúrate de que getAll() retorne datos válidos

// Variables que necesitas definir
// Simulación de datos del cóctel
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detalle del Cóctel</title>
        <!-- Vincula el CSS de Bootstrap (asegúrate de tener acceso a este archivo) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
<?php if ($datOne) {foreach ($datOne as $dta) { ?>
    <div class="container mb-5">
       
        <div class="row mt-5">
            <!-- Columna de imagen grande -->
            <div class="col-md-6 text-start">
                <h1><strong><img src="img/<?=$dta["fotprod"];?>" alt="" class="product-img"></a></strong></h1>
            </div>
           
            <!-- Columna de información del cóctel -->
            <div class="col-md-6">
                <h1><strong><?=$dta['nomprod'];?></strong></h1>
                <h2><strong>Precio: <?=$dta['vlrprod'];?></strong></h2>
                <h2><strong><?=$dta['desprod'];?></strong></h2>

               
                <!-- Selector para servicio de bartender -->
                <div class="mt-4">
                    <label for="servicioBartender" class="form-label">¿Deseas servicio de bartender?</label>
                    <select id="servicioBartender" class="form-select">
                        <option value="si">Sí</option>
                        <option value="no">No</option>
                    </select>
                    <br>
                    <h4>Seleccione "Sí" si quiere servicio de bartender a domicilio. De lo contrario, si selecciona "No", el cóctel será de un tamaño ya determinado.</h4>
                </div>

                <!-- Botones alineados al texto -->
                <div class="mt-4 d-flex justify-content-start">
                    <button class="btn btn-outline-warning btn-md me-2" id="btnAgregarCarrito">
                        Agregar al carrito
                    </button>
                    <button class="btn btn-warning btn-md" id="btnComprar">
                        Comprar
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php }} ?>

    <!-- Agregar el script de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('btnAgregarCarrito').addEventListener('click', function() {
            // Redirigir a la página de carrito
            window.location.href = 'home.php?pg=1007'; // Cambia esto por la URL de tu página de carrito
        });

        document.getElementById('btnComprar').addEventListener('click', function() {
            // Redirigir a la página de compra
            window.location.href = 'pagina_compra.php'; // Cambia esto por la URL de tu página de compra
        });
    </script>
   
    </body>
    </html>
