<?php
// vinos.php
require_once 'models/conexion.php';
require_once 'controllers/cbarxprod.php';

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
                        <a href="home.php?pg=1014&idprod=<?=$dta['idprod'];?>">
                            <img src="img/<?=$dta["fotprod"];?>" alt="" class="product-img"></a>
                            <strong class="product-name"><?=$dta['nomprod'];?></strong>
                        <br>
                        <strong style="font-size: 20px; color: green;">$<?=$formattedPrice;?></strong> <!-- Color amarillo -->
                        <br>
                        <strong style="border-radius: 10px; border: 1px solid black; font-size: 16px; padding-left: 5px; padding-right: 5px;"><?=$dta['nombar'];?></strong>
                        <i class='bx bxs-cart add-cart' id="add-cart"></i>
                    </div>
        <?php 
                }
            }
        } ?>
    </div>
</section>

<script src="js/carcomp.js"></script>
