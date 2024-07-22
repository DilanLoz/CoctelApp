
<link rel="stylesheet" href="css/carcomp.css">
<link rel="stylesheet" href="css/inho.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<nav class="collapse navbar-collapse" id="menu">
    <ul class="navbar-nav ml-auto" >
        <li class="nav-item"><a class="nav-link" href="index.php?pg=1007"><i class="fa-regular fa-user" style="color: #ffc107;"></i></a></li>
    </ul>
</nav>


<div class="cart">
    <h2 class="cart-title">Tu Carrito</h2>
    <div class="cart-content">
        <!-- Contenido del carrito se añadirá dinámicamente aquí -->
    </div>
    <div class="total">
        <div class="total-title">Total</div>
        <div class="total-price">$0</div>
    </div>
    <button type="button" class="btn-buy">Comprar Ahora</button>
    <i class='bx bx-x' id="close-cart"></i>
</div>

<script src="js/carcomp.js"></script>
<script>
    document.getElementById("open-cart").addEventListener("click", function() {
        document.querySelector(".cart").classList.add("active");
    });
    document.getElementById("close-cart").addEventListener("click", function() {
        document.querySelector(".cart").classList.remove("active");
    });
</script>
