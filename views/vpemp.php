
<div id="perfil" class="container mt-5 mb-5" style="text-align: left; display: block;">
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="row">
            <h2 class="fw-bold mb-3"><i class="fa-solid fa-file-shield"></i>Datos personales</h2>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="identificacion" class="form-label">No. de Identificación:</label>
                    <input type="text" class="form-control" id="identificacion" name="identificacion" required readonly>
                    <span class="text-muted">No se puede modificar</span>
                </div>
                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres y apellidos:</label>
                    <input type="text" class="form-control " id="nombres" name="nombres" required readonly>
                    <span class="text-muted">No se puede modificar</span>
                </div>
                <div class="mb-3">
                    <label for="foto_documento" class="form-label">Foto del Documento:</label>
                    <input type="file" class="form-control " id="foto_documento" name="foto_documento" accept="image/*">
                    <span class="text-muted">Solo se puede subir dos veces el documento</span>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción del Empleado:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4"></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="bar_contrato" class="form-label">Bar de Contrato:</label>
                    <input type="text" class="form-control" id="bar_contrato" name="bar_contrato" min="0" max="100"
                        step="1" value="" required readonly>
                    <span class="text-muted">No se puede modificar</span>
                </div>
                <div class="mb-3">
                    <label for="ubicacion" class="form-label">Ubicación Actual:</label>
                    <select id="employee-type" name="employee-type" class="form-control" required>
                        <option value="bogota">Bogota DC</option>
                        <option value="medellin">Medellin</option>
                        <option value="cartagena">Cartagena</option>
                        <option value="bucaramanga">Bucaramanga</option>
                        <option value="nariño">Nariño</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required
                        readonly>
                    <span class="text-muted">No se puede modificar</span>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                </div>
            </div>
        </div>
        <div class="text-end mt-3 ">
            <input type="submit" value="Actualizar datos" class="btn btn-warning" id="actualizarBtn">
        </div>
    </form>
</div>
<script src="js/alertas.js"></script>
</div>