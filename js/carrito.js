document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('click', function(event) {
        let button = event.target.closest('.add-to-cart, .add-cart, .remove-from-cart');
        if (!button) return;

        const idprod = button.dataset.idprod;
        const idusu = button.dataset.idusu;
        const vlrprod = button.dataset.vlrprod;
        const cantidad = 1;

        if (button.classList.contains('remove-from-cart')) {
            eliminarProducto(idusu, idprod, button);
        } else {
            agregarProducto(idusu, idprod, vlrprod, cantidad, button);
        }
    });

    function agregarProducto(idusu, idprod, vlrprod, cantidad, button) {
        console.log("📤 Enviando datos:", { idprod, idusu, vlrprod, cantidad });

        fetch('controllers/ccarr.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ idprod, idusu, vlrprod, cantidad })
        })
        .then(response => response.json())
        .then(data => {
            console.log("✅ Respuesta del servidor:", data);
            
            if (data.success) {
                animarBoton(button);
                animarCarrito();
                actualizarTotal();
            } else {
                alert("❌ Error al agregar: " + data.message);
            }
        })
        .catch(error => console.error('⛔ Error en la solicitud:', error));
    }

    function eliminarProducto(idusu, idprod, button) {
        console.log("🗑 Eliminando producto:", { idprod, idusu });

        fetch('controllers/ccarr.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ idprod, idusu, acc: 'eli' })
        })
        .then(response => response.json())
        .then(data => {
            console.log("🗑 Respuesta de eliminación:", data);

            if (data.success) {
                let productElement = button.closest('.product-item');
                if (productElement) {
                    productElement.remove();
                }
                actualizarTotal();
            } else {
                alert("❌ Error al eliminar: " + data.message);
            }
        })
        .catch(error => console.error('⛔ Error al eliminar:', error));
    }

    function actualizarTotal() {
        fetch('controllers/ccarr.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const totalElement = document.querySelector('.tot-carr');
                if (totalElement) {
                    totalElement.textContent = `$${data.total_productos}`;
                }
            }
        })
        .catch(error => console.error('⛔ Error al actualizar el total:', error));
    }

    // ✅ Animación del botón al agregar al carrito
    function animarBoton(button) {
        button.classList.add('cart-animate');
        setTimeout(() => {
            button.classList.remove('cart-animate');
        }, 500);
    }

    // ✅ Animación del icono del carrito al agregar productos
    function animarCarrito() {
        const cartIcon = document.querySelector(".cart-icon");
        if (cartIcon) {
            cartIcon.classList.add("bounce");
            setTimeout(() => cartIcon.classList.remove("bounce"), 500);
        }
    }
});
