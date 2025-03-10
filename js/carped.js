document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnConfirmarPedido").addEventListener("click", function () {
        let idCarrito = this.dataset.idcarrito;
        let cantidad = document.getElementById("cantidad").value;
        let total = document.getElementById("total").value;
        let idUsuario = this.dataset.idusuario;
        let direccion = document.getElementById("direccion").value;
        let mensaje = document.getElementById("mensaje").value;
        let telefono = document.getElementById("telefono").value;
        let metodoPago = document.getElementById("metodo_pago").value;

        let formData = new URLSearchParams();
        formData.append("idcarrito", idCarrito);
        formData.append("cantidad", cantidad);
        formData.append("total", total);
        formData.append("idusu", idUsuario);
        formData.append("direccion", direccion);
        formData.append("telefono", telefono);
        formData.append("mensaje", mensaje);
        formData.append("metodo_pago", metodoPago);

        fetch("controllers/ccarped.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Pedido confirmado con éxito. ID: " + data.idpedido);
                location.reload();
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch(error => console.error("Error en la solicitud:", error));
    });
});
