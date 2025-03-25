<?php
require_once 'models/conexion.php';
require_once 'controllers/cbarxprod.php';

$mbarxprod = new Mbarxprod();
$datAll = $mbarxprod->getAllProd();
?>

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="css/carcomp.css">
<br>
<br>
<h1><i class="fa-solid fa-martini-glass"></i> Cocteles</h1>
<hr>
<br>

<section class="shop container">
    <div class="shop-content">
        <?php if ($datAll) {
            foreach ($datAll as $dta) {
                if ($dta['tipoprod'] == 'coctel') {
                    $formattedPrice = number_format($dta['vlrprod'], 0, ',', '.');
        ?>
                    <div class="product-box">
                        <a href="home.php?pg=1014&idprod=<?= $dta['idprod']; ?>">
                            <img src="img/productos/<?= $dta["fotprod"]; ?>" alt="" class="product-img">
                        </a>
                        <strong class="product-name"><?= $dta['nomprod']; ?></strong>
                        <br>
                        <strong class="product-price" style="font-size: 22px; color: green;">$<?= $formattedPrice; ?></strong>
                        <br>
                        <small style="border-radius: 10px; border: 1px solid black; font-size: 14px; padding-left: 5px; padding-right: 5px;">
                            <?= $dta['nombar']; ?>
                        </small>
                        <a href="home.php?pg=1014&idprod=<?= $dta['idprod']; ?>">
                            <i class='bx bxs-cart add-cart'></i>
                        </a>
                    </div>
        <?php
                }
            }
        } ?>
    </div>
</section>
