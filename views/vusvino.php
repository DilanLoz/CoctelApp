<?php
// vinos.php
require_once 'models/conexion.php';
require_once 'models/mbarxprod.php';

$mbarxprod = new Mbarxprod();
$datAll = $mbarxprod->getAll();

?>

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="css/carcomp.css">
<br>
<br>
<h1><i class="fa-solid fa-wine-bottle"></i>  Vinos</h1>
<hr>
<br>
<section class="shop container">
    <h2 class="section-title">
    <div class="shop-content">
        <?php if ($datAll) { 
            foreach ($datAll as $dta) {
                // Mostrar solo productos de tipo 'licor'
                if ($dta['tipoprod'] == 'vino') { 
                    // Formatear el precio para agregar separadores de miles
                    $formattedPrice = number_format($dta['vlrprod'], 0, ',', '.'); // Sin decimales, separador de miles con punto
                    ?>
                    <div class="product-box">
                        <a href="index.php?pg=02">
                            <img src="img/<?=$dta["fotprod"];?>" alt="" class="product-img"></a>
                        <strong style="font-size: 30px"><?=$dta['nomprod'];?></strong>
                        <br>
                        <strong style="font-size: 20px; color: green;">$<?=$formattedPrice;?></strong> <!-- Color amarillo -->
                        <br>
                        <strong style="font-size: 20px"><?=$dta['nombar'];?></strong>
                        <i class='bx bxs-cart add-cart' id="add-cart"></i>
                    </div>
        <?php 
                }
            }
        } ?>
    </div>
</section>

<script src="js/carcomp.js"></script>
