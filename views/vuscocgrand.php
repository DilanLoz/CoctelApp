<?php
require_once('controllers/cprod.php');
include_once(__DIR__ . "/../controllers/ccarr.php");

$mprod = new Mprod();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<?php if ($datOne) {
    foreach ($datOne as $dta) { ?>
        <div class="container mb-5 mt-5">
            <div class="row mt-5">
                <!-- Columna de imagen grande -->
                <div class="img-container">
                    <img src="img/<?= $dta["fotprod"]; ?>" alt="" class="product-img" id="zoom-image">
                </div>

                <!-- Columna de información del cóctel -->
                <div class="col-md-6 mt-5">
                    <h3><strong><?= $dta['nomprod']; ?></strong></h3>
                    <div class="border border-2 border-warning rounded"></div>
                    <br>
                    <h4>
                        <strong>
                            <i class="fa-solid fa-circle text-warning icono-circulo me-2"></i>
                            $<?= $dta['vlrprod']; ?> - <?= $dta['mililitros']; ?> ml
                        </strong>
                    </h4>
                    <br>
                    <!-- Selector para servicio de bartender -->
                    <div class="mt-4">
                        <h5 for="desprod" class="form-label">Descripcion:</h5>
                        <h5><?= $dta['desprod']; ?></h5>
                    </div>
                    <br>
                    <!-- Botones alineados al texto -->
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
<?php }
} ?>
<style>
    /* ✅ Establece la altura de la imagen y ajusta su tamaño */
    .img-container {
        position: relative;
        width: 100%;
        max-width: 400px;
        /* Ajusta según sea necesario */
        height: 400px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
        background-color: rgb(255, 255, 255);
        /* Fondo para evitar bordes vacíos */
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        /* ✅ Ajusta la imagen sin recortar */
        transition: transform 0.2s ease-in-out, transform-origin 0.2s ease-in-out;
        cursor: zoom-in;
    }


    /* ✅ Efecto de lupa */
    .img-container:hover .product-img {
        transform: scale(1.5);
        /* Aumenta el tamaño de la imagen */
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
</script>

<script src="js/carrito.js"></script>