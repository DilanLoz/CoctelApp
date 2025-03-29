document.querySelectorAll(".increment, .decrement").forEach((button) => {
    button.addEventListener("click", function () {
        let input = this.closest(".counter").querySelector(".quantity");
        let cantidadActual = parseInt(input.value, 10);
        let idprod = this.dataset.idprod;
        let idusu = this.dataset.idusu;
        let operacion = this.classList.contains("increment") ? "sum" : "res";

        if (cantidadActual === 1 && operacion === "res") return;

        fetch("controllers/ccar_sum_rest.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ idprod, idusu, acc: operacion }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    setTimeout(() => location.reload(), 500); // 🔄 Recarga la página después de 500ms
                } else {
                    alert(data.message || "Error al actualizar cantidad.");
                }
            })
            .catch((error) => console.error("Error:", error));
    });
});

// 🔥 Manejo de eliminación de productos
document.querySelectorAll(".trash").forEach((button) => {
    button.addEventListener("click", function () {
        let idprod = this.dataset.idprod;
        let idusu = this.dataset.idusu;

        if (!confirm("¿Seguro que deseas eliminar este producto?")) return;

        fetch("controllers/ccar_sum_rest.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ idprod, idusu, acc: "eli" }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    setTimeout(() => location.reload(), 500); // 🔄 Recarga la página después de 500ms
                } else {
                    alert(data.message || "Error al eliminar producto.");
                }
            })
            .catch((error) => console.error("Error:", error));
    });
});

// 🔄 Actualizar totales (si decides no recargar la página)
function actualizarTotales() {
    fetch("controllers/cactualizar_totales.php")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("total_productos").textContent = data.total_productos;
                document.getElementById("valor_productos").textContent = `$${data.valor_productos.toFixed(2)}`;
            } else {
                console.error("Error al actualizar totales:", data.message);
            }
        })
        .catch(error => console.error("Error en actualizarTotales:", error));
}
