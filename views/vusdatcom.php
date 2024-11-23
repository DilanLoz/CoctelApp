
<div class="container mt-5" style="text-align: left;">
    
    <div id="perfil" class="container mb-5">
        <div class="d-flex">
            <a href="home.php?pg=1012" class="btn btn-warning ms-auto mx-5">VOLVER</a>
        </div>
        <h2 class="mt-3 mb-4 fw-bold fs-2">Formas de pago</h2>
        <!-- Selector de Métodos de Pago -->
        <div class="row mb-3">
            <div class="col-md-6">
                <button type="button" id="btn-tarjeta" class="btn btn-outline-warning text-dark btn-seleccionado">Tarjeta débito</button>
                <button type="button" id="btn-pse" class="btn btn-outline-warning text-dark">PSE</button>
            </div>
        </div>

        <!-- Formulario de Tarjeta Débito -->
        <div id="form-tarjeta">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nombre_titular" class="form-label">Nombre del titular de la tarjeta:</label>
                            <input type="text" class="form-control" id="nombre_titular" name="nombre_titular" maxlength="30">
                        </div>
                        <div class="mb-3">
                            <label for="numero_tarjeta" class="form-label">Número de la tarjeta:</label>
                            <input type="text" class="form-control" id="numero_tarjeta" name="numero_tarjeta" maxlength="20" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento:</label>
                                <input type="text" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" placeholder="MM/YYYY" required>
                            </div>
                            <div class="col-md-6">
                                <label for="codigo_seguridad" class="form-label">Código de Seguridad:</label>
                                <input type="text" class="form-control" id="codigo_seguridad" name="codigo_seguridad" maxlength="4" required>
                            </div>
                        </div>
                        <!-- Precio Total -->
                        <div id="precio-total" class="mt-4 border border-2 border-warning rounded-5 text-center fw-bold fs-5">
                            <div class="precio-total">
                                Precio Total: <span>$150,000</span>
                            </div>
                        </div>
                        <div class="text-start mt-4">
                            <a href="home.php?pg=1013" class="btn btn-warning col-md-12">PAGAR</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Aviso para otros métodos -->
        <div id="aviso-metodo" class="alert alert-warning d-none">
            <i class="fas fa-exclamation-circle"></i> Estamos trabajando para habilitar este método de pago.
        </div>
    </div>
</div>