
<div class="container mt-5" style="text-align: left;">
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="row">
        <div class="d-flex">
            <a href="home.php?pg=1007" class="btn btn-warning ms-auto mx-5">VOLVER</a>
        </div>
            <!-- Columna izquierda (Formulario de dirección) -->
            <div class="col-md-6">
                <div class="row">
                    <div class="mt-3">
                        <img src="imgcoctellapp.png" alt="" class="img-fluid" style="max-height: 200px; max-width: 100%;">
                    </div>
                    <h1 class="text-warning text-start fw-bold">Dirección del envío</h1>
                    <div class="col mb-3">
                        <label for="nombrePersona" class="form-label">Nombre de la persona que recibirá:</label>
                        <input type="text" class="form-control" id="nombrePersona" placeholder="Nombre" aria-label="Nombre">
                    </div>
                    <div class="col mb-3">
                        <label for="ciudad" class="form-label">Ciudad:</label>
                        <select id="ciudad" class="form-select" placeholder="Ciudad" aria-label="Ciudad">
                            <option selected>Seleccionar ciudad</option>
                            <option>Bogotá</option>
                            <option>Medellín</option>
                            <option>Barranquilla</option>
                            <option>Cali</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección residencial</label>
                    <input type="text" class="form-control" id="direccion" placeholder="Dirección">
                </div>
                <div class="mb-3">
                    <label for="mensajeRecomendaciones" class="form-label">Mensaje de recomendaciones</label>
                    <textarea class="form-control" id="mensajeRecomendaciones" rows="3"></textarea>
                </div>
                <!-- Botón para ir a pagar -->
        <div class="text-start mt-4">
            <a href="home.php?pg=1011" class="btn btn-warning col-md-12">Ir a pagar</a>
        </div>
            </div>
        </div>
    </form>
</div>
