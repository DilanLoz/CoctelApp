<?php include "controllers/cmenu.php"; ?>
<link rel="stylesheet" href="../css/carcomp.css">
<link rel="stylesheet" href="../css/inho.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<nav class="collapse navbar-collapse" id="menu">
<?php if (!empty($dtAll)) { 
            foreach ($dtAll as $dt) { ?>
    <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="<?= htmlspecialchars($dt['rutpag']); ?>"><?= htmlspecialchars($dt['nompag']); ?></a></li>
        
    </ul>
    <?php }}?>
    <ul class="navbar-nav ml-auto" id="menuu">
        <li class="nav-item"><a class="nav-link" href="home.php?pg=108"><i class="fa-regular fa-user" style="color: #F0C403;"></i></a></li>
        <li class="nav-item"><a class="nav-link" id="open-cart" style="cursor: pointer;"><i class="fa-solid fa-cart-shopping" style="color: #F0C403;"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="home.php?pg=107"><i class="fa-solid fa-clipboard-list" style="color: #F0C403;"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="index.php"><i class="fa-solid fa-right-from-bracket" style="color: #F0C403;"></i></a></li>
    </ul>
    
</nav>

<!-- Menú para empleados -->
<nav class="collapse navbar-collapse" id="menue">
    <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="home.php?pg=201">Pedidos</a></li>
        <li class="nav-item"><a class="nav-link" href="home.php?pg=202">Historial de pedido</a></li>
        <li class="nav-item"><a class="nav-link" href="home.php?pg=203">Ver ganancias</a></li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="home.php?pg=204"><i class="fa-regular fa-user" style="color: #F0C403;"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="index.php"><i class="fa-solid fa-right-from-bracket" style="color: #F0C403;"></i></a></li>
    </ul>
</nav>

<!-- Menú para administradores -->
<nav class="collapse navbar-collapse" id="menub">
    <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="home.php?pg=201">Pedidos</a></li>
        <li class="nav-item"><a class="nav-link" href="home.php?pg=301">Ver Ganancias</a></li>
        <li class="nav-item"><a class="nav-link" href="home.php?pg=302">Crear Producto</a></li>
        <li class="nav-item"><a class="nav-link" href="home.php?pg=303">Crear Empleado</a></li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="home.php?pg=304"><i class="fa-regular fa-user" style="color: #F0C403;"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="index.php"><i class="fa-solid fa-right-from-bracket" style="color: #F0C403;"></i></a></li>
    </ul>
</nav>

<!-- Carrito de compras -->
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

<script src="../js/carcomp.js"></script>
<script>
    document.getElementById("open-cart").addEventListener("click", function() {
        document.querySelector(".cart").classList.add("active");
    });
    document.getElementById("close-cart").addEventListener("click", function() {
        document.querySelector(".cart").classList.remove("active");
    });
</script>