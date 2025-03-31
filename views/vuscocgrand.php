<?php
require_once('controllers/cprod.php');
include_once(__DIR__ . "/../controllers/ccarr.php");

$mprod = new Mprod(); // ✅ Instancia de la clase

if ($datOne) {
    foreach ($datOne as $dta) {
        $randomProducts = $mprod->getRandomProducts($dta['idprod']); // ✅ Llamada correcta
?>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="css/carcomp.css">
        <div class="container mb-5 mt-5">
            <div class="row mt-5">
                <!-- Columna de imagen grande -->
                <div class="img-container border border-dark rounded">
                    <img src="img/productos/<?= $dta["fotprod"]; ?>" alt="" class="product-img" id="zoom-image">
                </div>
                <div class="cart-notification" id="cart-notification"><i class="fa-solid fa-cart-arrow-down"></i> Producto agregado al carrito</div>

                <!-- Columna de información del cóctel -->
                <div class="col-md-6 mt-5">
                    <h3><strong><?= $dta['nomprod']; ?></strong></h3>
                    <div class="border border-2 border-warning rounded"></div>
                    <br>
                    <div>
                        <h4 class="mt-2">
                            <strong>$ <?= number_format($dta['vlrprod'], 0, ',', '.'); ?></strong>
                        </h4>

                        <p class="border border-dark rounded d-inline-block px-2 py-1">
                            <?= $dta['mililitros']; ?> ml - <small><?= htmlspecialchars($dta['nombar']); ?></small>
                        </p>
                    </div>
                    <!-- Descripción -->
                    <div class="mt-4">
                        <h6 for="desprod" class="form-label">Descripción del producto:</h6>
                        <small><?= $dta['desprod']; ?></small>
                    </div>
                    <br>
                    <!-- Botón agregar al carrito -->
                    <div class="mt-4 d-flex gap-3">
                        <button class="btn add-to-cart"
                            data-idprod="<?= $dta['idprod']; ?>"
                            data-vlrprod="<?= $dta['vlrprod']; ?>"
                            data-idusu="<?= $_SESSION['idusu'] ?>">
                            Agregar al carrito <i class="fa-solid fa-cart-plus ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <h1 style="display: flex; align-items: center; justify-content: center; gap: 10px; text-align: center;">
            <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24"
                style="fill: rgba(0, 0, 0, 1);">
                <path d="M12 1.993C6.486 1.994 2 6.48 2 11.994c0 5.513 4.486 9.999 10 10 5.514 0 10-4.486 10-10s-4.485-10-10-10.001zm0 18.001c-4.411-.001-8-3.59-8-8 0-4.411 3.589-8 8-8.001 4.411.001 8 3.59 8 8.001s-3.589 8-8 8z"></path>
                <path d="M13 8h-2v4H7.991l4.005 4.005L16 12h-3z"></path>
            </svg>
            Productos Recomendados
        </h1>
        <hr>
        <br>

        <section class="shop container">
            <div class="shop-content">
                <?php if ($randomProducts) {
                    foreach ($randomProducts as $prod) {
                        $formattedPrice = number_format($prod['vlrprod'], 0, ',', '.');
                ?>
                        <div class="product-box">
                            <a href="home.php?pg=1014&idprod=<?= $prod['idprod']; ?>">
                                <img src="img/productos/<?= $prod["fotprod"]; ?>" alt="" class="product-img2">
                            </a>
                            <strong class="product-name"><?= substr($prod['nomprod'], 0, 20) . (strlen($prod['nomprod']) > 20 ? "..." : ""); ?></strong>
                            <br>
                            <strong class="product-price" style="font-size: 18px; color: green;">$<?= $formattedPrice; ?></strong>
                            <br>
                            <!-- ✅ Evita error si "nombar" no existe -->
                            <small style="border-radius: 10px; border: 1px solid black; font-size: 14px; padding: 5px;">
                                <?= isset($prod['nombar']) ? $prod['nombar'] : 'Sin bar'; ?>
                            </small>
                            <a href="home.php?pg=1014&idprod=<?= $prod['idprod']; ?>">
                                <i class='bx bxs-cart add-cart'></i>
                            </a>
                        </div>
                <?php
                    }
                } ?>
            </div>
        </section>

<?php
    } // Fin del foreach
} // Fin del if
?>


<style>
      .cart-notification {
        display: none;
        position: fixed;
        top:77px; /* Ajustado para que no se superponga con el menú */
        left: 50%;
        transform: translateX(-50%);
        background-color: #28a745;
        color: white;
        padding: 15px 25px; /* Ajuste de padding */
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        font-size: 16px;
        z-index: 1000;
        opacity: 0;
        width: 50%;
    }

    @keyframes slideDown {
        0% {
            transform: translate(-50%, -20px);
            opacity: 0;
        }
        100% {
            transform: translate(-50%, 0);
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        0%, 80% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
    /* ✅ Ajuste del tamaño de imágenes y divs en productos recomendados */
    .shop-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .product-box {
        position: relative;
        width: 200px;
        background-color: white;
        box-shadow: 6px 6px 10px 6px rgba(0, 0, 0, 0.166);
        border-radius: 8px;
        padding: 15px;
        margin-right: 20px;
        text-align: left;
        margin-bottom: 50px;
        transition: transform 0.4s ease-in-out, box-shadow 0.4s ease-in-out, border 0.4s ease-in-out;
        padding-bottom: 40px;
        /* Espacio para el nombre del bar */
    }

    .product-box small {
        position: absolute;
        bottom: 10px;
        left: 10px;
        /* Alineado a la izquierda */
        width: auto;
        /* Se ajusta al contenido */
        max-width: 80%;
        /* Limita el ancho máximo */
        text-align: left;
        border-radius: 10px;
        border: 1px solid black;
        font-size: 14px;
        padding: 5px 10px;
        /* Ajusta el espaciado */
        background: white;
        /* Para que no se mezcle con el fondo */
        white-space: nowrap;
        /* Evita que el texto se divida en varias líneas */
    }

    .product-box:hover {
        transform: scale(1.05);
    }

    .product-img {
        max-width: 380px;
        height: 300px;
        object-fit: cover;
        border-radius: 8px;
    }

    .product-name {
        font-size: 16px;
        font-weight: bold;
        margin-top: 5px;
        display: block;
    }

    .product-price {
        font-size: 18px;
        color: green;
        font-weight: bold;
    }

    .product-img {
        width: 350px;
        height: 350px;
        object-fit: contain;
    }

    .product-img2 {
        width: 350px;
        height: 350px;
    }

    .product-img2 {
        max-width: 180px;
        /* ✅ Se ajusta para que todas las imágenes sean más pequeñas */
        height: 200px;
        object-fit: cover;
        /* ✅ Evita que se deforme la imagen */
        border-radius: 8px;
    }


    /* ✅ Efecto de lupa */
    .img-container {
        position: relative;
        width: 100%;
        max-width: 400px;
        height: 450px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
        background-color: rgb(255, 255, 255);
    }

    .img-container:hover .product-img {
        transform: scale(1.5);
        cursor: zoom-in;
    }

    .icono-circulo {
        font-size: 15px;
        /* Ajusta el tamaño del icono */
        line-height: 1;
        /* Asegura que el icono esté alineado */
        vertical-align: middle;
        /* Centra el icono con el texto */
    }


    /* ✅ Alineación del texto a la izquierda */
    .col-md-6 {
        text-align: left;
    }

    /* Estilo del botón */
    .add-to-cart {
        background-color: #ffc107;
        /* Gris claro */
        color: #333;
        border: 1px solid #ddd;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s ease-in-out, background-color 0.3s ease-in-out;
    }

    .add-to-cart:hover {
        background-color: #e0e0e0;
        /* Un poco más oscuro al pasar el mouse */
        box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.3);
    }

    /* ✅ Animación al hacer clic */
    .add-to-cart.cart-animate {
        transform: scale(1.1);
        background-color: green !important;
        /* Verde para indicar éxito */
        color: white !important;
    }


    /* Animación de salto para el icono del carrito */
    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .cart-icon {
        transition: transform 0.3s ease-in-out;
    }

    .cart-icon.bounce {
        animation: bounce 0.5s ease-in-out;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                let btn = this; // Referencia al botón clickeado

                // ✅ Agregar clase de animación
                btn.classList.add('cart-animate');

                // ✅ Remover la clase después de 500ms
                setTimeout(() => {
                    btn.classList.remove('cart-animate');
                }, 500);
            });
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        const imgContainer = document.querySelector(".img-container");
        const img = document.querySelector("#zoom-image");

        imgContainer.addEventListener("mousemove", function(e) {
            let rect = imgContainer.getBoundingClientRect();
            let x = ((e.clientX - rect.left) / rect.width) * 100;
            let y = ((e.clientY - rect.top) / rect.height) * 100;

            img.style.transformOrigin = `${x}% ${y}%`;
            img.style.transform = "scale(2)"; // Ajusta el nivel de zoom aquí
        });

        imgContainer.addEventListener("mouseleave", function() {
            img.style.transform = "scale(1)";
        });
    });
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                let btn = this;
                btn.classList.add('cart-animate');
                setTimeout(() => {
                    btn.classList.remove('cart-animate');
                }, 500);
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const imgContainer = document.querySelector(".img-container");
        const img = document.querySelector("#zoom-image");

        imgContainer.addEventListener("mousemove", function(e) {
            let rect = imgContainer.getBoundingClientRect();
            let x = ((e.clientX - rect.left) / rect.width) * 100;
            let y = ((e.clientY - rect.top) / rect.height) * 100;

            img.style.transformOrigin = `${x}% ${y}%`;
            img.style.transform = "scale(2)";
        });

        imgContainer.addEventListener("mouseleave", function() {
            img.style.transform = "scale(1)";
        });
    });
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                let notification = document.getElementById('cart-notification');
                
                // Mostrar y animar la notificación
                notification.style.display = 'block';
                notification.style.animation = 'none';
                void notification.offsetWidth; // Reiniciar animación
                notification.style.animation = 'slideDown 0.5s ease-in-out forwards, fadeOut 3s ease-in-out forwards';

                // Ocultar después de 3 segundos
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 5000);
            });
        });
    });
</script>

<script src="js/carrito.js"></script>