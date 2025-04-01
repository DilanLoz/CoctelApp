<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
require_once ('models/conexion.php');
require_once ('controllers/cpbar.php');

$mpbar = new Mpbar();
$datAllBar = $mpbar->getAllBar(); // Obtener todos los bares
?>
<div class="container mt-5 mb-5">
    <h1 class="text-center"> Bares Asociados</h1>
    <hr>
    <br>

    <div class="row" id="barContainer">
        <?php 
        $barCount = 0; // Contador de bares
        if (isset($datAllBar) && !empty($datAllBar)) { 
            foreach ($datAllBar as $dtu) { 
                $barCount++; // Incrementar el contador
                $visibility = ($barCount <= 8) ? 'block' : 'none'; // Mostrar los primeros 8 bares
        ?>
            <div class="col-md-3 mt-4 bar-item" style="display: <?= $visibility; ?>;">
                <div class="imguno shadow-lg rounded-3 border border-dark border-2">
                    <?php if (!empty($dtu["fotbar"]) && file_exists("img/bares/" . $dtu["fotbar"])) { ?>
                        <img src="img/bares/<?php echo $dtu["fotbar"]; ?>" class="img-fluid rounded" alt="Imagen del bar" style="width: 500px; height: 210px;">
                    <?php } else { ?>
                        <img src="img/coctelapp/bar1.jpg" class="img-fluid rounded" alt="Imagen del bar" style="width: 500px; height: 210px;">
                    <?php } ?>
                </div>
                <div class="text-center mt-2">
                    <small>
                        <strong class="fs-5"><?php echo $dtu['nombar']; ?></strong><br>
                        <strong>Ubicación: </strong><?php echo $dtu['nomubi']; ?><br>
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

    <!-- Botón para cargar más bares -->
    <div class="text-center mt-4">
        <button id="loadMoreBars" class="btn-load-more">
            Ver más
        </button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let offset = 8; // Mostrar 8 bares al inicio
        const bars = document.querySelectorAll(".bar-item");
        const loadMoreButton = document.getElementById("loadMoreBars");

        loadMoreButton.addEventListener("click", function() {
            let count = 0;
            for (let i = offset; i < bars.length && count < 4; i++, count++) {
                bars[i].style.display = "block"; // Mostrar bares ocultos
            }
            offset += 4;

            // Ocultar el botón si no hay más bares para mostrar
            if (offset >= bars.length) {
                loadMoreButton.style.display = "none";
            }
        });
    });
</script>

<style>
    .btn-load-more {
        background-color: #ffc107;
        color: #000;
        border: none;
        padding: 12px 30px;
        font-size: 18px;
        font-weight: bold;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 10px rgba(255, 193, 7, 0.4);
        outline: none;
    }

    .btn-load-more:hover {
        background-color: #ffdd75;
        color: #000000;
        box-shadow: 0 6px 15px rgba(255, 221, 117, 0.6);
    }

    .btn-load-more:active {
        transform: scale(0.95);
        box-shadow: 0 2px 5px rgba(255, 193, 7, 0.5);
    }
</style>
