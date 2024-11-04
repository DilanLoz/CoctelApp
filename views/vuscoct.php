<link rel="stylesheet" href="css/carcomp.css">
<?php
require_once 'models/conexion.php';
require_once 'models/mbarxprod.php';

$mbarxprod = new Mbarxprod();

$datAll = $mbarxprod->getAll();
$imageCounter = 0;
?>
<section class="shop container" style="text-align: left; display: block;">
    <h2 class="section-title"><i class="fa-solid fa-martini-glass-citrus"></i> Cocteles</h2>
    <div class="shop-content">
        <?php if ($datAll) { 
            foreach ($datAll as $dta) { ?>
                <div class="product-box">
                    <a href="index.php?pg=02">
                        <img src="img/<?=$dta["fotprod"];?>" alt="" class="product-img"></a>
                    <strong>Precio: </strong><?=$dta['vlrprod'];?>
                    <br>
                    <strong>Bar: </strong><?=$dta['idbar'];?>
                    <i class='bx bxs-cart add-cart'></i>
                </div>
        <?php 
            $imageCounter++;
            }
        } ?>
    </div>
</section>

<script src="js/carcomp.js"></script>