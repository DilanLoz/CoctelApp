<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'models/conexion.php';
require_once 'controllers/cbarxprod.php';

if (isset($_POST['offset'])) {
    $offset = intval($_POST['offset']);
    $limit = 12;

    echo "Offset recibido: " . $offset . "<br>";

    $mbarxprod = new Mbarxprod();
    $products = $mbarxprod->getAllProdIni($offset, $limit);

    if (empty($products)) {
        echo "<script>document.getElementById('load-more').style.display = 'none';</script>";
        exit;
    }

    foreach ($products as $dta) {
        $formattedPrice = number_format($dta['vlrprod'], 0, ',', '.');
        echo '<div class="product-box">
                <a href="home.php?pg=1014&idprod=' . $dta['idprod'] . '">
                    <img src="img/' . $dta["fotprod"] . '" alt="" class="product-img">
                </a>
                <strong class="product-name">' . $dta['nomprod'] . '</strong>
                <br>
                <strong class="product-price" style="font-size: 20px; color: green;">$' . $formattedPrice . '</strong>
                <br>
                <strong style="border-radius: 10px; border: 1px solid black; font-size: 16px; padding-left: 5px; padding-right: 5px;">' . $dta['nombar'] . '</strong>
                <a href="home.php?pg=1014&idprod=' . $dta['idprod'] . '">
                    <i class="bx bxs-cart add-cart"></i>
                </a>
              </div>';
    }
} else {
    echo "No se recibió offset";
}
?>
