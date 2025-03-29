document.addEventListener("DOMContentLoaded", function () { 
    let confirmarPedido = document.getElementById("confirmarPedido");

    if (confirmarPedido) {
        confirmarPedido.addEventListener("click", function () {
            let formData = new FormData(document.getElementById("finalizarPedidoForm"));
            formData.append("accion", "guardarCarrito");

            // 🔹 PRIMERA PETICIÓN: Guardar el carrito
            fetch("controllers/ccarped.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json()) 
            .then(json => {
                console.log("✅ Respuesta JSON de guardarCarrito:", json);
                if (json.success) {
                    convertirCarrito(json.idcarrito);
                } else {
                    mostrarModalError(json.error || "Error al confirmar el pedido.");
                }
            })
            .catch(error => {
                console.error("❌ Error en la solicitud de guardarCarrito:", error);
                // 🔹 No se muestra error al usuario, solo en la consola
            });
        });
    } else {
        console.error("❌ El botón 'confirmarPedido' no existe en el DOM.");
    }
});

// 🔹 SEGUNDA PETICIÓN: Convertir carrito a pedido
function convertirCarrito(idCarrito) {
    let formData = new FormData();
    formData.append("accion", "convertirCarrito");
    formData.append("idcarrito", idCarrito);

    fetch("controllers/ccarped.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(json => {
        console.log("✅ Respuesta de convertirCarrito:", json);
        if (json.success) {
            let finalizarModal = bootstrap.Modal.getInstance(document.getElementById("finalizarModal"));
            finalizarModal.hide();

            let pedidoConfirmadoModal = new bootstrap.Modal(document.getElementById("pedidoConfirmadoModal"));
            pedidoConfirmadoModal.show();

            setTimeout(() => {
                window.location.href = "home.php?pg=1008"; 
            }, 3000);
        } else {
            mostrarModalError(json.error || "Error al convertir el carrito.");
        }
    })
    .catch(error => {
        console.error("❌ Error en la solicitud de conversión:", error);
        // 🔹 No se muestra error al usuario, solo en la consola
    });
}


// 🔹 FUNCIÓN PARA MOSTRAR ERRORES EN UNA MODAL
function mostrarModalError(mensaje) {
    let modalHtml = `
        <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center p-4">
                    <div class="modal-body">
                        <h5 class="text-danger">${mensaje}</h5>
                        <button type="button" class="btn btn-danger mt-3" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>`;

    document.body.insertAdjacentHTML("beforeend", modalHtml);
    let errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
    errorModal.show();
}
