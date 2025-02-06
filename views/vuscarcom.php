<div class="container mt-5 col-12 col-md-8" id="detpedpq" style="text-align: left">
    <div class="mt-4">
        <h1 class="text-warning fw-bold" style="font-size: 30px">
            <i class="fa-solid fa-cart-shopping"></i> Carrito
        </h1>
        <div class="row">
            <div class="rounded-3 me-4 mb-5 text-black" style="background-color: #fff;">
                <!-- Producto 1 -->
                <div class="rounded-3 border border-secondary mb-3">
                    <div class="row product-item pt-3 ps-3 pe-3 mt-3 bg-body-tertiary rounded-3 m-4">
                        <!-- Imagen del producto -->
                        <div class="col-3 col-sm-2 d-flex justify-content-center">
                            <img src="img/coctelapp/logo.png" alt="" class="prodcar" draggable="false" style="width: 50px; height: 70px;">
                        </div>

                        <!-- Información del producto -->
                        <div class="col-6 col-sm-6">
                            <ul style="list-style-type: none; padding-left: 0;">
                                <li><b>Licor Sake Yaegaki</b></li>
                                <li><b style="font-size: 13px;">Bar Rocas</b></li>
                                <li><b class="text-warning">190.000</b></li>
                            </ul>
                        </div>

                        <!-- Contenedor del contador y botón de eliminar -->
                        <div class="col-3 d-flex justify-content-between align-items-center mb-3">
                            <!-- Contador -->
                            <div class="counter d-flex align-items-center">
                                <button class="btn btn-outline-success btn-sm increment">
                                    <i class="fa-solid fa-plus"></i>
                                </button>

                                <input type="text" class="text-center mx-1 form-control quantity" value="1" readonly>

                                <button class="btn btn-outline-danger btn-sm decrement">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </div>

                            <!-- Botón de eliminar -->
                            <button class="trash mb-2">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row product-item pt-3 ps-3 pe-3 mt-3 bg-body-tertiary rounded-3 m-4">
                        <!-- Imagen del producto -->
                        <div class="col-3 col-sm-2 d-flex justify-content-center">
                            <img src="img/coctelapp/logo.png" alt="" class="prodcar" draggable="false" style="width: 50px; height: 70px;">
                        </div>

                        <!-- Información del producto -->
                        <div class="col-6 col-sm-6">
                            <ul style="list-style-type: none; padding-left: 0;">
                                <li><b>Licor Sake Yaegaki</b></li>
                                <li><b style="font-size: 13px;">Cabañas</b></li>
                                <li><b class="text-warning">190.000</b></li>
                            </ul>
                        </div>

                        <!-- Contenedor del contador y botón de eliminar -->
                        <div class="col-3 d-flex justify-content-between align-items-center mb-3">
                            <!-- Contador -->
                            <div class="counter d-flex align-items-center">
                                <button class="btn btn-outline-success btn-sm increment">
                                    <i class="fa-solid fa-plus"></i>
                                </button>

                                <input type="text" class="text-center mx-1 form-control quantity" value="1" readonly>

                                <button class="btn btn-outline-danger btn-sm decrement">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </div>

                            <!-- Botón de eliminar -->
                            <button class="trash mb-2">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Cálculos y pagos -->
                <div class="mb-5 mt-3">
                    <div class="row mt-2">
                        <label class="col-6 col-md-6 col-form-label"><strong>Costo del envío</strong></label>
                        <label class="costenvio col-6 col-md-6 text-end p-2"><strong>$ 4.200</strong></label>
                    </div>
                    <div class="row">
                        <label class="col-6 col-md-6 col-form-label"><strong>Costo Total</strong></label>
                        <label class="costenvio col-6 col-md-6 text-end p-2"><strong>$ 44.800</strong></label>
                    </div>
                    <div class="text-end mt-3">
                        <a href="home.php?pg=1012" class="btn btn-warning col-12 col-md-2">Ir a pagar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', function() {
            let input = this.nextElementSibling;
            let valor = parseInt(input.value, 10);
            if (valor < 10) {
                input.value = valor + 1;
            }
        });
    });

    document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', function() {
            let input = this.previousElementSibling;
            let valor = parseInt(input.value, 10);
            if (valor > 1) {
                input.value = valor - 1;
            }
        });
    });
</script>

<style>
    /* 🔹 Contenedor del contador y botón de eliminar */
    .counter {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* 🔹 Botón de eliminar */
    .trash {
        background-color: transparent;
        border: none;
        color: red;
        font-size: 18px;
        cursor: pointer;
    }

    /* 🔹 Input del contador */
    .counter input {
        width: 45px;
        font-size: 14px;
        text-align: center;
        padding: 5px;
        margin: 0 5px;
    }

    /* 🔹 Solo para móviles (menos de 768px) */
    @media (max-width: 768px) {
        .counter {
            flex-direction: column;
        }

        .counter input {
            width: 35px;
            font-size: 12px;
        }

        .counter button {
            width: 30px;
            height: 30px;
            font-size: 12px;
            padding: 3px;
        }

        /* 🔹 Ajusta el contenedor en móviles */
        .col-3.d-flex {
            flex-direction: column-reverse;
            align-items: center;
            justify-content: center;
        }

        /* 🔹 El botón de eliminar se mantiene alineado a la derecha */
        .trash {
            margin-top: 5px;
        }
    }
</style>
