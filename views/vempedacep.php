<style>
        .progress {
            height: 30px; /* Aumenta la altura de la barra */
            border-radius: 5px;
            overflow: hidden; /* Evita que el fondo blanco se vea */
        }
        .progress-bar {
            font-size: 16px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-confirmar {
            width: 100%;
        }
    </style>

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <!-- Tarjeta 1 -->
        <div class="col-md-5 mb-5 me-2 ms-2 p-3 border rounded shadow">
            <div>
                <h4 class="fw-bold">No. Pedido 020239</h4>
                <h6>Dirección: Calle Primavera, #123 (Bogotá)</h6>
                <h6>Cant. Productos: 4</h6>
                <h6>Tel Cliente: +57 123 4567843</h6>
                <!-- Barra de estado -->
                <div class="progress mb-3">
                    <div class="progress-bar bg-info estado-barra" style="width: 60%;">En preparación</div>
                </div>
                <!-- Botón de continuar -->
                <button class="btn btn-dark btn-confirmar">
                    <i class="fas fa-arrow-right"></i> Confirmar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll(".btn-confirmar").forEach((boton, index) => {
        let estado = 1; // Estado inicial
        const barra = document.querySelectorAll(".estado-barra")[index];

        boton.addEventListener("click", () => {
            if (estado === 1) {
                barra.style.width = "90%";
                barra.textContent = "En camino";
                barra.classList.remove("bg-info");
                barra.classList.add("bg-primary");
                estado++;
            } else if (estado === 2) {
                barra.style.width = "100%";
                barra.textContent = "Entregado";
                barra.classList.remove("bg-primary");
                barra.classList.add("bg-success");
                estado++;

                // Deshabilitar botón
                boton.classList.remove("btn-dark");
                boton.classList.add("btn-secondary");
                boton.innerHTML = '<i class="fas fa-lock"></i> Pedido ya entregado';
                boton.disabled = true;
            }
        });
    });
</script>