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
        console.log("Datos enviados:", { idprod, idusu, vlrprod, cantidad });

        fetch('controllers/ccarr.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ idprod, idusu, vlrprod, cantidad })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Respuesta del servidor:", data);
            
            if (data.success) {
                if (button.classList.contains('add-to-cart')) {
                    button.classList.add('btn-success', 'cart-animate');
                    button.classList.remove('btn-outline-warning');
                } else if (button.classList.contains('add-cart')) {
                    button.style.backgroundColor = '#28a745';
                    button.style.color = '#fff';
                    button.classList.add('cart-animate');
                }

                setTimeout(() => {
                    if (button.classList.contains('add-to-cart')) {
                        button.classList.remove('btn-success', 'cart-animate');
                        button.classList.add('btn-outline-warning');
                    } else if (button.classList.contains('add-cart')) {
                        button.style.backgroundColor = '';
                        button.style.color = '';
                        button.classList.remove('cart-animate');
                    }
                }, 3000);
            } else {
                alert("❌ Error al agregar: " + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function eliminarProducto(idusu, idprod, button) {
        fetch('controllers/ccarr.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ idprod, idusu, acc: 'eli' })
        })
        .then(response => response.json())
        .then(data => {
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
        .catch(error => console.error('Error:', error));
    }

    function actualizarTotal() {
        fetch('controllers/ccarr.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector('.tot-carr').textContent = `$${data.total_productos}`;
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
