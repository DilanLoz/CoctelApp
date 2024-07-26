// Seleccionar iconos y elementos del carrito
let cartIcon = document.querySelector('#cart-icon');
let cart = document.querySelector(".cart");
let closeCart = document.querySelector("#close-cart");

// Mostrar el carrito cuando se hace clic en el icono del carrito
cartIcon.onclick = () => {
    cart.classList.add("active");
}

// Ocultar el carrito cuando se hace clic en el botón de cerrar
closeCart.onclick = () => {
    cart.classList.remove("active");
}

// Esperar a que el contenido del documento esté cargado antes de ejecutar las funciones
if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready);
} else {
    ready();
}

function ready() {
    // Agregar eventos a los botones de eliminar del carrito
    var removeCartButtons = document.getElementsByClassName("cart-remove");
    for (var i = 0; i < removeCartButtons.length; i++) {
        var button = removeCartButtons[i];
        button.addEventListener("click", removeCartItem);
    }
    
    // Agregar eventos a los inputs de cantidad del carrito
    var quantityInputs = document.getElementsByClassName("cart-quantity");
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i];
        input.addEventListener("change", quantityChanged);
    }

    // Agregar eventos a los botones de añadir al carrito
    var addCart = document.getElementsByClassName("add-cart");
    for (var i = 0; i < addCart.length; i++) {
        var button = addCart[i];
        button.addEventListener("click", addCartClicked);
    }

    // Agregar evento al botón de comprar ahora
    document.getElementsByClassName("btn-buy")[0].addEventListener("click", buyButtonClicked);
}

function buyButtonClicked() {
    alert("Su pedido ha sido realizado");
    var cartContent = document.getElementsByClassName("cart-content")[0];
    while (cartContent.hasChildNodes()) {
        cartContent.removeChild(cartContent.firstChild);
    }
    updateTotal();
    // Redirigir a la página index.php?pg=9090
    window.location.href = "index.php?pg=9090";
}

function updateTotal() {
    var cartContent = document.getElementsByClassName("cart-content")[0];
    var cartBoxes = cartContent.getElementsByClassName("cart-box");
    var total = 0;
    for (var i = 0; i < cartBoxes.length; i++) {
        var cartBox = cartBoxes[i];
        var priceElement = cartBox.getElementsByClassName("cart-price")[0];
        var quantityElement = cartBox.getElementsByClassName("cart-quantity")[0];
        var price = parseFloat(priceElement.innerText.replace("$", ""));
        var quantity = quantityElement.value;
        total += price * quantity;
    }
    total = Math.round(total * 100) / 100;
    document.getElementsByClassName("total-price")[0].innerText = "$" + total;
}

function removeCartItem(event) {
    var buttonClicked = event.target;
    buttonClicked.parentElement.remove();
    updateTotal();
}

function quantityChanged(event) {
    var input = event.target;
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1;
    }
    updateTotal();
}

function addCartClicked(event) {
    var button = event.target;
    // Navegar por los elementos padres para encontrar el contenedor del producto
    var productContainer = button.closest('.product-box');
    if (!productContainer) {
        console.error('No se pudo encontrar el contenedor del producto');
        return;
    }

    // Extraer la información del producto del contenedor
    var title = productContainer.querySelector('.product-title').innerText;
    var price = productContainer.querySelector('.price').innerText;
    var productImg = productContainer.querySelector('.product-img').src;

    addProductToCart(title, price, productImg);
    updateTotal();
}

function addProductToCart(title, price, productImg) {
    var cartShopBox = document.createElement("div");
    cartShopBox.classList.add("cart-box");
    var cartItems = document.getElementsByClassName("cart-content")[0];
    var cartItemsNames = cartItems.getElementsByClassName("cart-product-title");
    for (var i = 0; i < cartItemsNames.length; i++) {
        if (cartItemsNames[i].innerText == title) {
            alert("Ya has añadido este artículo al carrito");
            return;
        }
    }

    var cartBoxContent = `
        <img src="${productImg}" alt="" class="cart-img">
        <div class="detail-box">
            <div class="cart-product-title">${title}</div>
            <div class="cart-price">${price}</div>
            <input type="number" value="1" class="cart-quantity">
        </div>
        <i class='bx bxs-trash-alt cart-remove'></i>`;
    cartShopBox.innerHTML = cartBoxContent;
    cartItems.append(cartShopBox);
    cartShopBox.getElementsByClassName("cart-remove")[0].addEventListener("click", removeCartItem);
    cartShopBox.getElementsByClassName("cart-quantity")[0].addEventListener("change", quantityChanged);
    updateTotal();
}
