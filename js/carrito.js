// FUNCION PARA AGREGAR AL CARRITO
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', () => {
            const idprod  = button.dataset.idprod ;
            const idusu = button.dataset.idusu;
            const vlrprod = button.dataset.vlrprod;

            // Obtener la cantidad actual del input asociado
            const inputCantidad = document.getElementById("cantidad");
            const cantidad = inputCantidad ? inputCantidad.value : 1;

            fetch('controller/ccarr.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    idprod ,
                    idusu,
                    vlrprod,
                    cantidad
                })
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Notifica al usuario
                    console.log(data); // Verifica la respuesta
                })
                .catch(error => console.error('Error:', error));
        });
    });
});

// FUNCION PARA ELIMINAR DEL CARRITO

document.querySelectorAll('.btn-eli-pcar').forEach(boton => {
    boton.addEventListener('click', function (event) {
        event.preventDefault();

        const idProducto = this.getAttribute('data-idprod ');

        fetch('controller/ccarr.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ idprod : idProducto, acc: "eli" })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });
});
