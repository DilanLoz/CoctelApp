<?php
require_once ('models/conexion.php');
require_once ('controllers/cpbar.php');
$mpbar = new Mpbar();
$datAllBar = $mpbar->getAllBar(); // Cargar los primeros 12 productos
?>

<div class="container mt-5 mb-5">
<h1 class="text-center"> Bares Asociados</h1>
<hr>
<br>
    <div class="row">
        <?php 
        // Verificar si tienes datos en $datAll y si no está vacío
        if (isset($datAllBar) && !empty($datAllBar)) { 
            foreach ($datAllBar as $dtu) { 
        ?>
            <div class="col-md-3 mt-4"> <!-- Columna de Bootstrap para 4 bares por fila -->
                <div class="imguno rounded">
                    <!-- Aquí verificamos si hay imagen para el bar -->
                    <?php if (!empty($dtu["fotprod"]) && file_exists("img/" . $dtu["fotprod"])) { ?>
                        <img src="img/<?php echo $dtu["fotprod"]; ?>" class="img-fluid rounded" alt="Imagen del bar">
                    <?php } else { ?>
                        <img src="img/coctelapp/bar1.jpg" class="img-fluid rounded" alt="Imagen del bar">
                    <?php } ?>
                </div>
                <div class="text-center mt-2">
                    <small>
                        <strong class="fs-5"><?php echo $dtu['nombar']; ?></strong><br>
                        <strong>Dirección: </strong><?php echo $dtu['dircbar']; ?><br>
                        <strong>Horario: </strong><?php echo $dtu['horbar']; ?><br>
                    </small>
                </div>
            </div>
        <?php 
            }
        }
        ?>
    </div>
</div>

