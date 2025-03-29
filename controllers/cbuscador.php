<?php
include dirname(__DIR__) . "/models/conexion.php";
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'Strict'); 
session_start();
$isLoggedIn = isset($_SESSION['idusu']);

if (isset($_GET['query'])) {
    $searchQuery = trim($_GET['query']); // Eliminar espacios en blanco

    try {
        $model = new Conexion();
        $conexion = $model->get_Conexion();
        
        // Consulta SQL para buscar productos
        $sql = "SELECT 
            p.idprod, p.nomprod, p.vlrprod, p.fotprod, p.idbar, b.nombar 
        FROM producto AS p 
        INNER JOIN bar AS b ON p.idbar = b.idbar 
        WHERE p.estado = '1' 
        AND (p.nomprod LIKE :query) 
        LIMIT 5;";

        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(':query', '%' . $searchQuery . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            foreach ($results as $product) {
                $imgPath = !empty($product['fotprod']) ? 'img/productos/' . htmlspecialchars($product['fotprod']) : 'img/default.png';

                // Limitar el nombre del producto a 30 caracteres con "..."
                $nomprod = htmlspecialchars($product['nomprod']);
                $nomprod = (strlen($nomprod) > 40) ? substr($nomprod, 0, 40) . "..." : $nomprod;
            
                echo "<a href='home.php?pg=1014&idprod=" . $product['idprod'] . "' class='product'>";
                echo "<img src='" . $imgPath . "' alt='Imagen del producto' class='product-img'>";
                echo "<div class='product-info'>";
                echo "<h3>" . $nomprod . "</h3>";
                echo "<div class='bar-info'>" . htmlspecialchars($product['nombar']) . "</div>";
                echo "<p class='product-price'>$" . number_format($product['vlrprod'], 0, ",", ".") . "</p>";
                echo "</div></a>";
            }                
        } else {
            echo "<p id='res-nf'> No se encontraron productos.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error en la búsqueda.</p>";
    }
}
?>
<style>
    /* Contenedor de resultados */
    #search-results {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%); /* Centra en móviles */
        z-index: 1000;
        background: white;
        width: 100%;
        max-width: 470px;
        border: 1px solid #ccc;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        display: none;
        padding-top: 5px;
        font-size: 14px;
        border-radius: 8px;
    }

    /* Estilos de cada producto */
    #search-results .product {
        display: flex;
        align-items: center;
        padding: 8px;
        border-bottom: 1px solid #eee;
        text-decoration: none;
        color: black;
    }

    #search-results .product:last-child {
        border-bottom: none;
    }

    /* Imagen del producto */
    #search-results .product .product-img {
        width: 70px; /* Imagen más grande */
        height: 70px;
        border-radius: 8px;
        margin-right: 12px;
        object-fit: cover;
    }

    /* Información del producto */
    #search-results .product .product-info {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    /* Nombre del producto */
    #search-results .product h3 {
        font-size: 14px;
        margin: 0;
        color: #000;
    }

    /* Nombre del bar dentro de un div con bordes redondeados */
    #search-results .product .bar-info {
        background-color: #f2f2f2;
        border-radius: 10px;
        padding: 2px 8px;
        font-size: 12px;
        display: inline-block;
        color: #333;
        width: 40% !important;
    }

    /* Precio del producto en color verde */
    #search-results .product .product-price {
        color: green;
        font-weight: bold;
    }

    /* Estilos responsivos para móviles */
    @media (max-width: 600px) {
        #search-results {
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 100%;
        }
    }
</style>
