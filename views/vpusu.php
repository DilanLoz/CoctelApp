<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div id="usuario" class="container mt-3 mb-5">
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="row">
            <h2 class="fw-bold mb-3"><i class="fa-solid fa-file-shield"></i>Datos personales</h2>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="identificacion" class="form-label">No. de Identificacion:</label>
                    <input type="text" class="form-control" id="tipdocu" name="identificacion" required readonly>
                    <span class="text-muted">No se puede modificar</span>
                </div>
                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres y apellidos:</label>
                    <input type="text" class="form-control" id="nomusu" name="nombres" required readonly>
                    <span class="text-muted">No se puede modificar</span>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo electronico:</label>
                    <input type="email" class="form-control" id="correo" name="correo" required readonly>
                    <div class="invalid-feedback">
                        Por favor, introduce un correo electrónico válido.
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="fecnausu" name="fecha_nacimiento" required readonly>
                    <span class="text-muted">No se puede modificar</span>
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="foto_documento" class="form-label">Foto del Documento:</label>
                        <input type="file" class="form-control" id="fotiden" name="foto_documento" accept="image/*" required>
                        <span class="text-muted">Solo se puede subir dos veces el documento</span>
                    </div>
                    <label for="ubicacion" class="form-label">Ubicación Actual:</label>
                    <select id="codubi" name="employee-type" class="form-control">
                        <option value="bogota">Bogota DC</option>
                        <option value="medellin">Medellin</option>
                        <option value="cartagena">Cartagena</option>
                        <option value="bucaramanga">Bucaramanga</option>
                        <option value="nariño">Nariño</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="pasusu" name="contrasena" required>
                </div>
            </div>
        </div>
        <div class="text-end mt-3">
            <input type="submit" value="Actualizar datos" class="btn btn-warning" id="actualizarBtn">
        </div>
    </form>
    <script src="js/alertas.js"></script>
</div>
