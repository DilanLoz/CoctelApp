<?php
// cocteles.php
require_once 'models/conexion.php';
require_once 'models/mbarxprod.php';

$mbarxprod = new Mbarxprod();
$datAll = $mbarxprod->getAll();

?>

<link rel="stylesheet" href="css/carcomp.css">
<br>
<br>
<h1><i class="fa-solid fa-martini-glass"></i>  Cócteles</h1>
<hr>
<br>
<section class="shop container">
    <h2 class="section-title">
    <div class="shop-content">
         <?php if ($datAll) { 
            foreach ($datAll as $dta) {
                // Mostrar solo productos de tipo 'licor'
                if ($dta['tipoprod'] == 'coctel') { 
                    // Formatear el precio para agregar separadores de miles
                    $formattedPrice = number_format($dta['vlrprod'], 0, ',', '.'); // Sin decimales, separador de miles con punto
                    ?>
                    <div class="product-box">
                        <a href="home.php?pg=1014&idprod=<?=$dta['idprod'];?>">
                            <img src="img/<?=$dta["fotprod"];?>" alt="" class="product-img"></a>
                            <strong style="font-size: 15px; display: inline-block; min-height: 40px;"><?=$dta['nomprod'];?></strong>

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
