<?php
// cocteles.php
require_once 'models/conexion.php';
require_once 'models/mbarxprod.php';

$mbarxprod = new Mbarxprod();
$datAll = $mbarxprod->getAll();

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="css/carcomp.css">
<br>
<br>
<h1><i class="fa-solid fa-martini-glass"></i>  Cocteles</h1>
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
                        <a href="home.php?pg=3050">
                            <img src="img/<?=$dta["fotprod"];?>" alt="" class="product-img"></a>
                        <strong style="font-size: 30px"><?=$dta['nomprod'];?></strong>
                        <br>
                        <strong style="font-size: 20px; color: green;">$<?=$formattedPrice;?></strong> <!-- Color amarillo -->
                        <br>
                        <strong style="font-size: 20px"><?=$dta['nombar'];?></strong>
                        <i class='bx bxs-cart add-cart'></i>
                    </div>
        <?php 
                }
            }
        } ?>
    </div>
</section>

<script src="js/carcomp.js"></script>
